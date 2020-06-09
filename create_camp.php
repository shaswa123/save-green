<?php
    session_start();
    require_once "util/util.php";
    require_once "util/db.php";
    $db = new DB();
    $db_obj = $db->create_db(3306,"fundraising","root","");

    echo('
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
        </head>
    ');

    require_once "templates/navbar.php";


    echo('<p style="display:hidden">'.$_POST["numberOfImages"].'</p>');

    echo('
        <h5 style="text-align:center; width:100%; margin-top:10em;">Creating a new campaign...</h5>
        <p style="text-align:center; width:100%; font-size:15px; font-weight:500; color:red;">Please do not refresh your page</p>
        <div class="w-100 d-flex">
            <div class="spinner-border" style="margin:auto; margin-top:2em; margin-bottom:5em;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    ');

    if($_SERVER["REQUEST_METHOD"] == "GET"){
        header("Location: index.php");
    }

    $campid = $db->insert_into_campaigns($_POST);
    
    $l = 0;
    $imgURL;
    echo("\n\n");
    for($i =0; $i < $_POST["numerOfImages"]; $i++){
        $temp = explode("base64,", $_POST["img".$i])[1];
        $key = 'a0a52413a54db42adba1af3f75912e14';
        $data = array(
            'key' => $key,
            'image' => $temp
        );
        # Create a connection
        $url = 'https://api.imgbb.com/1/upload';
        $ch = curl_init($url);
        # Form data string
        $postString = http_build_query($data, '', '&');
        # Setting our options
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        # Get the response
        $response = curl_exec($ch);
        $response = json_decode($response, true);
        curl_close($ch);
        $db->insert_into_images($response["data"]["url"], $campid);
    }
    //SEND a mail for campaign create
    createCampagin_mail();
    
    header("Location: index.php");

    require_once "templates/footer.php";
    require_once "templates.foot.php";



?>