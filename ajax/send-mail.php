<?php
/* QUESTION TYPE */
/* 
    1 - Rent question
    2 - Sell/Buy Question
    3 - Feedback
    4 - General Question
*/

if(isset($_POST) && !empty($_POST)){
    foreach($_POST as $key => $value){
        if($key != 'date' && empty($value))
            return false;
    }
    $email = '';
    $subject = '';
    switch ($_POST['type']) {
        case '1':
            $email = 'info@lk-properties.pt';
            $subject = 'Aluguer '.$_POST['publicID'].((!empty($_POST['name'])) ? '; '.$_POST['name']: '').': ' .$_POST['subject'].((empty($_POST['date'])) ? '': ' - Data: '.$_POST['date']);
            break;
        case '2':
            $email = 'info@lk-properties.pt';
            $subject = 'Venda '.$_POST['publicID'].((!empty($_POST['name'])) ? '; '.$_POST['name']: '').': ' .$_POST['subject'].((empty($_POST['date'])) ? '': ' - Data: '.$_POST['date']);
            break;
        case '3':
            $email = 'feedback@lk-properties.pt';
            $subject = 'Feedback'.((!empty($_POST['name'])) ? ' ; '.$_POST['name'].': ': ': ').$_POST['subject'];
            break;
        case '4':
            $email = 'info@lk-properties.pt';
            $subject = 'Info '.$_POST['subject'];
            break;
        default:
            return false;
            break;
    }
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

        // $mail->SMTPDebug = 2; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
        $mail->Host = 'hosting23.serverhs.org';
        $mail->Port = 465; // or 587
        $mail->IsHTML(true);
        $mail->Username = 'info@lk-properties.pt';
        $mail->Password = 'AMnhMg,I*;c[';
        $mail->AddReplyTo($_POST['email'], $_POST['name']);
        $mail->SetFrom($email);
        $mail->Subject = $subject;
        $mail->Body = $_POST['description'];
        $mail->AddAddress($email);
        // $mail->AddAddress('calexandru2018@gmail.com');

        if(!$mail->Send()) {
            return false;
    }
}
?>