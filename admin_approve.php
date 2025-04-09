<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "store");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}




// Fetch products awaiting admin approval
$query = "SELECT * FROM products WHERE admin_approved = 0";
$result = mysqli_query($con, $query);

echo "<h2>Pending Product Approvals</h2>";

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $imagePath = $row['product_image_url'];
        echo "<div class='product'>
                <h3>" . $row['product_name'] . "</h3>
                <p>Price: Rs. " . $row['price'] . "</p>
                <img src='" . $imagePath . "' alt='" . $row['product_name'] . "' style='width:200px; height:auto;'><br>
                <form action='' method='POST'>
                    <input type='hidden' name='product_id' value='" . $row['id'] . "'>
                    <button type='submit' name='approve' class='btn btn-success'>Approve</button>
                    <button type='submit' name='reject' class='btn btn-danger'>Reject</button>
                </form>
              </div>";
    }
} else {
    echo "No products awaiting approval.";
}

// Handle Admin Approval or Rejection
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productId = $_POST['product_id'];
    
    if (isset($_POST['approve'])) {
        // Approve product and move it to the 'items' table
        $approveQuery = "SELECT * FROM products WHERE id = '$productId'";
        $productResult = mysqli_query($con, $approveQuery);
        if ($productRow = mysqli_fetch_assoc($productResult)) {
            $name = $productRow['product_name'];
            $image = $productRow['product_image_url'];
            $price = $productRow['price'];

            // Insert into 'items' table
            $insertItemQuery = "INSERT INTO items (name, price, image_path) VALUES ('$name', '$price', '$image')";
            if (mysqli_query($con, $insertItemQuery)) {
                // Mark product as approved
                $updateProductQuery = "UPDATE products SET admin_approved = 1 WHERE id = '$productId'";
                mysqli_query($con, $updateProductQuery);
                echo "Product approved and added to shop.";
            } else {
                echo "Error adding product to shop: " . mysqli_error($con);
            }
        }
    } elseif (isset($_POST['reject'])) {
        // Reject product and remove it from 'products' table
        $deleteQuery = "DELETE FROM products WHERE id = '$productId'";
        if (mysqli_query($con, $deleteQuery)) {
            echo "Product rejected and removed.";
        } else {
            echo "Error rejecting product: " . mysqli_error($con);
        }
    }
}

mysqli_close($con);
?>