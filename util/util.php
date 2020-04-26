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

?>