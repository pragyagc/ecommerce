<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment with Khalti</title>
    <link rel="stylesheet" href="payment.css">
</head>
<body>
    <!-- <header>
        <div class="logo">FITNESS</div>
        <nav>
             <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="index.html">About Us</a></li>
                <li><a href="index.html">Services</a></li>
                <li><a href="subscription.html">Membership</a></li>
                <li><a href="contact.html">Contact Us</a></li>
                <li><a href="Schedule.html">schedule</a></li>
                <li><a href="payment.html">payment</a></li>
            </ul> -->
        <!-- </nav> -->
    <!-- </header> -->
    <div class="payment-container">
        <div class="logo-container">
            <img src="khalti.png" alt="Khalti Logo" width="200">
        </div>
        <h1>Gym Payment</h1>
        
        <!-- Mobile Number Input and OTP Section -->
        <form action="payment-request.php" method="POST">
            <input type="text" name="amount" placeholder="Amount" value="1000">
            <input type="hidden" name="pid" value="1">
            <input type="hidden" name="product" value="Gym Membership">
            <input type="text" name="name" placeholder="Name">
            <input type="email" name="email" placeholder="Email">
            <input type="text" name="mobile" placeholder="Mobile">
            <button type="submit" name="submit">Submit</button>
        </form>
        
        <div id="paymentStatus"></div>
    </div>
</body>
</html>
