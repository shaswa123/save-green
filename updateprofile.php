<?php 
    require "util/db.php";
    require "util/util.php";
    session_start();
    $db = new DB;
    $db_obj = $db->create_db(3306,"fundraising","root","");
    // If logged in check if admin or not
    if(!isset($_SESSION["adminid"]) && !isset($_SESSION["userid"]))
    {
        header("Location: ../login.php");
        return;
    }
    $userid;
    if(isset($_SESSION["adminid"])){
        $userid = $_SESSION["adminid"];
    }else if(isset($_SESSION["userid"])){
       $userid = $_SESSION["userid"];
    }
    //GET user
    $stml = $db_obj->prepare("SELECT * from users WHERE userID = :id");
    $stml->execute(array(':id' => $userid));
    $user = $stml->fetchAll(PDO::FETCH_ASSOC);
    $user = $user[0];

    // GET phone number (max - 2)
    $stml = $db_obj->prepare("SELECT * from phonenumbers WHERE userid = :id");
    $stml->execute(array(':id' => $user["userID"]));
    $phone_nums = $stml->fetchAll(PDO::FETCH_ASSOC);

    print_r($_POST);
?>