<?php

// $email and $message are the data that is being
// posted to this page from our html contact form
$email = $_REQUEST['email'] ;
$message = $_REQUEST['message'] ;

require_once('class.phpmailer.php');
require 'PHPMailerAutoload.php';
require 'class.smtp.php';


$mail = new PHPMailer;

$mail->IsSMTP();                                      // Set mailer to use SMTP
$mail->Host = "smtp.gmail.com";                 // Specify main and backup server
$mail->Port = 587;                                    // Set the SMTP port
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = "nikhil.de.2000@gmail.com";                // SMTP username
$mail->Password = "nikhil123";                  // SMTP password
$mail->SMTPSecure = "tls";                            // Enable encryption, 'ssl' also      accepted

$mail->From = "nikhil.de.2000@gmail.com";
$mail->FromName = "App";
$mail->AddAddress ($email);  // Add a recipient

$mail->IsHTML(true);                                  // Set email format to HTML

$mail->Subject = " Subject";
$mail->Body    = " working fine";
$mail->AltBody = "This is the body in plain text for non-HTML mail clients";

if(!$mail->Send()) {
echo 'Message could not be sent.';
echo 'Mailer Error: ' . $mail->ErrorInfo;
exit;
}

echo "Message has been sent";
?>