<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require __DIR__.'/vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;

function create_recipt($info){
    $html2pdf = new Html2Pdf();
    $html2pdf->writeHTML('<h1>HelloWorld</h1>This is my first test');
    $pdfdoc = $html2pdf->Output('Recipt.pdf', 'S');
    return $pdfdoc;
}




// make a separate file and include this file in that. call this function in that file.

//GUSER --> DB
//GPWD  --> DB

define ('GUSER','email@gmail.com');
define ('GPWD','password');

function smtpmailer($to, $from, $from_name, $subject, $body, $pdfdoc) { 
    global $error;
    $mail = new PHPMailer();  // create a new object
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = false;  // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true;  // authentication enabled
    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
    $mail->SMTPAutoTLS = false;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;

    $mail->Username = GUSER;  
    $mail->Password = GPWD;           
    $mail->SetFrom($from, $from_name);
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->addStringAttachment($pdfdoc, 'Recipt.pdf');
    $mail->AddAddress($to);
    if(!$mail->Send()) {
        $error = 'Mail error: '.$mail->ErrorInfo; 
        return false;
    } else {
        $error = 'Message sent!';
        return true;
    }
}
smtpmailer('shaswat178@gmail.com','shaswatpatel2@gmail.com','shaswat','simple','ok',$pdfdoc);
?>