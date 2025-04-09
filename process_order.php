
<?php
// Include database connection
include 'connection.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $name = isset($_POST['name']) ? $con->real_escape_string($_POST['name']) : '';
    $address = isset($_POST['address']) ? $con->real_escape_string($_POST['address']) : '';
    $payment_method = isset($_POST['payment_method']) ? $con->real_escape_string($_POST['payment_method']) : '';

    // Validate required fields
    if ($product_id > 0 && !empty($name) && !empty($address) && !empty($payment_method)) {
        // Insert order into the database
        $sql = "INSERT INTO orders (product_id, customer_name, customer_address, payment_method) 
                VALUES ('$product_id', '$name', '$address', '$payment_method')";

        if ($con->query($sql) === TRUE) {
            // Redirect to success page
            echo "<script>alert('Order placed successfully!'); window.location.href = 'success.php';</script>";
        } else {
            // Handle database error
            echo "<script>alert('Error: " . $con->error . "'); window.history.back();</script>";
        }
    } else {
        // Handle validation errors
        echo "<script>alert('All fields are required. Please fill out the form correctly.'); window.history.back();</script>";
    }
} else {
    // Redirect back if accessed without form submission
    echo "<script>alert('Invalid request.'); window.location.href = 'shop.php';</script>";
}
?>
