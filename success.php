<?php
session_start();
require 'connection.php';

if (!isset($_SESSION['email'])) {
    header('location: login.php');
}

// Fetch the user's cart items
$user_id = $_SESSION['id'];
$user_products_query = "
    SELECT 
        ut.id 
    FROM 
        users_items ut 
    WHERE 
        ut.user_id = '$user_id'";

$user_products_result = mysqli_query($con, $user_products_query) or die(mysqli_error($con));
$no_of_user_products = mysqli_num_rows($user_products_result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Order Success</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <style>
        body {
            text-align: center;
            padding: 50px;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 600px;
            margin: auto;
            border: 1px solid #ddd;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php if ($no_of_user_products == 0) { ?>
            <h1>No items in the cart</h1>
            <p>Please add some items to your cart before placing an order.</p>
            <a href="shop.php" class="btn">Go to Shop</a>
        <?php } else { ?>
            <h1>Thank you for your order!</h1>
            <p>Your order has been placed successfully. We will contact you soon.</p>
            <a href="shop.php" class="btn">Continue Shopping</a>
        <?php } ?>
    </div>
</body>

</html>
