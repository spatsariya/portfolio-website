<?php
/**
 * Contact Form Processing for Shivam Patsariya's Portfolio
 */

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
        // Set email recipient (replace with your actual email)
        $to = "contact@shivampatsariya.com";
        
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
            
            // Optional: Save to a database or log file
            // saveToDatabase($name, $email, $subject, $message);
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Sorry, there was an error sending your message. Please try again later.'
            ];
        }
    }
    
    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
} else {
    // If not a POST request, redirect to the homepage
    header("Location: index.php");
    exit;
}

/**
 * Optional function to save contact form submissions to a database
 * Uncomment and implement if you have a database connection
 */
/*
function saveToDatabase($name, $email, $subject, $message) {
    // Database connection parameters
    $host = 'localhost';
    $db = 'portfolio_db';
    $user = 'username';
    $pass = 'password';
    
    try {
        // Connect to database
        $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Prepare and execute query
        $stmt = $pdo->prepare("INSERT INTO contact_submissions (name, email, subject, message, submission_date) VALUES (?, ?, ?, ?, NOW())");
        $stmt->execute([$name, $email, $subject, $message]);
        
        return true;
    } catch (PDOException $e) {
        // Log error (to a file, for example)
        error_log("Database Error: " . $e->getMessage());
        return false;
    }
}
*/
?>