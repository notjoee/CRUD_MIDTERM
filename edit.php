<?php
session_start();
include('db.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login if not logged in
    exit();
}

// Fetch user data
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = '$user_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password if it's set
    $hashed_password = !empty($password) ? password_hash($password, PASSWORD_DEFAULT) : $user['password'];

    // Update user data
    $sql = "UPDATE users SET name = '$name', email = '$email', password = '$hashed_password' WHERE id = '$user_id'";
    if ($conn->query($sql) === TRUE) {
        header('Location: index.php'); // Redirect to the dashboard
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Edit Profile</h1>
    <form action="edit.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo $user['name']; ?>" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $user['email']; ?>" required><br>

        <label for="password">Password (leave empty to keep current password):</label>
        <input type="password" name="password"><br>

        <button type="submit" class="btn">Update Profile</button>
    </form>

</body>
</html>