<?php
session_start();
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_name']) && isset($_FILES['product_image'])) {
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
            // Insert into products table
            $sql = "INSERT INTO products (product_name, product_image_url, price) VALUES ('$productName', '$uploadFilePath', '$price')";
            if ($con->query($sql) === TRUE) {
                echo "<script>alert('Product uploaded successfully! Awaiting admin approval.');</script>";
            } else {
                echo "<script>alert('Error: " . $con->error . "');</script>";
            }
        } else {
            echo "<script>alert('Error uploading the file.');</script>";
        }
    } else {
        echo "<script>alert('Invalid file type. Allowed types: jpg, jpeg, png, gif.');</script>";
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="shortcut icon" href="img/logo.png" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- latest compiled and minified CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
    <!-- jquery library -->
    <script type="text/javascript" src="bootstrap/js/jquery-3.2.1.min.js"></script>
    <!-- Latest compiled and minified javascript -->
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css">
    <link rel="stylesheet" href="style.css">
    <title>Thrift Shop</title>
    <style>
        /* Center the form on the page */
        body {
            font-family: Arial, sans-serif;
            background-color:#FFFFCC;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Style the form container */
        form {
            background: #ffffff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        /* Style labels */
        form label {
            font-weight: bold;
            color: #333333;
            display: block;
            margin-bottom: 8px;
        }

        /* Style text input */
        form input[type="text"],
        form input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        /* Style the button */
        form button {
            width: 100%;
            padding: 10px 15px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        /* Button hover effect */
        form button:hover {
            background-color: #0056b3;
        }
    </style>

</head>
<body>
    
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <label>Product Name:</label><br>
        <input type="text" name="product_name" required><br><br>
        <label>Price:</label><br>
        <input type="number" name="price"  required><br><br>
        <label>Product Image:</label><br>
        <input type="file" name="product_image" required><br><br>
        <button type="submit">Upload Product</button>
    </form>       
</body>
</html>
