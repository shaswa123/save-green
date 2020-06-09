<?php 
  if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) 
    ob_start('ob_gzhandler'); 
  else ob_start();

  require 'util/util.php';
  require 'util/db.php';
  session_start();
  $db = new DB;
  $db_obj = $db->create_db(3306,"fundraising","root","");
  // If logged in check if admin or not
  if(!isset($_SESSION["adminid"]) && !isset($_SESSION["userid"]))
  {
      header("Location: login.php");
      return;
  }
  //Check if ADMIN OR NOT
  $userID;
  if(isset($_SESSION["adminid"])){
    $userID = $_SESSION["adminid"];
  }else{
      //NOT ADMIN
      header("Location: login.php");
  }

  if(isset($_POST["emailDetails"])){
    //EMAIL DB
    if($db->insert_into_email($_POST) == false){
        header("Location : dashboard");
    }else{
        $_SESSION["ERROR"] = 'ERROR INSERTING. PLEASE TRY AGAIN!';
    }
  }
  if(isset($_POST["recipt"])){
    //RECIPT
    if($db->insert_into_ngo($_POST)){
        header("Location : dashboard");
    }else{
        header("Location : dashboard");
        $_SESSION["ERROR"] = 'ERROR INSERTING. PLEASE TRY AGAIN!';
    }

  }
  if(isset($_POST["shareCamp"])){
    //SHARE CAMP
    if($db->insert_into_misc($_POST["shareCamp"], 'sharecamp')){
        header("Location : dashboard");
    }else{
        header("Location : index");
        $_SESSION["ERROR"] = 'ERROR INSERTING. PLEASE TRY AGAIN!';
    }
  }

  $emailDetails = $db->get_from_email();
  $ngoDetails = $db->get_from_ngo_details();
  $shareCamp = $db->get_from_misc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="public/css/style-dash.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Barlow&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- FONT AWESOME CDN -->
    <script src="https://kit.fontawesome.com/f0c4100b26.js" crossorigin="anonymous"></script>
    <!-- jQuery min JS -->
    <script
      src="https://code.jquery.com/jquery-3.5.1.min.js"
      integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
      crossorigin="anonymous">
    </script>
    <!-- CUSTOM Js -->
    <script src = "public/Js/dashboard.js"></script>
    <style>
        .btn-yellow{
            background-color: #fed857!important;
            color: #2a3746!important;
            border: none!important;
            width:50%;
            margin:auto;
        }
    </style>
</head>
<body>
    <?php require("templates/navbar.php") ?>
    <?php 
        if(isset($_SESSION["ERROR"])){
            echo('
                <div class="mt-4 mb-4 container">
                    <div class="alert alert-danger" role="alert">
                        '.$_SESSION["ERROR"].'
                    </div>
                </div>
            ');
        }
    ?>
    <!-- RECIEPT FEILD -->
    <div class="container mb-4 mt-4">
        <h2>RECIEPT DETAILS</h2>
        <form method="POST">
            <div class="d-flex" style="justify-content:space-evenly;">
                <div class="form-group">
                    <label>Organization Name</label>
                    <input type="text" name="orgName" class="form-control" placeholder="Enter organization name" value="<?php if(isset($ngoDetails[0]["orgnization_name"])){echo($ngoDetails[0]["orgnization_name"]);} ?>">
                </div>
                <div class="form-group">
                    <label>Phone number</label>
                    <input type="number" name="phoneNum" class="form-control" placeholder="Enter phone number" value="<?php if(isset($ngoDetails[0]["phonenum"])){echp($ngoDetails[0]["phonenum"]);} ?>">
                </div>
                <div class="form-group">
                    <label>Pan card number</label>
                    <input type="text" name="panCardNum" class="form-control" placeholder="Enter pan card number" value="<?php if(isset($ngoDetails[0]["pancard"])){echo($ngoDetails[0]["pancard"]);} ?>">
                </div>
            </div>
            <div class="d-flex" style="justify-content:space-evenly">
                <div class="form-group">
                    <label>Email address</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter email" vakue="<?php if(isset($ngoDetails[0]["email"])){echo($ngoDetails[0]["email"]);} ?>">
                </div>
                <div class="form-group">
                    <label >12-A</label>
                    <input type="text" name="12-A" class="form-control" placeholder="Enter 12-A number" value="<?php if(isset($ngoDetails[0]["12-A"])){echo($ngoDetails[0]["12-A"]);} ?>">
                </div>
                <div class="form-group">
                    <label >80-G</label>
                    <input type="text" name="80-G" class="form-control" placeholder="Enter 80-G number" value="<?php if(isset($ngoDetails[0]["80-G"])){echo($ngoDetails[0]["80-G"]);} ?>">
                </div>
            </div>
            <div class="w-100 d-flex">
                <input type="submit" name="reciept" class="btn btn-yellow" value="SUBMIT">
            </div>
        </form>
    </div>
    <!-- EMAIL DETAILS -->
    <div class="container mb-4">
        <h2>EMAIL DETAILS</h2>
        <h4 style="text-align:center;">Thank you message for donors</h4>
        <form method="POST">
            <div class="form-group">
                <label>Email address</label>
                <input type="email" name="email" class="form-control" placeholder="Enter address name" value="<?php if(isset($emailDetails[0]["address"])){echo($emailDetails[0]["address"]);}?>">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="text" name="password" class="form-control" placeholder = "Enter password" value="<?php if(isset($emailDetails[0]["pass"])){echo($emailDetails[0]["pass"]);} ?>">
            </div>
            <div class="form-group">
                <label>Email subject</label>
                <input type="text" name="subject" class="form-control" placeholder = "Enter subject" value = "<?php if(isset($emailDetails[0]["subject"])){echo($emailDetails[0]["subject"]);} ?>">
            </div>
            <label>Thank you message body</label>
            <textarea name="body" style="width:100%; height:auto; min-height:150px;"><?php if(isset($emailDetails[0]["body"])){echo($emailDetails[0]["body"]);} ?></textarea>
            <div class="d-flex w-100">
                <input type="submit" value="SUBMIT" name="emailDetails" class="btn btn-yellow">
            </div>
        </form>
    </div>
    <!-- SHARE CAMP BODY -->
    <div class="container">
        <h2>SHARE CAMPAIGN BODY</h2>
        <form method="post">
            <textarea name="share_campaign" id="" style="width:100%; min-height:150px; height:auto;"><?php if(isset($shareCamp[0]["sharecamp"])){echo($shareCamp[0]["sharecamp"]);} ?></textarea>
            <div class="d-flex w-100">
                <input type="submit" class="btn btn-yellow" name="shareCamp" value="SUBMIT">
            </div>
        </form>
    </div>
    <?php require("templates/footer.php") ?>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>