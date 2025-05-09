<?php
// This is a test file to verify the PHP mail configuration
// It will send a test email to verify if mail is working

header('Content-Type: text/plain');

echo "PHP Mail Test\n";
echo "=============\n\n";

try {
    $to = "s.patsariya@gmail.com";
    $subject = "Test Email from Portfolio Website";
    $message = "This is a test email to verify that mail() is working on the server.";
    $headers = "From: Test <test@example.com>\r\n";
    
    echo "Attempting to send email to $to...\n";
    
    $result = mail($to, $subject, $message, $headers);
    
    if ($result) {
        echo "Success! Mail was sent. Please check your inbox.\n";
    } else {
        echo "Failed to send mail. Please check your server configuration.\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

echo "\nAdditional debugging information:\n";
echo "PHP Version: " . phpversion() . "\n";
echo "Server OS: " . PHP_OS . "\n";
echo "Server Software: " . $_SERVER['SERVER_SOFTWARE'] . "\n";
?>
