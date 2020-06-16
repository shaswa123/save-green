<?php
    if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) 
      ob_start('ob_gzhandler'); 
    else ob_start();

    require "util/db.php";
    require "util/util.php";
    session_start();

    $db = new DB;
    $db_obj = $db->create_db(3306,"fundraising","root","");
    
    $err = '';

    if(isset($_POST["password"]) && isset($_POST["email"])){

        //GET EMAIL DETAILS FROM DB
        $EMAIL_DETAILS = $db->get_from_email()[1];
        $EMAIL['EMAIL_FROM'] = $EMAIL_DETAILS['address'];
        $EMAIL['EMAIL_PASS'] = $EMAIL_DETAILS['pass'];
        $EMAIL['SUBJECT'] = $EMAIL_DETAILS['subject'];
        $EMAIL['BODY'] = $EMAIL_DETAILS['body'];
        
        //CHECK FOR USER WITH EMAIL IN DB
        $user = $db->get_one_user_by_email($_POST["email"]);
        print_r($user);
        if(isset($user[0])){
            //THE USER WITH EMAIL EXISTS
            //UPDATE THE PASSWORD AND ISVERFIED IN DB and SEND A CONFIRMATION MAIL
            $encrpyt_pass = get_encrypt_pass($_POST["password"]);
            $db->update_user_pass($user[0]["userID"], $encrpyt_pass);
            $email_code = get_email_code($user[0]["firstName"]);
            $db->unset_verify($user[0]["userID"], $email_code);
            if(confirmation_email($EMAIL, $email_code)){
                //REDIRECT TO LOGIN 
                header("Location : login.php");
                return;
            }else{
                echo("OOPS");
            }
        }else{
            //ASK TO SIGN UP
            $err = "The user does not exist. Please try to sign up.";
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Forgot password</title>
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/style1.css">
    <script src="https://kit.fontawesome.com/f0c4100b26.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Mono&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script>
        function login(e){
            if(e == "emailInput"){
                document.getElementById("email").style.top="27%";
                document.getElementById(e).style.borderBottom="2px solid green";
            }
            if(e == "passInput"){
                document.getElementById("pass").style.top="41%";
                document.getElementById(e).style.borderBottom="2px solid green";
            }
        }

        function loginOut(e){
            if(e == "emailInput"){
                //If not input was made
                if(document.getElementById(e).value == ""){
                    document.getElementById("email").style.top="34%";
                    document.getElementById(e).style.borderBottom="2px solid red";
                    emailFlag = false;
                }
            }
            if(e == "passInput"){
                //If not input was made
                if(document.getElementById(e).value == ""){
                    document.getElementById("pass").style.top="48%";
                    document.getElementById(e).style.borderBottom="2px solid red";
                    passFlag = false;
                }
            }
        }
    </script>
</head>
<style>
    .nav-links{
        color:white!important;
    }
    #email{
        position:relative;
        top:30px;
        width:fit-content;
        transition:0.5s ease-in;
    }
    #pass{
        position:relative;
        top:25px;
        width:fit-content;
        transition:0.5s ease-in;
    }
    a{
        text-decoration:none;
    }
</style>
<body>
      <!-- The Navigation Bar -->
      <?php require "templates/navbar.php";?>
    <!--loginbox-->
    <div class="loginbox shadow">
        
        <h2>Forgot Password</h2>
        <form method="POST">
            <div class="emailContainer">
                <p id="email">Email Address</p>
                <input type="text" id="emailInput" onfocusout="loginOut(this.id)" onfocus="login(this.id)" name="email">
            </div>
            <div class="passContainer">
                <p id="pass">New Password</p>
                <input type="password" id="passInput" onfocusout="loginOut(this.id)" onfocus="login(this.id)" name="password">
            </div>
            <input type="submit" name="" value="Sumit">
            <div class="d-flex">
                <a href="login.php">Login</a>
                <a href="signup.php" class="ml-2">Sign up</a>
            </div>
        </form>
        <?php 
            if($err != ''){
                echo("<p style='color:#e8635c; text-align:center; font-size:13px; font-weight:bold;'>".$err."</p>");
                unset($_SESSION["login_err"]);
                $err = '';
            }
        ?>
    </div>
    <div class="w-100 waveContainer">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#2e3c4b" fill-opacity="1" d="M0,0L80,5.3C160,11,320,21,480,69.3C640,117,800,203,960,197.3C1120,192,1280,96,1360,48L1440,0L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path></svg>
    </div>
<?php require "templates/foot.php"; ?>