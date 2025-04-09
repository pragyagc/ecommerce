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

$user_id = $_SESSION['id'];
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];

    if (!empty($_FILES["profile_image"]["name"])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);

        if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
            $sql = "UPDATE users SET name='$name', contact='$contact', address='$address', profile_image='$target_file' WHERE id=$user_id";
        } else {
            echo "Error uploading the file.";
        }
    } else {
        $sql = "UPDATE users SET name='$name', contact='$contact', address='$address' WHERE id=$user_id";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: profile.php");
        exit();
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <style>
         body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        label {
            font-weight: bold;
            margin-bottom: 8px;
            display: block;
            color: #333;
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
            height: 100px;
        }

        input[type="file"] {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .profile-img-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .profile-img-container img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #4CAF50;
        }

        .form-container {
            max-width: 600px;
            margin: 0 auto;
        }

        @media (max-width: 768px) {
            .container {
                width: 90%;
            }

            input[type="submit"] {
                font-size: 14px;
            }

            textarea {
                height: 80px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Profile</h2>
    <form method="post" enctype="multipart/form-data" class="form-container">
    
        <!-- Form fields -->
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>

        <label for="contact">Contact:</label>
        <input type="text" name="contact" value="<?php echo htmlspecialchars($user['contact']); ?>" required>

        <label for="address">Address:</label>
        <textarea name="address"><?php echo htmlspecialchars($user['address']); ?></textarea>

        <label for="profile_image">Profile Picture:</label>
        <input type="file" name="profile_image">

        <input type="submit" value="Update Profile">
    </form>
</div>

</body>
</html>
