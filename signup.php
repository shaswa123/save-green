<?php 
    require "util/db.php";
    require "util/util.php";
    session_start();
    $db = new DB;
    $db_obj = $db->create_db(3306,"fundraising","root","");
    $err = "Please check name, email and password again.";

    if((isset($_POST["name"]) && isset($_POST["email"])) && isset($_POST["password"])){
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
            // REDIRECT TO code confirmation PAGE
            header("Location: login.php");
            
            // CODE below is for confirmation email. It does not work rn
            
            // $user = $db->get_one_user($_POST["email"]);
            // print_r($user);
            // if(isset($user["userID"])){
            //     // FOUND it
            //     $code = get_email_code($user["userID"]);
                
            //     $db->insert_into_verify($user, $code);

            //     if(write_email($user, $code)){
            //         header("Location: signupconfirm.php");
            //         return;
            //     }else{
            //         $_SESSION["signup-error"] = true;
            //         $err = "Issue with Sign up. Please try again.";
            //         header("Location: signup.php");
            //         return;
            //     }
            // }
        
            // header("Location: sig.php");
            // return;
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
    <div class="signupbox">
        
        <h1>Sign Up</h1>
        <form class="mt-3" method="post">
            <div class="nameContainer">
                <p id="name">Name</p>
                <input type="text" id="nameInput" onfocusout="signUpOut(this.id)"  onfocus="signUp(this.id)" name="name">
            </div>
            <div class="emailContainer">
                <p id="email">Email Address</p>
                <input type="email" id="emailInput" onfocusout="signUpOut(this.id)" onfocus="signUp(this.id)" name="email">
            </div>
            <div class="passContainer">
                <p id="pass">Password</p>
                <input type="password" id="passInput" onfocusout="signUpOut(this.id)" onfocus="signUp(this.id)" name="password">
            </div>
            <a href="#">Forgot your Password?</a>
            <input type="submit" name="" value="Sign Up to get started">
            <div class="d-flex">
                <a href="#">Already have an account?</a>
                <a href="#" class="ml-2">Log In</a>
            </div>
        </form>
        <?php if(isset($_SESSION["signup-error"])){ ?>
            <p style="color: #aa0000;font-size: 14;font-weight: bold;"><?php $err ?></p>
        <?php } session_destroy();?>
    </div>
  
<?php require "templates/foot.php";?>

