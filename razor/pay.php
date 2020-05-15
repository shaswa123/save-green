<?php
    require('config.php');
    require('razorpay-php/Razorpay.php');
    // Create the Razorpay Order
    use Razorpay\Api\Api;
    session_start();
    $api = new Api($keyId, $keySecret);
    
    //
    // We create an razorpay order using orders api
    // Docs: https://docs.razorpay.com/docs/orders
    //
    $orderData = [
        'receipt'         => 3456,
        'amount'          => $_POST["donate-amount"] * 100, // 2000 rupees in paise
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
    
    
    
    $data = [
        "key"               => $keyId,
        "amount"            => $amount,
        "name"              => "Save Green",
        "description"       => "Paying for", // Have paying for a particular fund raiser
        "image"             => "http://localhost/save-green/public/images/Save-Green-log-PNG.png",
        "prefill"           => [
        "name"              => "Shaswat", // GET from session the user's name
        "email"             => "customer@merchant.com", // EMAIL
        "contact"           => "9999999999", // number AND address (IDK about address)
        ],
        "notes"             => [
        "address"           => "Hello World",
        "merchant_order_id" => "12312321",
        ],
        "theme"             => [
        "color"             => "#F37254"
        ],
        "order_id"          => $razorpayOrderId,
    ];
    
    if ($displayCurrency !== 'INR')
    {
        $data['display_currency']  = $displayCurrency;
        $data['display_amount']    = $displayAmount;
    }
    
    $json = json_encode($data);    

require("checkout/automatic.php");
