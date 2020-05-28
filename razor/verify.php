<?php

session_start();
require('config.php');
require('../util/util.php');
require('../util/db.php');

require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

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
    // store the order_id in database with user_id, phone_num and email_id 
    $html = "<p>Your payment was successful</p>
             <p>Payment ID: {$_POST['razorpay_payment_id']}</p>";
    print_r($_POST);
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
    header("Location: ../index.php");
    //Array ( [shopping_order_id] => 0 [campid] => 19 [name] => Shaswat P Patel [phoneNumber] => 6358099361 [email] => shaswat178@gmail.com [address] => B-205, BH-1, NSIT, [razorpay_payment_id] => pay_Eu94j4So6HrQHi [razorpay_order_id] => order_Eu94bMmtkSEkax [razorpay_signature] => 0f4cf945841084f257f600566cca10b1be02087f52de21d6d7f672b73d977d98 )
}
else
{
    $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
}

echo $html;

//Array ( [shopping_order_id] => 3456 [razorpay_payment_id] => pay_EtMW6iXocEfmiV [razorpay_order_id] => order_EtMVzmkq6rAamE [razorpay_signature] => e23b661d4ff1abfe4b350eefdc0734965bae8686d783505eb95d38bb79cca09f )