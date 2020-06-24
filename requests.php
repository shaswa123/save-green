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
    $userID;
    if(isset($_SESSION["adminid"])){
        $userID = $_SESSION["adminid"];
    }else{
        $userID = $_SESSION["userid"];
    }

    // GET THE USER
    $USER = $db->get_user_by_id($userID)[0];

    // CAN ALLOW
    $can_allow = $USER["can_allow"];

    // IF NON-ADMIN CHECK IF ALLOWED TO THIS PAGE OR NOT
    if(isset($_SESSION["userid"]) && !$USER["can_allow"]){
        // THE USER IS NON-ADMIN AND IS NOT ALLOWED ON THIS PAGE
        header("Location: dashboard.php");
        return;
    }

    $all_camp = $db->get_all_campaigns_request();
    $camp_to_username;
    $camp_to_img;
    foreach($all_camp as $camp){
        $userName = $db->get_user_by_id($camp["userID"])[0]["name"];
        $campIMG = $db->get_images($camp["id"]);
        if(isset(($campIMG)[0]["imgurl"])){
        $camp_to_img[$camp["id"]] = $campIMG[0]["imgurl"];
        }else{
        $camp_to_img[$camp["id"]] = "public/images/bg4.jpeg";
        }
        $camp_to_username[$camp["id"]] = $userName;
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="public/css/style-request.css">
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
    <script>
        function cardOnMouseEnter(e) {
            e.classList.remove('shadow');
        }

        function cardOnMouseLeave(e) {
            e.classList.add('shadow');
        }
    </script>
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
    
    <div class="container mt-4">
        <?php $k = 0; $limit; 
            if(count($all_camp) < 3)
                {
                $limit = 1;
                }else{
                $limit = 3;
                } 
            for($i = 0; $i <= ceil(count($all_camp) / 3); $i++){
                echo('<div class="d-flex justify-content-around mb-4">
                        ');
                for($j=0; $j <$limit; $j++){
                if($k >= count($all_camp)){
                    break;
                }
                $PERCENTAGE = 0;
                if($all_camp[$k]["amount"] != 0)
                    $PERCENTAGE = floor($all_camp[$k]["currentamount"]*100 / $all_camp[$k]["amount"]);
                echo('
                    <div class="card shadow" style="transition: 0.1s ease-in;" onmouseenter = "cardOnMouseEnter(this)" onmouseleave = "cardOnMouseLeave(this)">
                    <img src="'.$camp_to_img[$all_camp[$k]["id"]].'" class="card-img-top" alt="...">
                    <div class="avatar">
                    <a href="author">
                        <img src="public/images/av.jpg" alt="avatar">
                        <div class="text">
                        <text-muted>by '.$camp_to_username[$all_camp[$k]["id"]].'</text-muted>
                        </div>
                    </a>
                    </div>
                    <div class="card-body">
                        <h2>
                        <a href="campaign-info.php?id='.get_encrypted_id($all_camp[$k]["id"]).'" class="card-link">'.$all_camp[$k]["title"].'</a>
                        </h2>
                        <p class="minidesc">'.str_split($all_camp[$k]["description"], 60)[0].' ...</p>
                        <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width:'.$PERCENTAGE.'%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="stat-text">&#8377 '.$all_camp[$k]["currentamount"].'
                        <div class="text-muted">
                        raised of &#8377 '.$all_camp[$k]["amount"].'
                        </div>
                        <div class="perc">
                        <p>'.$PERCENTAGE.'%</p>
                        </div>
                    </div
                    <ul class="list-group list-group-flush">
                    <div class="symbol"></div> 
                    <li class="list-group-item">&#128339 '.date_diff(date_create($all_camp[$k]["enddate"]),date_create($all_camp[$k]["startdate"]),true)->format('%a days').' remaining</li>
                    </ul>
                    </div>
                ');
                $k++;
                }    
            echo('
            </div>');
            }
        ?>
    </div>
    
    <?php require("templates/footer.php") ?>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>