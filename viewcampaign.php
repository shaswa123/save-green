<?php 
    require "util/util.php";
    require "util/db.php";  
        $db = new DB;
    $db_obj = $db->create_db(3306,"fundraising","root","");
  
    
    $campid = get_decrypted_id($_GET["id"]);
    $campid = explode('_', $campid)[1];
    $camp = $db->get_campaigns_by_id($campid);
    //print_r($camp[0]["image"]);  
    $img = $camp[0]["image"];  
    // print($img);
?>
<?php 
    require "templates/top.php";
    require "templates/navbar.php";
?>
<style>
    .campContainer{
        width:50%;
        margin:auto;
    }
</style>
<?= 

    '<div class="campContainer" style="margin-top:5em;">
    <h2 class="mt-4 mb-4">'.$camp[0]["title"].'</h2>
    <img src="uploadimages/'.$img.'" style="width:75%; max-height: 300px" alt="">
    <p style="font-size:13px; font-weight:bold;">Location: '.$camp[0]["location"].'</p>
    <p style-"font-size:15px; font-weight:bold">Description</p>
    <p style="font-size:17px;">'.$camp[0]["description"].'</p></div>';
?>
<?php require "razor/pay.php";