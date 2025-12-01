<?php
/*
Author: Javed Ur Rehman
Website: https://www.allphptricks.com
Refactored by: Kilo Code
*/

// Set header to return JSON
header('Content-Type: application/json');

// Only allow POST requests
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Sanitize and validate input
    $name = isset($_POST['name']) ? strip_tags(trim($_POST['name'])) : '';
    $email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
    $message = isset($_POST['message']) ? strip_tags(trim($_POST['message'])) : '';

    // Validation checks
    $errors = [];

    if (empty($name)) {
        $errors[] = "Name is required.";
    }

    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (empty($message)) {
        $errors[] = "Message is required.";
    }

    // If there are validation errors, return them
    if (!empty($errors)) {
        http_response_code(400); // Bad Request
        echo json_encode([
            "status" => "error",
            "message" => implode(" ", $errors)
        ]);
        exit;
    }

    // Email configuration
    $to = "youremail@yourdomain.com"; // Replace with actual recipient email
    $subject = "Contact Form Submission from $name";
    
    // Construct email body
    $email_content = "<html><body>";
    $email_content .= "<h2>New Contact Form Submission</h2>";
    $email_content .= "<p><strong>Name:</strong> $name</p>";
    $email_content .= "<p><strong>Email:</strong> $email</p>";
    $email_content .= "<p><strong>Message:</strong><br>" . nl2br($message) . "</p>";
    $email_content .= "</body></html>";

    // Email headers
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: $name <$email>" . "\r\n";
    $headers .= "Reply-To: $email" . "\r\n";

    // Attempt to send email
    // Note: mail() requires a configured mail server (e.g., Sendmail, Postfix)
    if (mail($to, $subject, $email_content, $headers)) {
        echo json_encode([
            "status" => "success",
            "message" => "Thank you for contacting us, we will get back to you shortly."
        ]);
    } else {
        http_response_code(500); // Internal Server Error
        echo json_encode([
            "status" => "error",
            "message" => "Sorry! Your form submission failed. Please try again later."
        ]);
    }

} else {
    // Handle non-POST requests
    http_response_code(405); // Method Not Allowed
    echo json_encode([
        "status" => "error",
        "message" => "Method not allowed."
    ]);
}
?>