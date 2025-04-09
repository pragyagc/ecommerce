<nav class="navbar navbar-inverse navabar-fixed-top">
               <div class="container">
                   <div class="navbar-header">
                       <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                       </button>
                       <a href="index.php" class="navbar-brand">Thrift Store</a>
                   </div>
                   
                   <div class="collapse navbar-collapse" id="myNavbar">
                       <ul class="nav navbar-nav navbar-right">
                           <li><a href="shop.php"><span class="glyphicon glyphicon-shop"></span>Shop</a></li>
                           <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
                           <li><a href="upload.php"><span class="glyphicon glyphicon-upload"></span> upload</a></li>
                           <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                       </ul>
                   </div>
                  
                   <div class="container">
        <h2>Search Results</h2>
        
        <?php if (!empty($message)) : ?>
            <p><?php echo $message; ?></p>
        <?php else : ?>
            <p>Found <?php echo count($products); ?> products matching your search for '<strong><?php echo htmlspecialchars($_GET['query']); ?></strong>'.</p>
            <div class="row">
                <?php foreach ($products as $product): ?>
                    <div class="col-md-3 col-sm-6">
                        <div class="thumbnail">
                            <a href="product_details.php?id=<?php echo $product['id']; ?>">
                                <img src="<?php echo $product['image_path']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" style="width: 100%; height: auto;">
                            </a>
                            <div class="caption">
                                <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                                <p>Price: Rs. <?php echo htmlspecialchars($product['price']); ?></p>
                                <a href="cart_add.php?id=<?php echo $product['id']; ?>" class="btn btn-primary">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
               </div>
</nav>