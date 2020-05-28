<?php 
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

    function confirmation_email($email_to,$name, $code)
    {
        $to = $email_to;
        $subject = 'Confirmation code';
        $from = 'shaswat178@gmail.com';
         
        // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
         
        // Create email headers
        $headers .= 'From: '.$from."\r\n".
            'Reply-To: '.$from."\r\n" .
            'X-Mailer: PHP/' . phpversion();
         
        // Compose a simple HTML email message
        $message = '<html><body>';
        $message .= '<h1>Hi, '.$name.'</h1>';
        $message .= '<p style="font-size:"14px">Thank you for joining save green fund raising website. The confirmation code: <b>'.$code.'</b></p>';
        $message .= '<p style="font-size:12px; color:rgba(0,0,0,0.7);">Please confirm within 48 hours.</p>';
        $message .= '</body></html>';
         
        // Sending email
        if(mail($to, $subject, $message, $headers)){
            return true;
        } else{
            return false;
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

    function use_API()
    {
        $access_key = "LtKbygISZtRrYfS--91qH9G3Lt-XUiHJ5Z1p9nabrpE";
        $secret_key = "vdIfTlMlvVjB1ZItUVNe74M6gR4O_pqk75FssbYAFVE";
        $url = "https://api.unsplash.com/photos/?client_id=".$access_key;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    function get_order_id(){
        $temp = rand(10000,99999999);
        $en = get_encrypted_id($temp."".time());
        return "ORDS".str_split($en, 10)[0];
    }

?>