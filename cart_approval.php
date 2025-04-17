<?php
session_start();
require 'connection.php';

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    die("<div class='alert'>Error: User is not logged in. <a href='login.php'>Login here</a></div>");
}

$user_id = $_SESSION['id'];

// Fetch user details along with item details
$user_products_query = "
    SELECT 
        it.id AS item_id, 
        it.name AS item_name, 
        it.price, 
        u.name AS user_name, 
        u.address, 
        u.contact 
    FROM 
        users_items ut 
    INNER JOIN items it ON it.id = ut.item_id 
    INNER JOIN users u ON u.id = ut.user_id 
    WHERE ut.user_id = '$user_id'";

$user_products_result = mysqli_query($con, $user_products_query) or die(mysqli_error($con));
$no_of_user_products = mysqli_num_rows($user_products_result);
$sum = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="img/logo.png" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
    <script type="text/javascript" src="bootstrap/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css">
    <title>Thrift Shop</title>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        table {
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 50px;
        }
        th, td {
            text-align: center;
            padding: 12px;
        }
        th {
            background-color: green;
            color: #fff;
        }
        tbody tr:hover {
            background-color: #f5f5f5;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        .alert {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
            padding: 10px;
            margin-top: 20px;
            border-radius: 5px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
    
        <?php
        if ($no_of_user_products == 0) {
            echo '<div class="alert">No items in the cart!</div>';
        } else {
            ?>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Item Number</th>
                        <th>Item Name</th>
                        <th>Price</th>
                        <th>User Name</th>
                        <th>Address</th>
                        <th>Contact</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $counter = 1;
                    while ($row = mysqli_fetch_assoc($user_products_result)) {
                        $sum += $row['price'];
                    ?>
                        <tr>
                            <td><?php echo $counter; ?></td>
                            <td><?php echo htmlspecialchars($row['item_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['price']); ?></td>
                            <td><?php echo htmlspecialchars($row['user_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['address']); ?></td>
                            <td><?php echo htmlspecialchars($row['contact']); ?></td>
                            <td><a href="items_remove.php?item_id=<?php echo $row['item_id']; ?>">Remove</a></td>
                        </tr>
                    <?php $counter++; } ?>
                </tbody>
            </table>
        <?php } ?>
    </div>
</body>
</html>