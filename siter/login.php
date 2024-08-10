<?php
session_start();

// Include the file with hashed password
require 'hashing.php';

// Define username
$validUsername = 'admin';

// Check login credentials
if ($_POST['username'] === $validUsername && password_verify($_POST['password'], $hashedPassword)) {
    $_SESSION['loggedin'] = true;
    header('Location: view_logs.php');
    exit();
} else {
    echo 'Invalid credentials';
}
?>
