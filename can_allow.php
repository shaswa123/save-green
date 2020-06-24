<?php 
    if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) 
        ob_start('ob_gzhandler'); 
    else ob_start();
    
    require 'util/util.php';
    require 'util/db.php';
    session_start();
    $db = new DB;
    $db_obj = $db->create_db(3306,"fundraising","root","");

    //GET USER details using the ID from the URL's GET PARAM
    $USERID = get_decrypted_id($_GET["id"]);
    $USERID = explode('_', $USERID)[1];
    $USER = $db->get_user_by_id($USERID)[0];
    
    //GET THE CURRENT STATUS
    $CURRENT_CREATE_STATUS = $USER["can_allow"];

    if($CURRENT_CREATE_STATUS == 1){
        // THEN DISALLOW
        $db->enable_allow($USERID, 0);
    }else{
        // THEN ALLOW
        $db->enable_allow($USERID, 1);
    }

    header("Location: dashboard.php");
    return;
?>