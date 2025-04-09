<?php
session_start();
require 'check_if_added.php';
include 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="img/logo.png" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
    <!-- jQuery -->
    <script type="text/javascript" src="bootstrap/js/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css">
    <link rel="stylesheet" href="style.css">
    <title>Thrift Shop</title>
    <style>
        .rating {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 10px;
        }
        .stars {
            display: inline-flex;
        }
        .stars i {
            font-size: 20px;
            color: gold;
        }
        .stars i.disabled {
            color: lightgray;
        }
    </style>
</head>
<body>
    <div>
        <?php require 'header.php'; ?>
        <div class="container">
            <div class="jumbotron">
                <h1>Welcome to our eCommerce Store!</h1>
                <p>We have the best clothes for you. No need to hunt around, we have all in one place.</p>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <?php
                // Fetch products along with average ratings
                $sql = "SELECT items.*, COALESCE(AVG(ratings.rating), 0) AS avg_rating
                        FROM items
                        LEFT JOIN ratings ON items.id = ratings.product_id
                        GROUP BY items.id";
                $result = $con->query($sql);
                
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $average_rating = round($row['avg_rating'], 1); // Round rating to 1 decimal place
                ?>
                        <div class="col-md-3 col-sm-6">
                            <div class="thumbnail">
                                <a href="product_details.php?id=<?php echo $row['id']; ?>">
                                    <img src="<?php echo $row['image_path']; ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" style="width: auto; height: auto;">
                                </a>
                                <center>
                                    <div class="caption">
                                        <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                                        <p>Price: Rs. <?php echo htmlspecialchars($row['price']); ?></p>
                                        
                                        <!-- Dynamic Rating Display -->
                                        <div class="rating">
                                            
                                            <div class="stars">
                                                <?php
                                                for ($i = 1; $i <= 5; $i++) {
                                                    if ($i <= $average_rating) {
                                                        echo '<i class="fa fa-star"></i>';
                                                    } else {
                                                        echo '<i class="fa fa-star disabled"></i>';
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </center>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo "<p>No products available.</p>";
                }
                ?>
            </div>
        </div>
    </div>

    <?php require 'footer.php'; ?>
</body>
</html>
