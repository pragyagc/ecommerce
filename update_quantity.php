<?php
session_start();
require 'connection.php';

if (isset($_POST['item_id'], $_POST['quantity'])) {
    $item_id = $_POST['item_id'];
    $quantity = $_POST['quantity'];
    $user_id = $_SESSION['id'];

    // Update quantity in the database
    $update_query = "
        UPDATE 
            users_items 
        SET 
            quantity = '$quantity' 
        WHERE 
            user_id = '$user_id' 
        AND 
            item_id = '$item_id'";

    if (mysqli_query($con, $update_query)) {
        header('location: cart.php');
    } else {
        echo "Error updating quantity: " . mysqli_error($con);
    }
}
?>
