<?php
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require '../Plugin/PHPmailer/phpmailer/phpmailer/src/PHPMailer.php';
require '../Plugin/PHPmailer/phpmailer/phpmailer/src/SMTP.php';
require '../Plugin/PHPmailer/phpmailer/phpmailer/src/Exception.php';
require '../Plugin/PHPmailer/autoload.php';


$Name="GYMKHANA";
$Host='smtp.gmail.com';
$Port=587;
$SmtpUsername="ferruccio.cinema2023@gmail.com";
$SmtpPassword="glkjrerfrlzrxugn";

function sendEmail($to,$session_number){
    Global $Name,$Host,$Port,$SmtpUsername,$SmtpPassword;

    $status="300";
    $error="";
    $mail = new PHPMailer(true);
    try {
    //SENDER
    $mail->isSMTP();  
    $mail->Host       = $Host;
    $mail->SMTPAuth   = true;                             
    $mail->Username   = $SmtpUsername;                  
    $mail->Password   = $SmtpPassword;                             
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;          
    $mail->Port       = $Port;
    
    //RECEIVER
    $mail->setFrom($SmtpUsername, "Test");
    $mail->addAddress($to); 

    //CONTENT
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is you 6 Digit code';
    $mail->Body = '<p>Your 6 Digit code is <b>'.$session_number.'</b></p>
                   <p style="color:red;">Don\'t tell other people this 6 digit code to protect with your personal data</p>';
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $mail->send();
    $status="200";
    $error="null";
      
    } catch (Exception $e) {
        $error=$mail->ErrorInfo;
    }
    $array['status']=$status;
    $array['error']=$error;
    return $array;
}