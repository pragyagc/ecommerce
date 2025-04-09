<?php
include('database.php');

$email = $_POST['email'];
$password = $_POST['password'];

// Validate input
if (empty($email) || empty($password)) {
    echo "Email or password cannot be empty";
    exit;
}

// Use prepared statements
$stmt = $connect->prepare("SELECT * FROM admin_login WHERE email = ? AND password = ?");
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        header("Location: admin.php");
        exit;
    }
} else {
    echo "<br/>Invalid email or password";
}

$stmt->close();
mysqli_close($connect);
?>
