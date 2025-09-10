<?php
/**
 * Debug Contact Form Requests
 * This file will help us understand what's happening with form submissions
 */

// Enable error logging
ini_set('log_errors', 1);
ini_set('error_log', 'contact-form-debug.log');

// Log all request details
$log_data = [
    'timestamp' => date('Y-m-d H:i:s'),
    'method' => $_SERVER['REQUEST_METHOD'] ?? 'UNKNOWN',
    'url' => $_SERVER['REQUEST_URI'] ?? 'UNKNOWN',
    'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'UNKNOWN',
    'post_data' => $_POST,
    'headers' => getallheaders(),
    'raw_input' => file_get_contents('php://input')
];

error_log("Contact Form Debug: " . json_encode($log_data));

// Set content type
header('Content-Type: application/json');

// Response for debugging
echo json_encode([
    'status' => 'debug',
    'message' => 'Debug endpoint reached successfully',
    'data' => $log_data
]);
?>
