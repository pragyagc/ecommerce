<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = (int)$_POST['product_id'];
    $rating = (int)$_POST['rating'];
    $review = trim($_POST['review']);

    // Validate rating
    if ($rating < 1 || $rating > 5) {
        die("Invalid rating! Must be between 1 and 5.");
    }

    // Insert rating into the database
    $insert_query = "INSERT INTO ratings (product_id, rating, review, created_at) VALUES (?, ?, ?, NOW())";
    $stmt = $con->prepare($insert_query);

    if (!$stmt) {
        die("Prepare failed: " . $con->error); // Check if the statement prepared successfully
    }

    $stmt->bind_param("iis", $product_id, $rating, $review);

    if ($stmt->execute()) {
        header("Location: product_details.php?id=$product_id");
        exit;
    } else {
        die("Execution failed: " . $stmt->error); // Check if execution was successful
    }
}
?>
