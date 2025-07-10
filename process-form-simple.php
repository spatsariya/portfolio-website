<?php
/**
 * Simple Contact Form Processing for Shivam Patsariya's Portfolio
 * Fallback version using PHP mail() function
 */

// Disable error display for production
ini_set('display_errors', 0);
error_reporting(E_ALL);
ini_set('log_errors', 1);
ini_set('error_log', 'php-mail-errors.log');

// Set the content type to JSON
header('Content-Type: application/json');

// Check if the request is a POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
    exit;
}

// Form validation
if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['message'])) {
    http_response_code(400);
    echo json_encode([
        'status' => 'error', 
        'message' => 'Please fill all required fields',
        'errors' => [
            'name' => empty($_POST['name']) ? 'Name is required' : null,
            'email' => empty($_POST['email']) ? 'Email is required' : null,
            'message' => empty($_POST['message']) ? 'Message is required' : null
        ]
    ]);
    exit;
}

// Email validation
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode([
        'status' => 'error', 
        'message' => 'Please enter a valid email address',
        'errors' => ['email' => 'Invalid email format']
    ]);
    exit;
}

// Sanitize inputs but keep original structure
$name = htmlspecialchars($_POST['name']);
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$message = htmlspecialchars($_POST['message']);
$subject = !empty($_POST['subject']) ? htmlspecialchars($_POST['subject']) : 'Contact Form Submission from Portfolio';

try {
    // Set email recipient
    $to = "s.patsariya@gmail.com";
    
    // Prepare email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";
    
    // Set email headers
    $headers = "From: Portfolio Contact Form <no-reply@shivampatsariya.com>\r\n";
    $headers .= "Reply-To: $name <$email>\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    
    // Attempt to send the email
    if (mail($to, $subject, $email_content, $headers)) {
        // Try to send an auto-response
        $auto_subject = "Thank you for contacting Shivam Patsariya";
        $auto_message = "Dear $name,\n\n";
        $auto_message .= "Thank you for reaching out to me through my portfolio website. I have received your message and will get back to you soon.\n\n";
        $auto_message .= "Best regards,\nShivam Patsariya";
        
        $auto_headers = "From: Shivam Patsariya <no-reply@shivampatsariya.com>\r\n";
        $auto_headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
        
        // Send auto-response (don't worry if it fails)
        @mail($email, $auto_subject, $auto_message, $auto_headers);
        
        // Return success response
        echo json_encode(['status' => 'success', 'message' => 'Your message has been sent successfully!']);
    } else {
        throw new Exception("mail() function failed");
    }
} catch (Exception $e) {
    // Log error and return error response
    error_log("Mail function failed: " . $e->getMessage());
    echo json_encode(['status' => 'error', 'message' => 'Sorry, there was an error sending your message. Please try again later.']);
}
?>
