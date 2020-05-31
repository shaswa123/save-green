<?php 
    if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) 
      ob_start('ob_gzhandler'); 
    else ob_start();

    require "util/db.php";
    require "util/util.php";
    session_start();
    if(isset($_SESSION["userid"]) || isset($_SESSION["adminid"])){
        // IF user ID is set then no need to come to LOGIN redirect
        // For now log out
        header("Location: loggout.php");
        return;
    }
    $db = new DB;
    $db_obj = $db->create_db(3306,"fundraising","root","");
    if(isset($_POST["email"]) && isset($_POST["password"]))
    { 
        // CHECK email and password from the DB
        $user = $db->get_one_user($_POST["email"],get_encrypt_pass($_POST["password"]));

        //Check if email and password is correct or incorrect
        if(isset($user[0]["userID"]) == false){
            $_SESSION["login_err"] = "Please enter correct email address and password!";
        }
        else{
            // Check if email is verified or not
            $isverified = $db->get_from_verify((int)$user[0]["userID"]);
            if($isverified["isverified"] == 0){
                $_SESSION["isverified"] = false;
                header("Location: signupconfirm.php");
                $_SESSION["userid"] = $user[0]["userID"];
                return;
            }else{
                $_SESSION["isverified"] = true;
                $_SESSION["verifycode"] = $isverified[0]["e_code"];

            }
            $admin_user = $db->get_one_admin_user((int)$user[0]["userID"]);
            if(isset($admin_user[0]["id"]))
            {
                // Admin user
                $_SESSION["adminid"] = (int)$admin_user[0]["id"];
                header("Location: dashboard.php");
                return;
            }
            else if(isset($user[0]["userID"])){
                // Normal user
                $_SESSION["userid"] = (int)$user[0]["userID"];
                header("Location: dashboard.php");
                return;
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Login</title>
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
    .err-block{
        background-color: #e8635c;
        text-align:center;
    }
    .nav-links{
        color:white!important;
    }
</style>
<body>
      <!-- The Navigation Bar -->
      <?php require "templates/navbar.php";?>
    <!--loginbox-->
    <div class="loginbox shadow">
        
        <h1>Login</h1>
        <form method="post">
            <div class="emailContainer">
                <p id="email">Email Address</p>
                <input type="text" id="emailInput" onfocusout="loginOut(this.id)" onfocus="login(this.id)" name="email">
            </div>
            <div class="passContainer">
                <p id="pass">Password</p>
                <input type="password" id="passInput" onfocusout="loginOut(this.id)" onfocus="login(this.id)" name="password">
            </div>
            <input type="submit" name="" value="Log In">
            <div class="d-flex">
                <a href="changepass.php">Forgot Password?</a>
                <a href="signup.php" class="ml-2">Sign up</a>
            </div>
        </form>
        <?php 
            if(isset($_SESSION["login_err"])){
                echo("<div class='err-block mt-4 pb-1'><p style='color:white; font-size:13px; font-weight:bold;'>".$_SESSION["login_err"]."</p></div>");
                unset($_SESSION["login_err"]);
            }
        ?>
    </div>
    <div class="w-100 waveContainer">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#2e3c4b" fill-opacity="1" d="M0,0L80,5.3C160,11,320,21,480,69.3C640,117,800,203,960,197.3C1120,192,1280,96,1360,48L1440,0L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path></svg>
    </div>
<?php require "templates/foot.php"; ?>