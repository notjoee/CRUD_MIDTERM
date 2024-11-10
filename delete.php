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

// Delete the user account
$sql = "DELETE FROM users WHERE id = '$user_id'";
if ($conn->query($sql) === TRUE)