<?php
// Set up logging
$logFile = 'logs.txt';

// Get visitor details
$ip = $_SERVER['REMOTE_ADDR'];
$browser = $_POST['browser'];
$os = $_POST['os'];

// Format the log entry
$logEntry = "IP: $ip | Browser: $browser | OS: $os\n";

// Append log entry to file
file_put_contents($logFile, $logEntry, FILE_APPEND);

// Return a success message
echo 'Data logged successfully';
?>
