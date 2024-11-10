<?php
session_start();
include('db.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login if not logged in
    exit();
}

// Fetch logged-in user's data
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = '$user_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome, <?php echo $user['name']; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>WELCOME HOUSEMATE!</h1>
    <h3><p>Name: <?php echo $user['name']; ?></p></h3>
    <h3><p>Email: <?php echo $user['email']; ?></p></h3>

    <a href="edit.php" class="btn">Edit Profile</a> <a href="logout.php" class="btn">Logout</a> <a href="delete.php" class="btn delete">Delete Account</a>

</body>
</html>