<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="img/logo.png" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
    <!-- jQuery library -->
    <script type="text/javascript" src="bootstrap/js/jquery-3.2.1.min.js"></script>
    <!-- Latest compiled and minified javascript -->
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css">
    <link rel="stylesheet" href="style.css"> <!-- Add your custom styles here -->
    <title>Thrift Shop</title>

    <style>
        /* Basic reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        /* Navigation Menu */
        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            background-color: #333;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        li {
            margin: 0 10px;
        }

        li a {
            display: block;
            width: 300px;
            padding: 15px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            color: white;
            background-color: #4CAF50;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        /* Hover effect for links */
        li a:hover {
            background-color: #45a049;
            transform: scale(1.05);
        }

        /* Active state for selected menu */
        li a.active {
            background-color: #333;
            color: #4CAF50;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            ul {
                flex-direction: column;
            }

            li a {
                width: 100%;
                margin: 5px 0;
            }
        }

        /* Optional - adding icons before the links */
        li a:before {
            content: '\f0c9';
            font-family: 'FontAwesome';
            margin-right: 10px;
        }
        h1{
            margin-top: 250px;
            text-align: center;
        }
    </style>
</head>

<body>
<ul>
  <li><a href="cart_approval.php">Cart Status</a></li>
  <li><a href="admin_approve.php">Upload Approval</a></li>
  <li><a href="loginadmin.php">Login</a></li>
  <li><a href="logoutadmin.php">Logout</a></li>
</ul>
<h1 style="font-size:60px;" > Hello Admin!</h1>
</body>
</html>
