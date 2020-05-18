<?php
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
  $isAdmin = false;
  if(isset($_SESSION["adminid"])){
    $userID = $_SESSION["adminid"];
    $isAdmin = true;
  }else{
    $userID = $_SESSION["userid"];
  }
  // GET the user
  $user = $db->get_user_by_id($userID)[0];
  // GET phone numbers
  $phoneNum = $db->get_phone_numbers($userID);
  // GET all the fund raisers associated to the user
  $all_camp = $db->get_campaigns_by_user($userID);
  // print_r($all_camp);
  $total_earning = 0;
  foreach($all_camp as $camp){
    $total_earning += $camp["currentamount"];
  }

  if(isset($_POST["emailId"]) && isset($_POST["firstName"])){
    $res = $db->update_user_details($userID, htmlentities($_POST["firstName"]), htmlentities($_POST["lastName"]),htmlentities($_POST["emailId"]));
    if(!$res){
      echo("Error!");
    }else{
      header("Location: dashboard.php");
    }
  }

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
</head>
<body>
    <section>
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
        <!--box-->  
        <div class="box">
            <div class="box-image"></div>
                <div class="box-image-text">
                    <h2>Dashboard</h2>
                    <p>Home / Dashboard</p>
                </div>
        </div>  
        <div class="navthrough">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
              
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                      <a class="nav-link" href="#">Dashboard <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        My Account
                      </a>
                      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Update details</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                      </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Projects
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="#">Action</a>
                          <a class="dropdown-item" href="#">Another action</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                    <li>
                    <? // If admin have option to view all users ?>
                        <a href="">
                        <button>
                            <div class="but-text">
                            ADD NEW PROJECT
                            </div>
                        </button>
                        </a>
                    </li>
                    
                  </ul>
                </div>
              </nav>
        </div>
        <section>
        <div class="container">
            <div class="monitor">
                  <div class="chart">
                    <div class="row">
                    <div class="d-flex">
                        <div class="col-sm-6">
                            <div class="first-one">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">&#8377 <?= $total_earning?></h5>
                                        <p class="card-text">Fund Raised</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-0">
                            <div class="second-one"></div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">0</h5>
                                        <p class="card-text">Total Donors</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <div class="my-projects">
            <h2>My projects</h2>
            <? //If no project is found ?>
            <p>None found</p>
            <? //Display the latest campaign ?>
        </div>
        <div class="my-info col-sm-4">
            <h2>Your info</h2>
            <div class="d-flex">
              <div class="profileImg">
                  <img src="public/images/av.jpg" alt="">
              </div>              
              <div class="personalDetails">
                <div class="nameContainer">
                    <p id="name">First Name</p>
                    <p style="font-weight:500;"><?= $user["firstName"]?></p>
                </div>
                <?php 
                  if($user["lastName"] != ""){
                    echo('
                          <div class="nameContainer">
                            <p id="name">Last Name</p>
                            <p style="font-weight:500;">'.$user["lastName"].'</p>
                          </div>
                    ');
                  }
                ?>
                <div class="emailContainer">
                    <p id="email">Email</p>
                    <p style="font-weight:500;"><?= $user["emailId"]?></p>
                </div>
                <div class="nameContainer">
                  <p id="name">Phone Number</p>
                  <p style="font-weight:500;"><?= $phoneNum[0]["phonenum"] ?></p>
                </div>
              </div>
            </div>
                  <button type="button" class="btn btn-warning w-100" data-toggle="modal" data-target="#exampleModalCenter">
                    EDIT
                  </button>
            </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Edit profile</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span style="color:white;" aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form method="POST">
                           <div class="nameContainer">
                            <p id="name">First Name</p>
                            <input class="form-control mr-sm-2" type="text" name="firstName" value="<?= $user["firstName"]?>" placeholder="first name" aria-label="text">
                          </div>
                          <div class="emailContainer">
                              <p id="email">Last Name</p>
                              <input class="form-control mr-sm-2" type="text" name="lastName" value="<?= $user["lastName"]?>" placeholder="Last name" aria-label="text">
                          </div> 
                          <div class="emailContainer">
                              <p id="email">Email</p>
                              <input class="form-control mr-sm-2" type="email" name="emailId" value="<?=$user["emailId"]?>" placeholder="Email ID" aria-label="text">
                          </div>
                          <div class="nameContainer">
                            <p id="name">Phone Number</p>
                            <input class="form-control mr-sm-2" name="phonenum" type="text" placeholder="Phone number" value="<?= $phoneNum[0]["phonenum"]?>" aria-label="text">
                          </div>
                          <button id="save-changes" class="btn btn-primary mt-2 w-100">Save changes</button>
                        </form>
                      </div>
                      
                    </div>
                  </div>
                </div>
        </div>
      </div>
    </section>
        <!-- jQuery min JS -->
    <script
      src="https://code.jquery.com/jquery-3.5.1.min.js"
      integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
      crossorigin="anonymous"></script>
    <script>
      document.getElementById("save-changes").addEventListener('click',()=>{
        document.getElementById("save-changes").submit();
      })
    </script>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>