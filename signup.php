<?php 
    require "db.php";
    $db = new DB;
    $db_obj = $db->create_db(3306,"fundraising","root","");
    $get_users = $db->get_all_users($db_obj);

    $row = $get_users->fetch(PDO::FETCH_ASSOC);
    
    // print_r($row);

    if(isset($_POST)){
        // IF A POST REQUEST
        // VALIDATE THE USERNAME AND PASSWORD FROM DB
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>SignUp form</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style2.css">
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
                <input type="text" id="emailInput" onfocusout="signUpOut(this.id)" onfocus="signUp(this.id)" name="email">
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
    </div>
  
<?php require "templates/foot.php";?>

