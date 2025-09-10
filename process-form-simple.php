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
    error_log("Non-POST request received: " . $_SERVER['REQUEST_METHOD']);
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
    
    // Prepare email content with better formatting
    $email_content = "Contact Form Submission\n";
    $email_content .= "========================\n\n";
    $email_content .= "Name: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Subject: $subject\n";
    $email_content .= "Submitted: " . date('Y-m-d H:i:s') . "\n\n";
    $email_content .= "Message:\n";
    $email_content .= "--------\n";
    $email_content .= "$message\n";
    $email_content .= "--------\n\n";
    $email_content .= "This message was sent from the portfolio contact form.";
    
    // Set email headers with better formatting
    $headers = "From: Portfolio Contact <no-reply@imshivam.com>\r\n";
    $headers .= "Reply-To: $name <$email>\r\n";
    $headers .= "X-Mailer: Portfolio Contact Form\r\n";
    $headers .= "X-Priority: 3\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    
    // Enhanced subject line
    $email_subject = "[Portfolio Contact] $subject";
    
    // Log the attempt
    error_log("Attempting to send email to: $to, from: $name <$email>");
    
    // Attempt to send the email
    if (mail($to, $email_subject, $email_content, $headers)) {
        // Log success
        error_log("Email sent successfully to: $to");
        
        // Try to send an auto-response with better content
        $auto_subject = "Thank you for contacting Shivam Patsariya";
        $auto_message = "Dear $name,\n\n";
        $auto_message .= "Thank you for reaching out through my portfolio website. I have received your message and will respond within 24-48 hours.\n\n";
        $auto_message .= "Your message details:\n";
        $auto_message .= "Subject: $subject\n";
        $auto_message .= "Submitted: " . date('Y-m-d H:i:s') . "\n\n";
        $auto_message .= "I appreciate your interest and look forward to connecting with you.\n\n";
        $auto_message .= "Best regards,\n";
        $auto_message .= "Shivam Patsariya\n";
        $auto_message .= "UI/UX Designer & Digital Strategist\n";
        $auto_message .= "Portfolio: https://imshivam.com";
        
        $auto_headers = "From: Shivam Patsariya <no-reply@imshivam.com>\r\n";
        $auto_headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
        $auto_headers .= "MIME-Version: 1.0\r\n";
        
        // Send auto-response (log but don't fail if it doesn't work)
        if (@mail($email, $auto_subject, $auto_message, $auto_headers)) {
            error_log("Auto-response sent successfully to: $email");
        } else {
            error_log("Auto-response failed for: $email");
        }
        
        // Return success response
        echo json_encode([
            'status' => 'success', 
            'message' => 'Your message has been sent successfully! I will get back to you within 24-48 hours.'
        ]);
    } else {
        throw new Exception("mail() function failed");
    }
} catch (Exception $e) {
    // Enhanced error logging
    error_log("Mail function failed: " . $e->getMessage() . " | To: $to | From: $name <$email>");
    
    // Return user-friendly error response
    echo json_encode([
        'status' => 'error', 
        'message' => 'Sorry, there was an error sending your message. Please try again or contact me directly at s.patsariya@gmail.com'
    ]);
}
?>
