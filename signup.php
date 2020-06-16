<?php 
    if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) 
      ob_start('ob_gzhandler'); 
    else ob_start();
    
    require "util/db.php";
    require "util/util.php";
    session_start();
    $db = new DB;
    $db_obj = $db->create_db(3306,"fundraising","root","");
    $err = "Please check name, email and password again.";

    if((isset($_POST["name"]) && isset($_POST["email"])) && isset($_POST["password"])){

        //GET FROM_EMAIL, FROM_PASSWORD AND FROM_PASSWORD FROM DB
        $EMAIL_DETAILS = $db->get_from_email()[1];
        $EMAIL['EMAIL_FROM'] = $EMAIL_DETAILS['address'];
        $EMAIL['EMAIL_PASS'] = $EMAIL_DETAILS['pass'];
        $EMAIL['SUBJECT'] = $EMAIL_DETAILS['subject'];
        $EMAIL['BODY'] = $EMAIL_DETAILS['body'];

        // AUTHENTICATE NAME EMAIL AND PASSWORD

        if(strcmp($_POST["name"], "") == 0)
        {
            $_SESSION["signup-error"] = true;
            header("Location: signup.php");
            return;
        }
        if(strcmp($_POST["email"], " ") == 0)
        {
            $_SESSION["signup-error"] = true;
            header("Location: signup.php");
            return;
        }else{
            // email string has some value
            $temp = explode("@",$_POST["email"]);
            if(count($temp) != 2 || count(explode(".",$temp[1])) != 2){
                $_SESSION["signup-error"] = true;
                header("Location: signup.php");
                return;
            }
        }

        // VALIDATE THE USERNAME AND PASSWORD FROM DB
        $pass = get_encrypt_pass($_POST["password"]);
        
        if($db->insert_user($_POST["name"],"",$_POST["email"],$pass)){
            // CODE below is for confirmation email
            $user = $db->get_one_user($_POST["email"],$pass);
            $user = $user[0];
            $code = get_email_code($_POST["name"]);
            $EMAIL['EMAIL_TO'] = $_POST['email'];
            $db->insert_into_verify($user, $code);
            $code = str_split($code,10)[0];
            if(confirmation_email($EMAIL, $code)){
                $_SESSION["isverified"] = false;
                header("Location: signupconfirm.php");
                return;
            }else{
                $_SESSION["signup-error"] = true;
                $err = "Issue with Sign up. Please try again.";
                header("Location: signup.php");
                return;
            }
            
            header("Location: signupconfirm.php");
            return;
        }else{
            // User Exist
            $_SESSION["signup-error"] = true;
            $err = "User already exist. Please login.";
            header("Location: signup.php");
            return;
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>SignUp form</title>
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/style2.css">
    <script src="https://kit.fontawesome.com/f0c4100b26.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Mono&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script>
        function signUp(e){
            if(e == "nameInput"){
                document.getElementById("name").style.top="23%";
                document.getElementById(e).style.borderBottom="2px solid green";
            }
            if(e == "emailInput"){
                document.getElementById("email").style.top="34%";
                document.getElementById(e).style.borderBottom="2px solid green";
            }
            if(e == "passInput"){
                document.getElementById("pass").style.top="46%";
                document.getElementById(e).style.borderBottom="2px solid green";
            }
        }

        function signUpOut(e){
            if(e == "nameInput"){
                //If not input was made
                if(document.getElementById(e).value == ""){
                    document.getElementById("name").style.top="27%";
                    document.getElementById(e).style.borderBottom="2px solid red";
                    nameFlag = false;
                }
            }
            if(e == "emailInput"){
                //If not input was made
                if(document.getElementById(e).value == ""){
                    document.getElementById("email").style.top="38%";
                    document.getElementById(e).style.borderBottom="2px solid red";
                    emailFlag = false;
                }
            }
            if(e == "passInput"){
                //If not input was made
                if(document.getElementById(e).value == ""){
                    document.getElementById("pass").style.top="50%";
                    document.getElementById(e).style.borderBottom="2px solid red";
                    passFlag = false;
                }
            }
        }
    </script>
</head>
<body>
      <!-- The Navigation Bar -->
      <?php require "templates/navbar.php";?>

    <!--Signupform-->
    <div class="signupbox shadow" style="background-color:white;">
        
        <h1>Sign Up</h1>
        <form class="mt-3" method="post">
            <div class="nameContainer">
                <p id="name">Name</p>
                <input type="text" id="nameInput" onfocusout="signUpOut(this.id)"  onfocus="signUp(this.id)" name="name" require>
            </div>
            <div class="emailContainer">
                <p id="email">Email Address</p>
                <input type="email" id="emailInput" onfocusout="signUpOut(this.id)" onfocus="signUp(this.id)" name="email" require>
            </div>
            <div class="passContainer">
                <p id="pass">Password</p>
                <input type="password" id="passInput" onfocusout="signUpOut(this.id)" onfocus="signUp(this.id)" name="password" require>
            </div>
            <input type="submit" name="" value="Sign Up to get started">
            <div class="d-flex">
                <a href="login.php" class="ml-2">Log In</a>
            </div>
            <div style="background-color:#e8635c;display:none;" class="mt-3 pt-1 pb-1" id="errBlock">
                <p style="color:white; text-align:center;"></p>
            </div>
        </form>
        <?php if(isset($_SESSION["signup-error"])){ ?>
            <p style="color: #aa0000;font-size: 14;font-weight: bold;"><?php $err ?></p>
        <?php } session_destroy();?>
    </div>
        <div class="w-100 waveContainer">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#2e3c4b" fill-opacity="1" d="M0,0L80,5.3C160,11,320,21,480,69.3C640,117,800,203,960,197.3C1120,192,1280,96,1360,48L1440,0L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path></svg>
    </div>

    <!-- jQuery min JS -->
    <script
      src="https://code.jquery.com/jquery-3.5.1.min.js"
      integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
      crossorigin="anonymous">
    </script>
    <!-- CUSTOM JS -->
    <script src="public/Js/signup.js"></script>