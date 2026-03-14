
<?php
// Check if the form was submitted (the 'submit' button was clicked)
if (isset($_POST['submit'])) {
    
    // 1. --- CONFIGURATION ---
    $to_email = "your_recipient_thoolankit10@gmail.com"; // *** CHANGE THIS TO YOUR EMAIL ADDRESS ***
    $subject_prefix = "New Contact Form Submission: ";

    // 2. --- COLLECT AND CLEAN INPUT DATA ---
    // Sanitize input to prevent basic injection attacks
    $name = htmlspecialchars($_POST['user_name']);
    $email = htmlspecialchars($_POST['user_email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // 3. --- VALIDATION (Basic) ---
    if (empty($name) || empty($email) || empty($subject) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Simple error handling
        echo "<h2>Error!</h2>";
        echo "<p>Please go back and ensure all fields are filled out correctly and the email is valid.</p>";
        // You might redirect the user back to the form here:
        // header("Location: contact.html?error=validation");
        exit;
    }

    // 4. --- COMPOSE THE EMAIL BODY ---
    $email_subject = $subject_prefix . $subject;
    
    $email_body = "You have received a new message from your website contact form.\n\n";
    $email_body .= "Here are the details:\n";
    $email_body .= "Name: " . $name . "\n";
    $email_body .= "Email: " . $email . "\n";
    $email_body .= "Subject: " . $subject . "\n";
    $email_body .= "Message:\n" . $message . "\n";

    // 5. --- SET EMAIL HEADERS ---
    // Set headers to prevent spam/spoofing and allow a reply to the user's email
    $headers = "From: noreply@yourdomain.com\r\n"; // *** CHANGE 'yourdomain.com' to your actual domain ***
    $headerss.= "Reply-To: " . $email . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // 6. --- SEND THE EMAIL ---
    if (mail($to_email, $email_subject, $email_body, $headers)) {
        // Success
        echo "<h2>Thank You!</h2>";
        echo "<p>Your message has been successfully sent. We will get back to you shortly.</p>";
        // You could also redirect to a separate 'thank you' page
        // header("Location: thank-you.html");
    } else {
        // Failure (Often due to server configuration issues)
        echo "<h2>Oops!</h2>";
        echo "<p>Something went wrong, and we couldn't send your message. Please try again or contact us directly.</p>";
    }

} else {
    // If someone tries to access this page directly without submitting the form
    echo "Access Denied. Please submit the form from the contact page.";
}
?>