<?php
    require('config.php');
    require('razorpay-php/Razorpay.php');
    // Create the Razorpay Order
    use Razorpay\Api\Api;
    $api = new Api($keyId, $keySecret);
    
    //
    // We create an razorpay order using orders api
    // Docs: https://docs.razorpay.com/docs/orders
    //
    
    $shopping_id = rand() * 10 + $_POST["campid"];

    $orderData = [
        'receipt'         => $shopping_id,
        'amount'          => $_POST["donateAmount"] * 100, // 2000 rupees in paise
        'currency'        => 'INR',
        'payment_capture' => 1 // auto capture
    ];
    
    
    $razorpayOrder = $api->order->create($orderData);
    
    $razorpayOrderId = $razorpayOrder['id'];
    
    $_SESSION['razorpay_order_id'] = $razorpayOrderId;
    
    $displayAmount = $amount = $orderData['amount'];
    
    if ($displayCurrency !== 'INR')
    {
        $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
        $exchange = json_decode(file_get_contents($url), true);
    
        $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
    }
    
    $email = $_POST["emailId"];
    
    $data = [
        "key"               => $keyId,
        "amount"            => $amount,
        "name"              => "Save Green",
        "description"       => "Paying for ".$camp[0]["title"], // Have paying for a particular fund raiser
        "image"             => "https://i.ibb.co/Z2WCFHj/bd8acb076055.png",
        "prefill"           => [
        "name"              => $_POST["name"], // GET from session the user's name
        "email"             => $email, // EMAIL
        "contact"           => $_POST["phoneNumber"] // number AND address (IDK about address)
        ],
        "notes"             => [
        "address"           => $_POST["address"],
        "merchant_order_id" => "12312321",
        ],
        "theme"             => [
        "color"             => "#F37254"
        ],
        "order_id"          => $razorpayOrderId,
        "shopping_id"       => $shopping_id
    ];
    
    if ($displayCurrency !== 'INR')
    {
        $data['display_currency']  = $displayCurrency;
        $data['display_amount']    = $displayAmount;
    }
    
    $json = json_encode($data);    

require("checkout/automatic.php");
