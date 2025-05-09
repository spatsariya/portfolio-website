<?php
/**
 * Contact Form Processing for Shivam Patsariya's Portfolio
 * Using PHPMailer for more reliable email delivery
 */

// Turn off error display for production
ini_set('display_errors', 0);
error_reporting(E_ALL);
ini_set('log_errors', 1);
ini_set('error_log', 'php-mail-errors.log');

// Ensure we always return JSON, even if there's a fatal error
register_shutdown_function(function() {
    $error = error_get_last();
    if ($error && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) {
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'error',
            'message' => 'An unexpected error occurred. Please try again later.'
        ]);
        exit;
    }
});

// Create directory for PHPMailer if it doesn't exist
if (!file_exists('vendor/PHPMailer')) {
    mkdir('vendor/PHPMailer', 0777, true);
}

// PHPMailer dependencies - use already downloaded files
if (file_exists('vendor/PHPMailer/PHPMailer.php') && 
    file_exists('vendor/PHPMailer/SMTP.php') && 
    file_exists('vendor/PHPMailer/Exception.php')) {
    
    require 'vendor/PHPMailer/PHPMailer.php';
    require 'vendor/PHPMailer/SMTP.php';
    require 'vendor/PHPMailer/Exception.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

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
        echo json_encode(['status' => 'error', 'message' => 'Please fill all required fields']);
        exit;
    }

    // Sanitize inputs but keep original structure
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars($_POST['message']);
    $subject = !empty($_POST['subject']) ? htmlspecialchars($_POST['subject']) : 'Contact Form Submission from Portfolio';

    try {
        // First email: Notification to admin
        $mail = new PHPMailer(true);
        
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.hostinger.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'no-reply@eazyhaven.com';
        $mail->Password   = 'E@$Y#@ven2025';
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;
        $mail->Timeout    = 30; // Set timeout to 30 seconds
        
        // Enable debugging for troubleshooting - comment out in production
        $mail->SMTPDebug  = 0; // 0 = off, 1 = client messages, 2 = client and server messages
        
        // Recipients
        $mail->setFrom('no-reply@eazyhaven.com', 'Shivam Patsariya');
        $mail->addAddress('s.patsariya@gmail.com'); // Your receiving email
        $mail->addReplyTo($email, $name);

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = "
            <strong>Name:</strong> {$name}<br>
            <strong>Email:</strong> {$email}<br>
            <strong>Message:</strong><br>" . nl2br($message);

        // Send first email
        $mail->send();

        // Second email: Auto-response to the user
        $autoResponse = new PHPMailer(true);
        
        // Server settings (same as above)
        $autoResponse->isSMTP();
        $autoResponse->Host       = 'smtp.hostinger.com';
        $autoResponse->SMTPAuth   = true;
        $autoResponse->Username   = 'no-reply@eazyhaven.com';
        $autoResponse->Password   = 'E@$Y#@ven2025';
        $autoResponse->SMTPSecure = 'ssl';
        $autoResponse->Port       = 465;
        $autoResponse->Timeout    = 30; // Set timeout to 30 seconds
        
        // Recipients for auto-response
        $autoResponse->setFrom('no-reply@eazyhaven.com', 'Shivam Patsariya');
        $autoResponse->addAddress($email, $name);

        // Content for auto-response
        $autoResponse->isHTML(true);
        $autoResponse->Subject = "Thank you for contacting Shivam Patsariya";
        $autoResponse->Body    = "
            <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;'>
                <div style='background-color: #6e57e0; padding: 20px; text-align: center;'>
                    <h1 style='color: #ffffff; margin: 0;'>Shivam Patsariya</h1>
                </div>
                <div style='padding: 20px; background-color: #f9f9f9; border: 1px solid #e0e0e0;'>
                    <h2 style='color: #333333;'>Thank You for Reaching Out!</h2>
                    <p>Dear {$name},</p>
                    <p>I have received your message and appreciate you taking the time to contact me. I will review your inquiry and get back to you as soon as possible.</p>
                    <p>Thank you for your interest in my portfolio and work.</p>
                    <p>Best regards,<br>Shivam Patsariya</p>
                </div>
                <div style='background-color: #333333; color: #ffffff; padding: 15px; text-align: center; font-size: 12px;'>
                    <p>&copy; " . date('Y') . " Shivam Patsariya. All rights reserved.</p>
                </div>
            </div>";

        // Try to send the auto-response (but continue even if it fails)
        try {
            $autoResponse->send();
        } catch (Exception $e) {
            // Log error but don't stop execution
            error_log("Failed to send auto-response: " . $e->getMessage());
        }
        
        // Return success JSON response
        echo json_encode(['status' => 'success', 'message' => 'Your message has been received. Thank you for contacting me!']);
    } catch (Exception $e) {
        // Return error JSON response
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Failed to send email. Please try again later.']);
        // Log the error (but don't expose it to the user)
        error_log("Mail sending failed: " . $e->getMessage());
        // Uncomment the line below for debugging in development environment
        // echo json_encode(['status' => 'error', 'message' => 'Error: ' . $e->getMessage()]);
    }
} else {
    // If PHPMailer files are not available, fall back to the old mail() function
    header('Content-Type: application/json');
    
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get form data
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
        $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
        
        // Validate data
        if (empty($name) || empty($email) || empty($message)) {
            $response = [
                'status' => 'error',
                'message' => 'Please fill in all required fields.'
            ];
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $response = [
                'status' => 'error',
                'message' => 'Please enter a valid email address.'
            ];
        } else {
            // Set email recipient
            $to = "s.patsariya@gmail.com";
            
            // If subject is empty, set a default
            if (empty($subject)) {
                $subject = "New Contact Form Submission from Portfolio";
            }
            
            // Prepare email content
            $email_content = "Name: $name\n";
            $email_content .= "Email: $email\n\n";
            $email_content .= "Message:\n$message\n";
            
            // Set email headers
            $headers = "From: $name <$email>\r\n";
            $headers .= "Reply-To: $email\r\n";
            
            // Attempt to send the email
            if (mail($to, $subject, $email_content, $headers)) {
                $response = [
                    'status' => 'success',
                    'message' => 'Your message has been sent successfully!'
                ];
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'Sorry, there was an error sending your message. Please try again later.'
                ];
            }
        }
        
        // Return JSON response
        echo json_encode($response);
        exit;
    } else {
        // If not a POST request, redirect to the homepage
        header("Location: index.php");
        exit;
    }
}
?>
