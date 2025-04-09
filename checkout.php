<?php
include 'connection.php'; // Database connection

// Get product ID from the query string
if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);
    
    // Fetch product details
    $sql = "SELECT * FROM items WHERE id = $product_id";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "<p>Product not found!</p>";
        exit;
    }
} else {
    echo "<p>Invalid request.</p>";
    exit;
}

// Proceed to display the product details
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Checkout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333333;
        }

        .product-info {
            text-align: center;
            margin-bottom: 20px;
        }

        .product-info h3 {
            font-size: 24px;
            color: #333333;
            margin-bottom: 10px;
        }

        .product-info p {
            font-size: 18px;
            color: #555555;
        }

        .product-info img {
            margin-top: 15px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-size: 16px;
            font-weight: bold;
            color: #333333;
        }

        input[type="text"], 
        textarea, 
        select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #cccccc;
            border-radius: 4px;
            background-color: #f9f9f9;
        }

        textarea {
            resize: none;
            height: 80px;
        }

        .btn {
            padding: 10px 15px;
            font-size: 16px;
            font-weight: bold;
            color: #ffffff;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        @media (max-width: 768px) {
            .container {
                margin: 20px;
                padding: 15px;
            }

            .product-info img {
                width: 100%;
                height: auto;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Checkout</h2>
        <div class="product-info">
            <h3><?php echo htmlspecialchars($product['name']); ?></h3>
            <p>Price: Rs. <?php echo htmlspecialchars($product['price']); ?></p>
            <img src="<?php echo $product['image_path']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" style="width: 200px; height: auto;">
        </div>
        <form method="POST" action="process_order.php">
            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>
            
            <label for="address">Address:</label>
            <textarea name="address" id="address" required></textarea>
            
            <label for="payment_method">Payment Method:</label>
            <select name="payment_method" id="payment_method" required>
                <option value="cod">Cash on Delivery</option>
                <option value="card">Credit/Debit Card</option>
            </select>
            
            <button type="submit" class="btn">Place Order</button>
        </form>
    </div>
</body>
</html>
