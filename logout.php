<?php
session_start();

// Destroy session to log out the user
session_destroy();
header('Location: login.php'); // Redirect to login page
exit();
?>