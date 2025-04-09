<?php
session_start();
include 'connection.php'; // Database connection

$searchQuery = "";
$minPrice = "";
$maxPrice = "";
$searchResults = [];

if (isset($_GET['search']) || isset($_GET['filter'])) {
    $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
    $minPrice = isset($_GET['min_price']) ? (float)$_GET['min_price'] : 0;
    $maxPrice = isset($_GET['max_price']) ? (float)$_GET['max_price'] : 999999;

    // Secure the input
    $searchQuery = trim($searchQuery);
    $searchQuery = $con->real_escape_string($searchQuery);

    // SQL Query with filters
    $sql = "SELECT * FROM items WHERE 
            (name LIKE '%$searchQuery%') 
            AND (price BETWEEN $minPrice AND $maxPrice)";
    
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $searchResults[] = $row;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Products with Filter</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/jquery-3.2.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h2 class="text-center mt-4">Search and Filter Products</h2>

    <!-- Search & Filter Form -->
    <form action="search.php" method="GET" class="form-inline my-4">
        <input type="text" name="search" class="form-control mr-2" placeholder="Search for products..." value="<?php echo htmlspecialchars($searchQuery); ?>" required>

        <input type="number" name="min_price" class="form-control mr-2" placeholder="Min Price" value="<?php echo htmlspecialchars($minPrice); ?>" min="0">
        <input type="number" name="max_price" class="form-control mr-2" placeholder="Max Price" value="<?php echo htmlspecialchars($maxPrice); ?>" min="0">

        <button type="submit" name="filter" class="btn btn-primary"><i class="fa fa-search"></i> Filter</button>
    </form>

    <!-- Display Search Results -->
    <?php if (isset($_GET['search']) || isset($_GET['filter'])): ?>
        <h4>Results for: "<?php echo htmlspecialchars($searchQuery); ?>"</h4>

        <?php if (!empty($searchResults)): ?>
            <div class="row">
                <?php foreach ($searchResults as $product): ?>
                    <div class="col-md-3">
                        <div class="card mb-4">
                            <img src="<?php echo $product['image_path']; ?>" class="card-img-top" alt="<?php echo $product['name']; ?>" style="width:100%; height: 250px;">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $product['name']; ?></h5>
                                <p class="card-text">Price: Rs. <?php echo $product['price']; ?></p>
                                <a href="product_details.php?id=<?php echo $product['id']; ?>" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No products found matching your criteria.</p>
        <?php endif; ?>
    <?php endif; ?>
</div>

</body>
</html>
