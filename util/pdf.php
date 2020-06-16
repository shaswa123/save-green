<?php
    require __DIR__.'/../vendor/autoload.php';
    use Spipu\Html2Pdf\Html2Pdf;

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    function pdf_and_email($DATA,$EMAIL){
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
                            <img src="../public/images/Save-Green-logo-PNG.png" style="width:200px; height:50px;">
                            <div class="date">'.$DATA['DATE'].'</div>
                        </div>
                        <div class="recipt" style="margin-top:25px;">
                            <h1>Recipt #'.$DATA['RECIPT_ID'].'</h1>
                            <p>Thank you for your contribution towards the '.$DATA['CAMPAIGN_NAME'].' campaign.</p>
                        </div>
                        <div class="amt">
                            <h2>Total contribution : Rs '.$DATA['CONTRIBUTION_AMOUNT'].'</h2>
                        </div>
                        <div class="cont">
                            <p>Contributed by : '.$DATA['DONOR_NAME'].'</p>
                            <p>Name of organization :    '.$DATA['ORG_NAME'].'</p>
                            <p>Contact number : '.$DATA['ORG_PHONE_NUMBER'].'</p>
                            <p>Email ID : '.$DATA['ORG_EMAIL'].'</p>
                            <p>Website :    '.$DATA['ORG_WEBSITE_URL'].'</p>
                            <p>Address :  '.$DATA['ORG_ADDRESS'].'</p>
                            <p>PAN                    :  '.$DATA['PAN_CARD'].'</p>
                            <p>80G approval reference :    Donations are exempt under Section 80G 
                                of the IT Act 1961 vide order: 
                                '.$DATA['G'].'</p>
                        </div>
                        <div class="sign">
                            <img src="../public/images/Save-Green-logo-PNG.png">
                            <p>'.$DATA['PRESIDENT_NAME'].', President</p>
                        </div>
                    </div>
                </body>
            </html>
        ');
        
        $pdfFile =  $html2pdf->output('', 'S');
        
        global $error;
        $mail = new PHPMailer();  // create a new object
        $mail->IsSMTP(); // enable SMTP
        $mail->SMTPDebug = false;  // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true;  // authentication enabled
        $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
        $mail->SMTPAutoTLS = false;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;

        $mail->Username = $EMAIL['EMAIL_FROM'];  
        $mail->Password = $EMAIL['EMAIL_PASSWORD'];

        $mail->SetFrom($EMAIL['EMAIL_FROM'], $EMAIL['EMAIL_FROM_NAME']);
        $mail->Subject = $EMAIL['EMAIL_SUBJECT'];
        $mail->Body = $EMAIL['EMAIL_BODY'];
        //IF $PDF EQUALS 0 => WE DO NOT HAVE ANY ATTACHMENT
        $mail->addStringAttachment($pdfFile, 'Recipt.pdf');
        $mail->AddAddress($EMAIL['EMAIL_TO']);
        if(!$mail->Send()) { 
            return false;
        } else {
            return true;
        }
    }
?>