<?php
$con = mysqli_connect("localhost", "root", "", "store");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";
?>
