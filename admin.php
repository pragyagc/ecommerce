<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="img/logo.png" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thrift Shop</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
    <!-- jQuery -->
    <script type="text/javascript" src="bootstrap/js/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

    <style>
        /* Reset Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            text-align: center;
        }

        /* Navigation Menu */
        ul {
            list-style-type: none;
            margin: 20px auto;
            padding: 0;
            display: flex;
            justify-content: center;
            background-color: #333;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            max-width: 900px;
        }

        li {
            margin: 0;
        }

        li a {
            display: block;
            padding: 15px 20px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            color: white;
            background-color: #4CAF50;
            border-radius: 5px;
            transition: all 0.3s ease;
            font-weight: bold;
        }

        /* Hover effect */
        li a:hover {
            background-color: #45a049;
            transform: scale(1.05);
        }

        /* Active state */
        li a.active {
            background-color: #333;
            color: #4CAF50;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            ul {
                flex-direction: column;
                text-align: center;
                max-width: 100%;
            }

            li {
                margin-bottom: 5px;
            }

            li a {
                width: 100%;
                border-radius: 0;
            }
        }

        /* Adding icons */
        li a:before {
            font-family: 'FontAwesome';
            margin-right: 10px;
        }

        li:nth-child(1) a:before { content: '\f007'; } /* Users Data Icon */
        li:nth-child(2) a:before { content: '\f07a'; } /* Cart Icon */
        li:nth-child(3) a:before { content: '\f291'; } /* Products Icon */
        li:nth-child(4) a:before { content: '\f14a'; } /* Approval Icon */
        li:nth-child(5) a:before { content: '\f2f6'; } /* Login Icon */
        li:nth-child(6) a:before { content: '\f08b'; } /* Logout Icon */

        /* Heading */
        h1 {
            font-size: 60px;
            margin-top: 200px;
            font-weight: bold;
            color: #333;
        }

        /* Responsive heading */
        @media (max-width: 600px) {
            h1 {
                font-size: 40px;
                margin-top: 150px;
            }
        }
    </style>
</head>
<body>

<ul>
    <li><a href="users_data.php">Users Data</a></li>
    <li><a href="cart_approval.php">Cart Status</a></li>
    <li><a href="order.php">Orders</a></li>
    <li><a href="admin_approve.php">Upload Approval</a></li>
    
    <li><a href="logoutadmin.php">Logout</a></li>
</ul>

<h1>Hello Admin!</h1>

</body>
</html>