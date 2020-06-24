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
    
    //ADD IN ADMIN TABLE
    $db->insert_into_admin($USERID);

    header("Location: dashboard.php");
    return;

?>