<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="img/logo.png" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- latest compiled and minified CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
    <!-- jquery library -->
    <script type="text/javascript" src="bootstrap/js/jquery-3.2.1.min.js"></script>
    <!-- Latest compiled and minified javascript -->
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css">
    <title>Thrift Shop</title>

    <style>
        /* Chat Popup Styles */
        .chat-popup {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 300px;
            max-height: 300px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            overflow: hidden;
            flex-direction: column;
        }

        #chatbox {
            overflow-y: scrollbar;
            padding: 10px;
            height: 300px;
            border-bottom: 1px solid #ccc;
        }

        #inputArea {
            display: flex;
            padding: 10px;
            gap: 10px;
        }

        #inputArea input {
            flex-grow: 1;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 5px;
        }

        #chatButton {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 999;
        }

        #closeChat {
            background-color: #d9534f;
            color: white;
            border: none;
            padding: 5px 10px;
            margin: 5px;
            cursor: pointer;
            border-radius: 5px;
            align-self: flex-end;
        }

        #closeChat:hover {
            background-color: #c9302c;
        }
    </style>
</head>
<body>
    <div>
        <?php require 'header.php'; ?>
        <div id="bannerimage">
            <div class="container">
                <center>
                    <h1>We sell secondhand clothes at affordable prices</h1>
                    <p>New Year Offer</p>
                    <p>Clothes in just Rs.500</p>
                    <a href="shop.php" class="btn btn-danger">Shop Now</a>
                </center>
            </div>
        </div>
    </div>

    

<?php require 'footer.php'; ?>
</body>
</html>