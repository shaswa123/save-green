<?php 
    require "util/db.php";
    require "util/util.php";
    session_start();
    if(!isset($_SESSION["isverified"]))
    {
        // NOT logged in
        header("Location: login.php");
        return;
    }
    if($_SESSION["isverified"] == true)
    {
        header("Location: index.php");
        return;
    }
    $db = new DB;
    $db_obj = $db->create_db(3306,"fundraising","root","");
    $err="";
    if(isset($_POST["email"]) && isset($_POST["code"]))
    {
        // print_r($_POST["email"]);
        //GET USERID USING EMAIL
        $stml = $db_obj->prepare("SELECT userID from users WHERE emailId = :email");
        $stml->bindParam(':email',$_POST["email"],PDO::PARAM_STR);
        $stml->execute();
        $userid = $stml->fetchAll(PDO::FETCH_ASSOC);
        if(isset($userid[0])){
            //If email entered was able to find a user
            $userid = $userid[0]["userID"];
            //GET e_code using $userid from above
            $stml = $db_obj->prepare("SELECT e_code from emailverify WHERE userid = :id");
            $stml->execute(array(':id' => $userid));
            $ecode = $stml->fetchAll(PDO::FETCH_ASSOC);
            $ecode = $ecode[0]["e_code"];
            
            $user_code =str_split($_POST["code"],10)[0];

            //Check if enterd code matches ecode
            if(!strcmp($ecode, $user_code))
            {
                // SUCCESSFUL
                // UPDATE emailverify SET e_code = "1001" WHERE userid = 23;
                $stml = $db_obj->prepare("UPDATE emailverify SET isverified = 1 WHERE userid = :id;");
                if($stml->execute(array(':id' => $userid))){
                    //DONE
                    $_SESSION["isverified"] = true;
                }else{
                    $err = "Please try again.";
                }
                
            }else{
                $err = "Please enter a valid code";
            }
        }
        else{
            $err = "Enter valid email and code";
        }
    }else{
        $err = "Please enter email and code";
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
</head>
<style>
    .nav-links{
        color:white!important;
    }
    body{
        height:900px;
        overflow:hidden;
    }
    .waveContainer {
    	position: absolute;
    	bottom: 0px;
    	z-index: -1;
    }
    .btn-submit{
        background-color:#2e3c4b;
        color:White;
        border:none;
        outline:none;
        font-size:18px;
        transition:0.5s ease-in;
        height:40px;
    }
    .btn-submit:hover{
        color:#fed857;
    }
</style>
<body>


<?php require "templates/navbar.php";  ?>

<?php 
//   require "templates/top.php";
  if($_SESSION["isverified"] == true)
  {
      echo('<div class="container shadow p-3" style="width: 500px;margin-top: 7em; z-index:1; background-color:white;"><h3 class="mt-4 mb-4" style="text-align:center">Thank you for confirming</h3>');
      echo('<button class="btn-submit w-100"><a href="dashboard.php" style="text-decoration: none; color:white;">Go to dashboard</a></button></div>');
  }else{
     echo('<div class="container shadow p-3" style="width: 320px;margin-top: 7em; z-index:1; background-color:white;"><form method="post">
     <h1 style="text-align:center; margin-bottom:1em;">Confirmation</h1>
     <div class="form-group">
       <label for="exampleInputEmail1" style="font-weight:bold;">Email address</label>
       <input type="email" class="form-control" name="email" placeholder="Enter email">
     </div>
     <div class="form-group">
       <label for="exampleInputPassword1" style="font-weight:bold;">Code</label>
       <input type="text" class="form-control" name="code" placeholder="Enter code">
     </div>
     <button type="submit" class="w-100 btn-submit">Submit</button>
   </form>
   <div class="mt-2"><p style="color:red;font-size=15px; text-align:center;">'.$err.'</p></div>
   </div>');
  }
      
?>
    <div class="w-100 waveContainer">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#2e3c4b" fill-opacity="1" d="M0,0L80,5.3C160,11,320,21,480,69.3C640,117,800,203,960,197.3C1120,192,1280,96,1360,48L1440,0L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path></svg>
    </div>
    <!-- jQuery min JS -->
    <script
      src="https://code.jquery.com/jquery-3.5.1.min.js"
      integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
      crossorigin="anonymous"></script>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>


