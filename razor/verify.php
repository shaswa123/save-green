<?php

session_start();
require('config.php');
require('../util/util.php');
require('../util/db.php');

require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require __DIR__.'/vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;

$success = true;

$error = "Payment Failed";

$db = new DB;
$db_obj = $db->create_db(3306,"fundraising","root","");

if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);

    try
    {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true)
{
    //GET FROM EMAIL DETAILS

    // store the order_id in database with user_id, phone_num and email_id 
    $html = "<p>Your payment was successful</p>
             <p>Payment ID: {$_POST['razorpay_payment_id']}</p>";
    // print_r($_POST);
    $donor = $db->get_donor_by_email($_POST["email"]);
    if(sizeof($donor) > 0){
        $donor = $donor[0];
    }else{
        if($db->insert_in_donor($_POST) == false){
            header("Location: ../index.php");
        }
        $donor = $db->get_donor_by_email($_POST["email"])[0];
    }
    $data = $_POST;
    $data["donorid"] = $donor["id"];
    $db->insert_in_donations($data);
    //Successful donation
    $html2pdf = new Html2Pdf();
    $html2pdf->writeHTML('
        <html>
            <head>
                <style>
                    .top-div{
                        margin-top:50px;
                    }
                    .date{
                        font-size:20px;
                        font-weight:900;
                        position:absolute;
                        right:1px;
                        top:80px;
                    }
                    .recipt h1{
                        padding-bottom:0!important;
                        margin-bottom:5px;
                    }
                    .recipt p{
                        color:grey;
                    }
                    .cont{
                        border:1px solid grey;
                        margin-top:10px;
                        padding:10px 10px;
                    }
                    .cont p{
                        font-size:18px;
                        font-weight:700;
                    }
                    .sign{
                        margin-top:20px;
                        margin-left:500px;
                    }
                    .sign img{
                        width:100px;
                        height:50px;
                    }
                </style>
            </head>
            <body>
                <div style="width:85%; margin:auto;">
                    <div class="top-div">
                        <img src="public/images/Save-Green-logo-PNG.png" style="width:200px; height:50px;">
                        <div class="date">15-9-2020</div>
                    </div>
                    <div class="recipt" style="margin-top:25px;">
                        <h1>Recipt #12035124</h1>
                        <p>Thank you for your contribution towards the COVID 19 campaign.</p>
                    </div>
                    <div class="amt">
                        <h2>Total contribution : Rs 50.00</h2>
                    </div>
                    <div class="cont">
                        <p><pre>Contributed by         :    Shaswat P Patel</pre></p>
                        <p><pre>Name of organization   :    Save Green</pre></p>
                        <p><pre>Contact number         :    9998070108</pre></p>
                        <p><pre>Email ID               :    savegreen@gmail.com</pre></p>
                        <p><pre>Website                :    savegreen.com</pre></p>
                        <p><pre>Address                :    Regent Insingnia, No. 414, 3rd floor,
                            4th block, 17th Main, 100 feet road, 
                            Koramangala, Bengaluru - 560034</pre></p>
                        <p><pre>PAN                    :    XYZ</pre></p>
                        <p><pre>80G approval reference :    Donations are exempt under Section 80G 
                            of the IT Act 1961 vide order: 
                            No. CIT (E)/AAATO5745J/ITO (E)-2/2018-19</pre></p>
                    </div>
                    <div class="sign">
                        <img src="public/images/Save-Green-logo-PNG.png">
                        <p>Shaswat Patel, Volunteer</p>
                    </div>
                </div>
            </body>
        </html>
    ');
    $pdf = $html2pdf->output('', 'S');
    function smtpmailer($to, $from, $from_pass, $from_name, $subject, $body, $pdfdoc) {
        global $error;
        $mail = new PHPMailer();  // create a new object
        $mail->IsSMTP(); // enable SMTP
        $mail->SMTPDebug = false;  // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true;  // authentication enabled
        $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
        $mail->SMTPAutoTLS = false;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;

        $mail->Username = $from;  
        $mail->Password = $from_pass;

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

    smtpmailer($_POST['email'], $from, $from_pass, $from_name, $sub, $body, $pdf);
    header("Location : ../thankyou.php");
    // header("Location: ../index.php");
    //Array ( [shopping_order_id] => 0 [campid] => 19 [name] => Shaswat P Patel [phoneNumber] => 6358099361 [email] => shaswat178@gmail.com [address] => B-205, BH-1, NSIT, [razorpay_payment_id] => pay_Eu94j4So6HrQHi [razorpay_order_id] => order_Eu94bMmtkSEkax [razorpay_signature] => 0f4cf945841084f257f600566cca10b1be02087f52de21d6d7f672b73d977d98 )
}
else
{
    $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
}

echo $html;

//Array ( [shopping_order_id] => 3456 [razorpay_payment_id] => pay_EtMW6iXocEfmiV [razorpay_order_id] => order_EtMVzmkq6rAamE [razorpay_signature] => e23b661d4ff1abfe4b350eefdc0734965bae8686d783505eb95d38bb79cca09f )

/*

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

    function smtpmailer($to, $from, $from_pass, $from_name, $subject, $body, $pdfdoc) {
        global $error;
        $mail = new PHPMailer();  // create a new object
        $mail->IsSMTP(); // enable SMTP
        $mail->SMTPDebug = false;  // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true;  // authentication enabled
        $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
        $mail->SMTPAutoTLS = false;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;

        $mail->Username = $from;  
        $mail->Password = $from_pass;

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
*/