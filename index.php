<?php

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/* Load templete */

$body = file_get_contents('http://localhost/templete-phpmailer/templete-email-html/index.html');

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'mail.domain.com';                   // Set the SMTP server to send through
    $mail->Username   = 'user@domain.com';                      // SMTP username
    $mail->Password   = 'secretpass';                           // SMTP password
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 465;                                    // TCP port to connect to
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );


    /* ---- SIN SSL ---- */
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    // // $mail->isSMTP();                                            // Send using SMTP
    // $mail->Host       = 'mail.rogersco.es';                     // Set the SMTP server to send through
    // $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    // $mail->Username   = 'evento-cocktail@rogersco.es';          // SMTP username
    // $mail->Password   = 'D1BshCzT';                             // SMTP password
    // $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    // $mail->Port       = 587;                                    // TCP port to connect to
    /* ---- END SIN SSL ---- */



    $mail->Encoding = "quoted-printable";
    $mail->CharSet = 'UTF-8';

    //Recipients
    $mail->setFrom('carlosrayon.developer@sitelicon.com', 'Carlos Rayón');
    $mail->addAddress('carlosrayon.developer@sitelicon.com', 'Carlos Rayón');     // Add a recipient
    // $mail->addAddress('examplecopy@example.com');                              // Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    // Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Email de prueba PHPMailer';
    // $mail->Body    = 'Templete email here';
    $mail->Body = $body; /* templete loader */
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if ($mail->send()) {
        echo 'Message has been sent';
    } else {
        echo 'Some error';
    }
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
