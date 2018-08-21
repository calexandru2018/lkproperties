<?php
/**
 * This example shows sending a message using PHP's mail() function.
 */
//Import the PHPMailer class into the global namespace
require('../assets/mail/PHPMailer.php');
require('../assets/mail/SMTP.php');
require('../assets/mail/Exception.php');
//Create a new PHPMailer instance
$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->IsSMTP(); // enable SMTP

$mail->SMTPDebug = 2; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail->Host = "mail.lk-properties.pt";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "info@lk-properties.pt";
$mail->Password = "AMnhMg,I*;c[";
$mail->SetFrom($_POST['email'], $_POST['name']);
$mail->Subject = $_POST['subject'].((empty($_POST['date'])) ? '': ' Data: '.$_POST['date']);
$mail->Body = $_POST['description'];
$mail->AddAddress("info@lk-properties.pt");

 if(!$mail->Send()) {
    echo $mail->ErrorInfo;
 } else {
    echo true;
 }
?>