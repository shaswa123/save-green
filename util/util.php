<?php 

    require __DIR__.'/../vendor/autoload.php';
    

    function get_encrypt_pass($pass)
    {
        $ciphering = "AES-128-CTR";
        $iv_length = openssl_cipher_iv_length($ciphering); 
        $options = 0;
        $salt = "this_is_amazing_salt_0104124";
        $encryption_iv = "1102935159209143"; 
        $encryption_key = "save_green_0101";
        $pass = $pass.$salt;
        $encryption = openssl_encrypt($pass, $ciphering, $encryption_key, $options, $encryption_iv); 
        return $encryption;
    }
    function get_email_code($name){
        $ciphering = "AES-128-CTR";
        $iv_length = openssl_cipher_iv_length($ciphering); 
        $options = 0;
        $salt = "email_verify";
        $encryption_iv = "1102935159209143"; 
        $encryption_key = "email_code_1201";
        $pass = $name.$salt;
        $encryption = openssl_encrypt($pass, $ciphering, $encryption_key, $options, $encryption_iv); 
        return $encryption;
    }

    function confirmation_email($EMAIL, $code)
    {
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
        $mail->Password = $EMAIL['EMAIL_PASS'];

        $mail->SetFrom($EMAIL['EMAIL_FROM'], $EMAIL['EMAIL_FROM_NAME']);
        $mail->Subject = $EMAIL['EMAIL_SUBJECT'];
        $mail->Body = $EMAIL['EMAIL_BODY']." ".$code;
        $mail->AddAddress($EMAIL['EMAIL_TO']);
        if(!$mail->Send()) { 
            return false;
        } else {
            return true;
        }
    }

    function get_encrypted_id($id)
    {
        $ciphering = "AES-128-CTR";
        $iv_length = openssl_cipher_iv_length($ciphering); 
        $options = 0;
        $encryption_iv = "1102935159209150"; 
        $encryption_key = "get_one_fundraiser";
        $salt = "thisit_";
        $id = $salt.$id;
        $encryption = openssl_encrypt($id, $ciphering, $encryption_key, $options, $encryption_iv); 
        return $encryption;
    }

    function get_decrypted_id($encrypted)
    {
        $ciphering = 'AES-128-CTR';
        $iv_length = openssl_cipher_iv_length($ciphering); 
        $options = 0; 
        // Store the decryption key 
        $decryption_iv = "1102935159209150";
        $decryption_key = "get_one_fundraiser"; 
        
        // Use openssl_decrypt() function to decrypt the data 
        $decryption=openssl_decrypt ($encrypted, $ciphering, $decryption_key, $options, $decryption_iv);
        // print($decryption);
        return $decryption;
    }


    function get_order_id(){
        $temp = rand(10000,99999999);
        $en = get_encrypted_id($temp."".time());
        return "ORDS".str_split($en, 10)[0];
    }

    

?>