<?php
$servername = "localhost";
$username = "root"; // Change if you have a different username
$password = ""; // Change if your MySQL has a password
$database = "store";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from users table
$sql = "SELECT * FROM orders";
$result = $conn->query($sql);

$users = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

// Convert data to JSON format
header('Content-Type: application/json');
echo json_encode($users);

$conn->close();
?>
