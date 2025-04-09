<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "store";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['id'];
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
        }

        .profile-container {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }

        .profile-pic {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #4CAF50;
            margin-bottom: 10px;
        }

        h2 {
            margin: 10px 0;
            color: #333;
        }

        .info {
            font-size: 18px;
            margin: 5px 0;
        }

        .btn-edit {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: 0.3s;
        }

        .btn-edit:hover {
            background-color: #45a049;
        }

    </style>
</head>
<body>

<div class="profile-container">
    <?php
    $profileImage = !empty($user['profile_image']) ? $user['profile_image'] : 'uploads/default-profile.jpg';
    ?>
    <img src="<?php echo htmlspecialchars($profileImage); ?>" alt="Profile Picture" class="profile-pic">
    <h2><?php echo htmlspecialchars($user['name']); ?></h2>
    <p class="info"><i class="fa fa-envelope"></i> <?php echo htmlspecialchars($user['email']); ?></p>
    <p class="info"><i class="fa fa-phone"></i> <?php echo htmlspecialchars($user['contact']); ?></p>
    <p class="info"><i class="fa fa-map-marker"></i> <?php echo htmlspecialchars($user['address']); ?></p>

    <a href="edit_profile.php" class="btn-edit"><i class="fa fa-pencil"></i> Edit Profile</a>
</div>

</body>
</html>
