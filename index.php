<?php
  if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) 
    ob_start('ob_gzhandler'); 
  else ob_start();
  
  require "util/util.php";
  require "util/db.php";
  $db = new DB;
  $db_obj = $db->create_db(3306,"fundraising","root","");
  $all_camp = $db->get_all_campaigns();
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
    <title>Fundraising</title>
    <link rel="stylesheet" href="public/css/style-final.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/f0c4100b26.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script>
      function cardOnMouseEnter(e) {
        e.classList.remove('shadow');
      }

      function cardOnMouseLeave(e) {
        e.classList.add('shadow');
      }
    </script>
   
</head>
<style>
  html{
    scroll-behavior : smooth;
  }
</style>
<body>
<?php require "templates/navbar.php";  ?>
  <section>
    <!--Landing Image-->
    <div class="image-container">
      <div class="image"></div>
      <div class="image-text">
         <header>Raising Money has never been easy</header>
          <a href="#explore"  style=""><button type="button" id = "exploreBtn" class="btn btn-primary">
          Explore Projects
          </button>
          </a>  
      </div>
    </div>

  <div class="w-100 spinnerContainer" style="height:600px;">
    <div style="margin:auto; width:fit-content; margin-top:300px;">
      <div class="spinner-border" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>
  </div>
  </section>
<section class="main-body-section" style="display:none">
    <!--Browsing Section-->
    <div class="browse-container">
      <div class="container-text">
        <h2>All our Campaigns</h2>
    </div>
    <div class="container" id="explore">
    <div class="campaign-container">
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
          echo('
            <div class="card shadow" style="transition: 0.1s ease-in;" onmouseenter = "cardOnMouseEnter(this)" onmouseleave = "cardOnMouseLeave(this)">
              <img src="'.$camp_to_img[$all_camp[$k]["id"]].'" class="card-img-top" alt="...">
              <div class="but">
              <a href="campaign-info.php?id='.get_encrypted_id($all_camp[$k]["id"]).'" class="btn btn-primary">DONATE</a>
              </div>
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
                  <div class="progress-bar" role="progressbar" style="width:'.floor($all_camp[$k]["currentamount"]*100 / $all_camp[$k]["amount"]).'%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
              <div class="stat-text">&#8377 '.$all_camp[$k]["currentamount"].'
                <div class="text-muted">
                  raised of &#8377 '.$all_camp[$k]["amount"].'
                </div>
                <div class="perc">
                  <p>'.floor($all_camp[$k]["currentamount"]*100 / $all_camp[$k]["amount"]).'%</p>
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
    }?>
  </div>
  </section>
  <?php require_once("templates/footer.php"); ?>
    <!-- jQuery min JS -->
    <script
      src="https://code.jquery.com/jquery-3.5.1.min.js"
      integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
      crossorigin="anonymous"></script>
    <!-- CUSTOM JS FILES -->
    <script src="public/Js/main.js"></script>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>