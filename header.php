<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

</head>
<body>
    
<nav class="navbar navbar-dark bg-warning navabar-fixed-top">

               <div class="container">
                   <div class="navbar-header">
                       <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                       </button>
                       <a href="index.php" class="logo-container">
                         <img src="img/logo.png" class="logo" alt="Logo" width="120" height="50">
                      </a>
                       
                   </div>
                   
                   <div class="collapse navbar-collapse" id="myNavbar">
                       <ul class="nav navbar-nav navbar-right">
                           <?php
                           if(isset($_SESSION['email'])){
                           ?>
                           <li><a href="shop.php"><span class="glyphicon glyphicon-shop"></span>Shop</a></li>
                           <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
                           <li><a href="upload.php"><span class="glyphicon glyphicon-upload"></span> Upload</a></li>
                           <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                           
                           <?php
                           }else{
                            ?>
                            <li><a href="shop.php"><span class="glyphicon glyphicon-shop"></span>Shop</a></li>
				            <li><a href="aboutus.php"><span class="glyphicon glyphicon-abtus"></span>About Us</a></li>
                            <li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                           <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                        
                           <?php
                           }
                           ?>
                           
                       </ul>
                       <!-- Search bar inside navbar -->
                <li class="nav-item">
                    <div class="search-container">
                        <form action="search_results.php" method="get">
                            <input type="text" class="search-input" placeholder="Search products..." name="search_query">
                            <button type="submit" class="search-button"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </li>
                   </div>
               </div>
</nav>
<!-- Add Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>