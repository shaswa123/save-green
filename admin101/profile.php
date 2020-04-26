<?php 
    session_start();
    require "../util/db.php";
    require "../util/util.php";
    $db = new DB;
    $db_obj = $db->create_db(3306,"fundraising","root","");

    // If logged in check if admin or not
    if(!isset($_SESSION["adminid"]))
    {
        header("Location: ../login.php");
        return;
    }

    // GET the user
    $stml = $db_obj->prepare("SELECT * from users WHERE userID = :id");
    $stml->execute(array(':id' => $_SESSION["adminid"]));
    $user = $stml->fetchAll(PDO::FETCH_ASSOC);
    $user = $user[0];

    // GET phone number (max - 2)
    $stml = $db_obj->prepare("SELECT * from phonenumbers WHERE userid = :id");
    $stml->execute(array(':id' => $user["userID"]));
    $phone_nums = $stml->fetchAll(PDO::FETCH_ASSOC);
?>
<?php 
    require "../templates/top.php";
    require "../templates/adminnav.php";
?>
<link rel="stylesheet" href="../public/css/adminview.css">
<?php
    echo('<div  style="width:30%; margin:auto; margin-top:5em;">');
    echo('<h5 style="color:rgba(0,0,0,0.7);">Frist name: '.$user["firstName"].'</h5>');
    echo('<h5 style="color:rgba(0,0,0,0.7);">Last name:'.$user["lastName"].'</h5>');
    if(isset($phone_nums[1]["phonenum"])){
        echo('<div class="mt-2 d-flex><p class="mr-2" style="font-size:16px; color: rgba(0,0,0,0.7);">Phone numbers:'.$phone_nums[0]["phonenum"].'</p>
        <p style="font-size:16px; color: rgba(0,0,0,0.7);">Alternate phone number: '.$phone_nums[1]["phonenum"].'</p></div>
        ');
    }else{
        echo('<div class="mt-2 d-flex><p class="mr-2" style="font-size:16px; color: rgba(0,0,0,0.7);">Phone numbers:'.$phone_nums[0]["phonenum"].'</p>');
    }
    echo('<p style="font-size:16px; color: rgba(0,0,0,0.7);Email id: ">'.$user["emailId"].'</p>');
    echo('<a href="updateprofile.php"'.$user["userID"].'" class="btn btn-danger mt-2">Update the details</a>');
    echo('</div>');
?>