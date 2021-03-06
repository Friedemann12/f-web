<?php
// Check for empty fields
if (isset($_POST["send-mail"]) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    http_response_code(501);
    exit();
}

$name = strip_tags(htmlspecialchars($_POST['name']));
$email = strip_tags(htmlspecialchars($_POST['email']));
$message = strip_tags(htmlspecialchars($_POST['message']));

// Create the email and send the message
$to = "julian@friedemann-web.de"; // Add your email address inbetween the "" replacing yourname@yourdomain.com - This is where the form will send a message to.
$subject = "Website Contact Form:  $name";
$body = "You have received a new message from your website contact form.\n\n" . "Here are the details:\n\nName: $name\n\nEmail: $email\n\nMessage:\n$message";
$header = "From: noreply@friedemann-web.de\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$header .= "Reply-To: $email";

if (!mail($to, $subject, $body, $header))
    http_response_code(500);
?>
