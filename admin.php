<?php
session_start();
include('connection.php');

// Handle Product Upload
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['upload_product'])) {
    $productName = $con->real_escape_string($_POST['product_name']);
    $price = $con->real_escape_string($_POST['price']);
    $uploadDir = 'uploads/';

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileName = basename($_FILES['product_image']['name']);
    $uploadFilePath = $uploadDir . $fileName;
    $fileType = strtolower(pathinfo($uploadFilePath, PATHINFO_EXTENSION));
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($fileType, $allowedTypes)) {
        if (move_uploaded_file($_FILES['product_image']['tmp_name'], $uploadFilePath)) {
            $sql = "INSERT INTO items ( name, image_path, price) VALUES ('$productName', '$uploadFilePath', '$price')";
            $con->query($sql);
        }
    }
}

//handle product deletion
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $id = intval($_GET['delete']);
    
    // 1. Fetch the image path from the database
    $res = $con->query("SELECT image_path FROM items WHERE id = $id");

    if ($res && $row = $res->fetch_assoc()) {
        $imagePath = $row['image_path'];

        // 2. Delete the image file from the server
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        // 3. Delete the entire row from the 'item' table (includes name, price, image_path)
        $con->query("DELETE FROM items WHERE id = $id");
    }
}


// Get all products
$result = $con->query("SELECT * FROM items ");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="img/logo.png" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products - Thrift Shop</title>

    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/jquery-3.2.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }

        ul {
            list-style-type: none;
            margin: 20px auto;
            padding: 0;
            display: flex;
            justify-content: center;
            background-color: #333;
            border-radius: 8px;
            overflow: hidden;
            max-width: 900px;
        }

        li a {
            display: block;
            padding: 15px 20px;
            color: white;
            background-color: #4CAF50;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        li a:hover {
            background-color: #45a049;
            transform: scale(1.05);
        }

        li a:before {
            font-family: 'FontAwesome';
            margin-right: 10px;
        }

        li:nth-child(1) a:before { content: '\f007'; }
        li:nth-child(2) a:before { content: '\f07a'; }
        li:nth-child(3) a:before { content: '\f291'; }
        li:nth-child(4) a:before { content: '\f14a'; }
        li:nth-child(5) a:before { content: '\f2f6'; }
        li:nth-child(6) a:before { content: '\f08b'; }

        .container {
            margin-top: 40px;
        }

        .card {
            margin: 15px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .card img {
            max-height: 200px;
            object-fit: cover;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .card-body {
            padding: 15px;
        }

        .card-title {
            font-weight: bold;
        }

        .form-container {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 40px;
        }

        .delete-btn {
            background-color: #e74c3c;
            color: white;
            padding: 6px 12px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            margin-top: 10px;
        }

        .delete-btn:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>

<ul>
    <li><a href="users_data.php">Users Data</a></li>
    <li><a href="cart_approval.php">Cart Status</a></li>
    <li><a href="order.php">Orders</a></li>
    <li><a href="admin_approve.php">Upload Approval</a></li>
    <li><a href="logoutadmin.php">Logout</a></li>
</ul>

<div class="container">
    <!-- Upload Form -->
    <div class="form-container">
        <h3>Upload New Product</h3>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Product Name:</label>
                <input type="text" name="product_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Price (Rs.):</label>
                <input type="number" name="price" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Product Image:</label>
                <input type="file" name="product_image" class="form-control" required>
            </div>
            <button type="submit" name="upload_product" class="btn btn-success mt-3">Upload Product</button>
        </form>
    </div>

    <!-- Product Listing -->
    <div class="row">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col-md-4">
                    <div class="card">
                        <img src="<?php echo htmlspecialchars($row['image_path']); ?>" class="card-img-top" alt="Product Image">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($row['name']); ?></h5>
                            <p>Price: Rs. <?php echo htmlspecialchars($row['price']); ?></p>
                            <a href="?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12 text-center">
                <p>No products available.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
