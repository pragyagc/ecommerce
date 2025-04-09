<?php
session_start();
require 'connection.php';

if (!isset($_SESSION['email'])) {
    header('location: login.php');
}

$user_id = $_SESSION['id'];

// Update query to include quantity and calculate subtotal
$user_products_query = "
    SELECT 
        it.id, 
        it.name, 
        it.price, 
        ut.quantity,
        (it.price * ut.quantity) AS subtotal 
    FROM 
        users_items ut 
    INNER JOIN 
        items it 
    ON 
        it.id = ut.item_id 
    WHERE 
        ut.user_id = '$user_id'";

$user_products_result = mysqli_query($con, $user_products_query) or die(mysqli_error($con));
$no_of_user_products = mysqli_num_rows($user_products_result);

$sum = 0;

if ($no_of_user_products == 0) {
?>
    <script>
        window.alert("No items in the cart!!");
    </script>
<?php
} else {
    while ($row = mysqli_fetch_array($user_products_result)) {
        $sum += $row['subtotal'];
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="shortcut icon" href="img/logo.png" />
    <title>Thrift Store</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
    <script type="text/javascript" src="bootstrap/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css">
    <link rel="stylesheet" href="style.css" type="text/css">
</head>

<body>
    <div>
        <?php
        require 'header.php';
        ?>
        <br>
        <div class="container">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>Item Number</th>
                        <th>Item Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Buy Now</th>
                        <th>Remove Cart Items</th>
                    </tr>
                    <?php
                    $user_products_result = mysqli_query($con, $user_products_query) or die(mysqli_error($con));
                    $counter = 1;

                    while ($row = mysqli_fetch_array($user_products_result)) {
                    ?>
                        <tr>
                            <td><?php echo $counter ?></td>
                            <td><?php echo $row['name'] ?></td>
                            <td>Rs <?php echo $row['price'] ?></td>
                            <td>
                                <form method="POST" action="update_quantity.php">
                                    <input type="hidden" name="item_id" value="<?php echo $row['id']; ?>">
                                    <input type="number" name="quantity" value="<?php echo $row['quantity']; ?>" min="1" class="form-control" style="width: 70px; display: inline;">
                                    <button type="submit" class="btn btn-sm btn-info">Update</button>
                                </form>
                            </td>
                            <td>Rs <?php echo $row['subtotal'] ?></td>
                            <td><a href='checkout.php?id=<?php echo $row['id']; ?>' class="btn btn-success btn-sm">Buy Now</a></td>
                            <td><a href='cart_remove.php?id=<?php echo $row['id']; ?>' class="btn btn-danger btn-sm">Remove</a></td>
                        </tr>
                    <?php
                        $counter++;
                    }
                    ?>
                    <tr>
                        <td></td>
                        <td>Total</td>
                        <td></td>
                        <td></td>
                        <td>Rs <?php echo $sum; ?>/-</td>
                        <td colspan="2"><a href="success.php?id=<?php echo $user_id ?>" class="btn btn-primary">Confirm Order</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <?php
        require 'footer.php';
        ?>
    </div>
</body>

</html>
