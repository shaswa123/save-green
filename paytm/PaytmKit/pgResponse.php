<?php
session_start();
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");

$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application�s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.

$order_id;
$payment_amount;
// if(isset($_SESSION["orderid"])&& isset($_SESSION["amount"])){
// 	$order_id = $_SESSION["orderid"];
// 	$payment_amount = $_SESSION["amount"];
// }else{
// 	header("Location: index-final.php");
// }

if($isValidChecksum == "TRUE") {
	if ($_POST["STATUS"] == "TXN_SUCCESS") {
		//Process your transaction here as success transaction.
		//Verify amount & order id received from Payment gateway with your application's order id and amount.
		// if($_POST["ORDERID"] == $order_id && $_POST["TXNAMOUNT"] == $payment_amount){
		// 	//save in DB
		// }else{
		// 	$_SESSION["error"] = "Transaction Failed! Please try again.";
		// 	header("Location: index-final.php");
		// }
	}
	else {
		// Fail
		$_SESSION["error"] = "Transaction Failed! Please try again.";
		header("Location: index-final.php");
	}

	if (isset($_POST) && count($_POST)>0 )
	{ 
		foreach($_POST as $paramName => $paramValue) {
				echo "<br/>" . $paramName . " = " . $paramValue;
		}
	}
	

}
else {
	//Process transaction as suspicious.
	// redirect to the home page
	header('Location: index-final.php');
}

/*
CURRENCY = INR
GATEWAYNAME = WALLET
BANKNAME = WALLET
TXNID = 20200517111212800110168449501529763
TXNAMOUNT = 100.00
ORDERID = ORDS70314364
BANKTXNID = 62459919
TXNDATE = 2020-05-17 21:20:06.0
*/

/*
	We can also store
	CAMPID
	DONORID
	DONOREMAIL
	DONORNAME --> DONORFIRSTNAME, DONORMIDDLENAME, DONORLASTNAME
	DONORADDRESS
	DONORPHONENUMBER
	DONORPANCARDNUMBER

*/

/*
	Before we store anything we will check if the donor exists in the DB.
	If they do then we not assign a new DONORID
*/

?>
