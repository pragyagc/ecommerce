<?php
session_start();
require 'check_if_added.php';
include 'connection.php';

// Check if product ID is set
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<p>Invalid product.</p>";
    exit;
}

$product_id = (int)$_GET['id'];

// Fetch product details
$sql = "SELECT * FROM items WHERE id = $product_id";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "<p>Product not found.</p>";
    exit;
}

// Fetch average rating from the database
$rating_query = "SELECT AVG(rating) as avg_rating FROM ratings WHERE product_id = $product_id";
$rating_result = $con->query($rating_query);
$row_rating = $rating_result->fetch_assoc();
$average_rating = round($row_rating['avg_rating'], 1) ?: 0;  // If no ratings, default to 0

// Check if the user is logged in
$is_logged_in = isset($_SESSION['user_id']);
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
    <link rel="stylesheet" href="style.css">
    <title>Product Details</title>
</head>
<body>
<?php require 'header.php'; ?>
   <div class="container">
        <div class="row">
            <div class="col-md-6">
                <!-- Display product image -->
                <img src="<?php echo $row['image_path']; ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" style="width: 300px; height: 400px; margin-top: 20px">
            </div>

            <div class="col-md-3">
                <h2><?php echo htmlspecialchars($row['name']); ?></h2>
                <p>Price: Rs. <?php echo htmlspecialchars($row['price']); ?></p>

                <!-- Rating Display -->
                <div class="rating">
                    <p>Average Rating: <?php echo $average_rating; ?> ⭐</p>
                    
                </div>
                <!-- Rating Submission Form -->
<form action="rate_product.php" method="POST">
    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
    <label for="rating">Rate this product:</label>
    <select name="rating" id="rating" required>
        <option value="1">1 - Poor</option>
        <option value="2">2 - Fair</option>
        <option value="3">3 - Good</option>
        <option value="4">4 - Very Good</option>
        <option value="5">5 - Excellent</option>
    </select>
    <br>
    <label for="review">Your Review:</label>
    <textarea name="review" id="review" required></textarea>
    <br>
    <button type="submit" class="btn btn-primary">Submit Rating</button>
</form>

<!-- Display User Reviews -->
<h3>User Reviews</h3>
<?php
$review_query = "SELECT * FROM ratings WHERE product_id = $product_id ORDER BY created_at DESC";
$reviews = $con->query($review_query);

if ($reviews->num_rows > 0): ?>
    <?php while ($review = $reviews->fetch_assoc()): ?>
        <div class="review-box">
            <p><strong>User</strong> (<?php echo $review['rating']; ?> ⭐)</p>
            <p><?php echo htmlspecialchars($review['review']); ?></p>
            <small>Posted on <?php echo $review['created_at']; ?></small>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <p>No reviews yet.</p>
<?php endif; ?>



                <!-- Size options -->
                <div class="form-group">
                    <label for="size">Size:</label>
                    <select class="form-control" id="size">
                        <option value="S">Small</option>
                        <option value="M">Medium</option>
                        <option value="L">Large</option>
                        <option value="XL">Extra Large</option>
                    </select>
                </div>

                <a href="cart_add.php?id=<?php echo $row['id']; ?>" class="btn btn-block btn-primary">Add to cart</a>
                <a href="checkout.php?id=<?php echo $row['id']; ?>" class="btn btn-block btn-primary">Buy Now</a>