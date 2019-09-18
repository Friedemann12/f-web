<?php

// Create the email and send the message
$to = "julian.friedemann@googlemail.com"; // Add your email address inbetween the "" replacing yourname@yourdomain.com - This is where the form will send a message to.
$subject = "Website Contact For";
$body = "You have received a new message from your website contact form.\n\n" . "Here are the details:\n\nNameS";
$header = "From: noreply@yourdomain.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$header .= "Reply";

$send_mail = mail($to, $subject, $body, $header)

    ?>
