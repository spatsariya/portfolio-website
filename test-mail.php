<?php
/**
 * Test script to verify PHP mail functionality
 */

echo "<h2>PHP Mail Test</h2>";

// Test 1: Check if mail function exists
if (function_exists('mail')) {
    echo "✅ PHP mail() function is available<br>";
} else {
    echo "❌ PHP mail() function is NOT available<br>";
    exit;
}

// Test 2: Check PHP configuration
echo "<h3>PHP Configuration:</h3>";
echo "PHP Version: " . phpversion() . "<br>";
echo "SMTP: " . ini_get('SMTP') . "<br>";
echo "smtp_port: " . ini_get('smtp_port') . "<br>";
echo "sendmail_path: " . ini_get('sendmail_path') . "<br>";

// Test 3: Try sending a test email
echo "<h3>Test Email Send:</h3>";

$to = "s.patsariya@gmail.com";
$subject = "Test Email from Portfolio - " . date('Y-m-d H:i:s');
$message = "This is a test email to verify the contact form functionality.\n\nTimestamp: " . date('Y-m-d H:i:s');
$headers = "From: Test <test@" . $_SERVER['HTTP_HOST'] . ">\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

echo "Attempting to send test email to: $to<br>";

if (mail($to, $subject, $message, $headers)) {
    echo "✅ Test email sent successfully!<br>";
    echo "Check your inbox at $to<br>";
} else {
    echo "❌ Failed to send test email<br>";
    $error = error_get_last();
    if ($error) {
        echo "Error: " . $error['message'] . "<br>";
    }
}

// Test 4: Test the actual contact form processing
echo "<h3>Contact Form Processing Test:</h3>";

// Simulate POST data
$_POST = [
    'name' => 'Test User',
    'email' => 'test@example.com',
    'subject' => 'Test Contact Form',
    'message' => 'This is a test message from the contact form.'
];

$_SERVER['REQUEST_METHOD'] = 'POST';

echo "Simulating contact form submission...<br>";

// Include the contact form processor
ob_start();
include 'process-form-simple.php';
$output = ob_get_clean();

echo "Process form output: <pre>$output</pre>";

?>
