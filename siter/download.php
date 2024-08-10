<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['loggedin'])) {
    header('Location: admin.html');
    exit();
}

// Force download of log file
$logFile = 'logs.txt';
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="logs.txt"');
header('Content-Length: ' . filesize($logFile));
readfile($logFile);
?>
