<?php

session_start();
require('config.php');
require('../util/util.php');
require('../util/db.php');

require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;


require('../util/pdf.php');


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
    //CAMPAIGN CERATER'S NAME
    $CAMPAGIN = $db->get_campaigns_by_id($_POST["campid"])[0];
    $USER_ID = $CAMPAGIN["userID"];
    $USER = $db->get_user_by_id($USER_ID)[0];


    //GET FROM EMAIL DETAILS
    $emailDetails = $db->get_from_email();
    $FROM_ADDRESS = $emailDetails[0]["address"];     //GET EMAIL FROM ADDRESS
    $FROM_PASSWORD = $emailDetails[0]["pass"];    //GET EMAIL FROM PASSWORD
    $EMAIL_SUBJECT = $emailDetails[0]["subject"];    //GET EMAIL SUBJECT
    $EMAIL_BODY = $emailDetails[0]["body"];    //GET EMAIL BODY`
    // $FROM_NAME = $db->get_user_by_id($db->get_campaigns_by_id($_POST["campid"])[0]["userID"])[0];    
    //GET NAME OF THE CAMPAIGN CREATER
    $FROM_NAME = isset($USER['lastName']) == true ? $USER['firstName']." ".$USER["lastName"] : $USER["firstName"];

    // NGO DETAILS
    $ngoDetails = $db->get_from_ngo_details();
    $ORG_NAME = $ngoDetails[0]["orgnization_name"];     //GET ORGANIZATION's NAME
    $PHONE_NUM = $ngoDetails[0]["phonenum"];        //GET ORGANIZATION's PHONE NUMBER
    $PAN_CARD = $ngoDetails[0]["pancard"];      //GET ORGANIZATION's PAN CARD NUMBER
    $NGO_EMAIL = $ngoDetails[0]["email"];       //GET NGO's EMAIL ADDRESS
    $A = $ngoDetails[0]["A"];       //GET NGO's A
    $G = $ngoDetails[0]["G"];       //GET NGO's 80-G

    // GET CURRENT DATE
    $CURRENT_DATE = date("d/m/Y");

    // GET RECIPT_ID, CONTRIBUTION_AMOUNT FROM POST DATA
    $RECIPT_ID = $_POST["shopping_order_id"];
    $CONTRIBUTION_AMOUNT = $_POST["amount"];

    // GET CAMPAIGN NAME USING CAMPAIGN ID
    $CAMPAGIN_NAME = $db->get_campaigns_by_id($_POST["campid"])[0]["title"];

    // OBJECT OF DATA WHICH WILL BE USED BY CREATE PDF FUNCTION
    $PDF_DATA['DATE'] = $CURRENT_DATE;
    $PDF_DATA['RECIPT_ID'] = $RECIPT_ID;
    $PDF_DATA['CAMPAIGN_NAME'] = $CAMPAGIN_NAME;
    $PDF_DATA['CONTRIBUTION_AMOUNT'] = $CONTRIBUTION_AMOUNT;
    $PDF_DATA['DONOR_NAME'] = ''; //THIS IS ASSIGNED AFTER DONOR IS INSERTED IN THE DB
    $PDF_DATA['ORG_NAME'] = $ORG_NAME;
    $PDF_DATA['ORG_PHONE_NUMBER'] = $PHONE_NUM;
    $PDF_DATA['ORG_EMAIL'] = $NGO_EMAIL;
    $PDF_DATA['ORG_WEBSITE_URL'] = '';
    $PDF_DATA['ORG_ADDRESS'] = '';
    $PDF_DATA['PAN_CARD'] = $PAN_CARD;
    $PDF_DATA['A'] = $A;
    $PDF_DATA['G'] = $G;
    $PDF_DATA['PRESIDENT_NAME'] = '';

    // IF GIVEN PERMISSION FOR 80-G OR 12-A


    // CHECK IF DONOR ALREADY EXISTS IN OUR DB
    $donor = $db->get_donor_by_email($_POST["email"]);
    if(sizeof($donor) > 0){     //IF IT DOES THEN ASSIGN THE DONOR TO A VAR
        $donor = $donor[0];
    }else{      //IF DONOR DOES NOT EXISTS INSERT INTO THE DB
        if($db->insert_in_donor($_POST) == false){
            //ERROR WHILE INSERTING IN DB
            header("Location: ../thankyou.php");
            return;
        }
        $donor = $db->get_donor_by_email($_POST["email"])[0];
    }
    
    $PDF_DATA['DONOR_NAME'] = $donor['name'];   //FOR PDF GENERATION

    // Successful donation
    $data = $_POST;
    $data["donorid"] = $donor["id"];
    if($db->insert_in_donations($data) == false){
        header("Location: ../thankyou.php");
        return;
    }

    //OBJECT FOR EMAIL
    $EMAIL['EMAIL_FROM'] = $FROM_ADDRESS;
    $EMAIL['EMAIL_FROM_NAME'] = $FROM_NAME;
    $EMAIL['EMAIL_PASSWORD'] = $FROM_PASSWORD;
    $EMAIL['EMAIL_SUBJECT'] = $EMAIL_SUBJECT;
    $EMAIL['EMAIL_BODY'] = $EMAIL_BODY;
    $EMAIL['EMAIL_TO'] = $donor['email'];

    if(pdf_and_email($PDF_DATA, $EMAIL) == false){
        $_SESSION["PAYMENT_ERROR"] = "There was an issue while sending a recipt email, please contact us through email for recipt. Thank you for your contribution!";
    }

    header('Location: ../thankyou.php');
    return;
}
else
{
    // Your payment failed
    header('../index.php');
    return;
}



// Array ( [shopping_order_id] => 0 [campid] => 19 [name] => Shaswat P Patel [phoneNumber] => 6358099361 [email] => shaswat178@gmail.com [address] => B-205, BH-1, NSIT, [razorpay_payment_id] => pay_Eu94j4So6HrQHi [razorpay_order_id] => order_Eu94bMmtkSEkax [razorpay_signature] => 0f4cf945841084f257f600566cca10b1be02087f52de21d6d7f672b73d977d98 )
?>