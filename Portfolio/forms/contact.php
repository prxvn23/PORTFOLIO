<?php
// Set your email address
$to = "pravinjordan023@gmail.com";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = strip_tags(trim($_POST["name"]));
    $email   = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = strip_tags(trim($_POST["subject"]));
    $message = trim($_POST["message"]);

    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        http_response_code(400);
        echo "Please fill in all fields.";
        exit;
    }

    // Compose email
    $email_content  = "Name: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Subject: $subject\n\n";
    $email_content .= "Message:\n$message\n";

    // Send email
    $success = mail($to, $subject, $email_content, "From: $name <$email>");

    if ($success) {
        http_response_code(200);
        echo "Message sent successfully.";
    } else {
        http_response_code(500);
        echo "Something went wrong, try again later.";
    }
} else {
    http_response_code(403);
    echo "There was a problem with your submission.";
}
?>
