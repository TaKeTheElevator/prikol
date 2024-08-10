<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['loggedin'])) {
    header('Location: ./admin.html');
    exit();
}

// Read log file
$logFile = 'logs.txt';
$logs = file_get_contents($logFile);

// Function to format log entries
function formatLogs($logEntries) {
    $formatted = '';
    $entries = explode("\n", trim($logEntries));
    $data = [];

    // Grouping identical entries
    foreach ($entries as $entry) {
        $parts = explode('|', $entry);
        if (count($parts) === 3) {
            $ip = trim(explode(':', $parts[0])[1]);
            $browser = trim(explode(':', $parts[1])[1]);
            $os = trim(explode(':', $parts[2])[1]);

            $key = "$ip|$browser|$os";
            if (!isset($data[$key])) {
                $data[$key] = ['ip' => $ip, 'browser' => $browser, 'os' => $os, 'count' => 0];
            }
            $data[$key]['count']++;
        }
    }

    // Formatting the grouped data
    foreach ($data as $entry) {
        $formatted .= "<div class='log-entry'>
            <div class='log-item'>
                <img src='pin.svg' class='icon'>
                <span>IP: {$entry['ip']} ({$entry['count']} times)</span>
            </div>
            <div class='log-item'>
                <img src='planet.svg' class='icon'>
                <span>Browser: {$entry['browser']}</span>
            </div>
            <div class='log-item'>
                <img src='comp.svg' class='icon'>
                <span>OS: {$entry['os']}</span>
            </div>
        </div>";
    }

    return $formatted;
}

// Format logs
$formattedLogs = formatLogs($logs);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link href="style.css" rel="stylesheet"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Logs</title>
    <style>
        /* Styles remain the same */
    </style>
</head>
<body>
    <div class="container">
        <h1>Logged Data</h1>
        <?php echo $formattedLogs; ?>
        <div class="footer">
            <a href="download.php" class="logout"><img src='download.svg' class='icon2'>Download Logs</a><br>
            <a href="/admin.html" class="logout"><img src='logout.svg' class='icon2'>Logout</a>
        </div>
    </div>
    <br><br><br><br><br><br><br><br><br>
    <img src='/assets/img/icon/logo.png' class='' style="width: 300px;">
</body>
</html>
