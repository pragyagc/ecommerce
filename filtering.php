<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Page - Thrift Store</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Thrift Store</h1>
    </header>

    <main>
        <section id="filter-section">
            <h2>Filter by Price</h2>
            <form method="GET" action="">
                <label for="min-price">Min Price:</label>
                <input type="number" name="min_price" id="min-price" placeholder="0" min="0">

                <label for="max-price">Max Price:</label>
                <input type="number" name="max_price" id="max-price" placeholder="1000" min="0">

                <button type="submit">Apply Filter</button>
            </form>
        </section>

        <section id="product-list">
            <h2>Products</h2>
            <div class="product-grid">
                <?php
                // Include the database connection
                include 'connection.php';

                // Get filter values
                $min_price = isset($_GET['min_price']) ? (int)$_GET['min_price'] : 0;
                $max_price = isset($_GET['max_price']) ? (int)$_GET['max_price'] : PHP_INT_MAX;

                // Query to fetch filtered products
                $query = "SELECT * FROM products WHERE price >= ? AND price <= ? ORDER BY price ASC";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("ii", $min_price, $max_price);
                $stmt->execute();
                $result = $stmt->get_result();

                // Display products
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='product'>";
                        echo "<img src='" . htmlspecialchars($row['image_url']) . "' alt='" . htmlspecialchars($row['name']) . "'>";
                        echo "<h3>" . htmlspecialchars($row['name']) . "</h3>";
                        echo "<p>Price: $" . htmlspecialchars($row['price']) . "</p>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No products found in this price range.</p>";
                }

                $stmt->close();
                ?>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Thrift Store. All Rights Reserved.</p>
    </footer>
</body>
</html>
