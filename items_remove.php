<?php
session_start();
require 'connection.php';

if (!isset($_SESSION['id']) || !isset($_GET['item_id'])) {
    header('location: cart.php');
    exit();
}

$user_id = $_SESSION['id'];
$item_id = intval($_GET['item_id']);

// Delete the item from the cart
$delete_query = "DELETE FROM users_items WHERE user_id = '$user_id' AND item_id = '$item_id'";
mysqli_query($con, $delete_query) or die(mysqli_error($con));

// Redirect back to the cart page
header('location: cart.php');
exit();
?>
