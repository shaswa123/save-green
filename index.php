<?php 
  require "util/util.php";
  require "util/db.php";
  $db = new DB;
  $db_obj = $db->create_db(3306,"fundraising","root","");
  $all_camp = $db->get_all_campaigns();
  $camp_to_username;
  foreach($all_camp as $camp){
    $userName = $db->get_user_by_id($camp["userID"])[0]["firstName"];
    $camp_to_username[$camp["id"]] = $userName;
  }
  $popular_camp = $db->get_popular_campaign(-1)[0];
  $popular_camp_volunteer = $db->get_user_by_id($popular_camp["userID"]);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CrowdFunding</title>
    <link rel="stylesheet" href="public/css/style-final.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <!-- The Navigation Bar -->
    <div class="navigation-bar">
        <nav class="navbar">
            <a class="navbar-brand" href="#">
              <img src="public/images/Save-Green-logo-PNG.png" alt="">
            </a>
            <ul class="nav">
              <li class="nav-item">
                <a class="nav-link active" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Campaigns</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Contact Us</a>
              </li>
            </ul>
        </nav>
    </div>
  <section>
    <!--Landing Image-->
    <div class="image-container">
      <div class="image"></div>
      <div class="image-text">
         <header>Raising Money has never been easy</header>
          <button type="button" class="btn btn-primary" data-toggle="button" aria-pressed="false">
          Explore Projects
          </button>
      </div>
    </div>

  </section>
  <section>
    <!--Browsing Section-->
    <div class="browse-container">
      <div class="container-text">
        <h2>All our Campaigns</h2>

      </div>

      </div>
    </div>
    <div class="container">
    <div class="campaign-container">
    <?php $k = 0; $limit; 
      if(count($all_camp) < 3)
        {
          $limit = 1;
        }else{
          $limit = 3;
        } 
      for($i = 0; $i < ceil(count($all_camp) / 3); $i++){
          echo('<div class="d-flex justify-content-around mb-4" data-aos="fade-down" data-aos-duration="500">
                ');
        for($j=0; $j <$limit; $j++){
          if($k >= count($all_camp)){
            break;
          }
          echo('
            <div class="card shadow" style="width: 22rem;">
              <img src="public/images/education.jpg" class="card-img-top" alt="...">
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
                <p class="minidesc">Some info about the campaign</p>
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
               <li class="list-group-item">&#128339 770 days to go</li>
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

  <footer style="margin-top:10em;">
        <div class="container-fluid p-5">
          <div class="row-text-left">
            <div class="d-flex pt-3">
              <div class="col-md-3">
                  <img src="./public/images/Save-Green-logo-PNG.png" style="width: 50%;" alt="">
                  <p class="text-muted">100K+ Followers</p>
                  <div class="column text-light">
                    <i class="fab fa-facebook-f"></i>
                    <i class="fab fa-instagram"></i>
                    <i class="fab fa-twitter"></i>
                    <i class="fab fa-youtube"></i>
                    <i class="fab fa-whatsapp"></i>
                  </div>
                  <p class="pt-4 text-muted">
                    2020 | All Rights Reserved
                  </p>
              </div>
              <div class="col-md-3">
                <h1>Fundraise</h1>
                <h6 class="text-muted">Fundraising for NGOs</h6>
                <h6 class="text-muted">Fundraising for Education</h6>
                <h6 class="text-muted">Fundraising for Environment</h6>
                </div>
                <div class="col-md-3">
                  <h1 class="text">About Us</h1>
                  <h6 class="text-muted">FAQs</h6>   
                </div>
                <div class="col-md-3">
                  <h1 class="text">Contact Us</h1>
                  <form action="">
                    <input type="text" class="form-control" placeholder="Email ID" name="email">
                    <textarea type="text" class="form-control mt-3" name="text" placeholder="Your query"></textarea>
                    <button class="btn btn-danger mt-3 mb-4" style="width: 100%;">Submit</button>
                  </form>
                </div>
          </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- jQuery min JS -->
    <script
      src="https://code.jquery.com/jquery-3.5.1.min.js"
      integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
      crossorigin="anonymous"></script>
    <!-- ANIMATE ON SCROLL(A0S) JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>>
    <script>
      AOS.init();
    </script>
    <!-- CUSTOM JS FILES -->
    <script src="main.js"></script>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>