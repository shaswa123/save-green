<?php 
    require "util/db.php";
    require "util/util.php";
    session_start();
    $db = new DB;
    $db_obj = $db->create_db(3306,"fundraising","root","");
    if(isset($_POST["email"]) && isset($_POST["password"]))
    {
        // CHECK email and password from the DB
        $user = $db->get_one_user($_POST["email"],get_encrypt_pass($_POST["password"]));
        if(isset($user["userID"])){
            // SUCCESSFUL
            // $_SESSION["userid"] = $row["userID"];
            print($user["userID"]);
            header("Location: index.php");
            return;
        }else{
            // FAIL
            header("Location: login.php");
            return;
        }
    }
    if(isset($_SESSION["userid"])){
        // IF user ID is set then no need to come to LOGIN redirect
        // For now log out
        header("Location: loggout.php");
        return;
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
<body>
      <!-- The Navigation Bar -->
      <?php require "templates/navbar.php";?>
    <!--loginbox-->
    <div class="loginbox">
        
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
                <a href="#">Forgot Password?</a>
            </div>
        </form>
    </div>
    
<?php require "templates/foot.php"; ?>