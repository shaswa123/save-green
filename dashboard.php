<?php
  if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) 
    ob_start('ob_gzhandler'); 
  else ob_start();
  
  require 'util/util.php';
  require 'util/db.php';
  session_start();
  $db = new DB;
  $db_obj = $db->create_db(3306,"fundraising","root","");
  

  // If logged in or not
  if(!isset($_SESSION["adminid"]) && !isset($_SESSION["userid"]))
  {
    // IF not logged in
    header("Location: login.php");
    return;
  }

  $userID;
  $isAdmin = false;
  $all_users;
  
  if(isset($_SESSION["adminid"])){
    $userID = $_SESSION["adminid"];
    $isAdmin = true;
    // GET ALL USERS
    $all_users = $db->get_all_users();
  }else{
    $userID = $_SESSION["userid"];
  }


  // GET the user
  $user = $db->get_user_by_id($userID)[0];
  // GET phone numbers
  $phoneNum = $db->get_phone_numbers($userID);
  // CAN CREATE
  $can_create = $user["can_create"];
  // CAN ALLOW
  $can_allow = $user["can_allow"];

  // GET all the fund raisers associated to the user
  $all_camp = $db->get_campaigns_by_user($userID);
  // print_r($all_camp);
  $total_earning = 0;
  $total_donors = 0;
  foreach($all_camp as $camp){
    $total_earning += $camp["currentamount"];
    $total_donors += (int)$db->get_number_of_donors($camp["id"])[0]["COUNT(*)"];
  }


  if(isset($_POST["emailId"]) && isset($_POST["name"])){
    $res = $db->update_user_details($userID, htmlentities($_POST["name"]),htmlentities($_POST["emailId"]));
    $res2 = $db->update_phone_number($userID, htmlentities($_POST["phonenum"]));
    if(!$res || !res2){
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
    <!-- FONT AWESOME CDN -->
    <script src="https://kit.fontawesome.com/f0c4100b26.js" crossorigin="anonymous"></script>
    <!-- jQuery min JS -->
    <script
      src="https://code.jquery.com/jquery-3.5.1.min.js"
      integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
      crossorigin="anonymous">
    </script>
    <!-- CUSTOM Js -->
    <script 
      src = "public/Js/dashboard.js">
    </script>
</head>
<style>
  body{
    overflow-x:hidden;
  }
  .campImgContainer{
    width:30%;    
  }
  .campImgContainer > img{
    width:100%;
    height:100%;
  }
  #err-block{
    display:none;
    background-color: #e8635c;
  }
  #err-block p{
    color:white;
    font-weight:bold;
    text-align:center;
    padding-top:0.25em;
    padding-bottom:0.25em;
  }
  input[type="file"] {
  display: block;
}
.imageThumb {
  max-height: 75px;
  border: 2px solid;
  padding: 1px;
  cursor: pointer;
}
.pip {
  display: inline-block;
  margin: 10px 10px 0 0;
}
.remove {
  display: block;
  background: #444;
  border: 1px solid black;
  color: white;
  text-align: center;
  cursor: pointer;
}
.remove:hover {
  background: white;
  color: black;
}
.backgroundFixed{
  background-color:white;
  opacity:0.5;
  position:absolute;
  top:0;
  width:100%;
  z-index:99;
  height:900px;
}
.spinnerContainer{
    width: 50%;
    background-color: white;
    margin: auto;
    z-index: 1000;
    position: absolute;
    left: 1px;
    right: 1px;
}
</style>
<body>
    <section>
        <!-- The Navigation Bar -->
        <?php  require ("templates/navbar.php"); ?>
        <!--box-->  
        <div class="box">
            <div class="box-image"></div>
                <div class="box-image-text">
                    <h2>Dashboard</h2>
                    <p>Home / Dashboard</p>
                </div>
        </div>
        <?php 
          if($can_create){
            echo('
              <!-- MODAL FOR CREATING NEW CAMPAGINS -->
              <div class="modal fade" id="createCampModal" tabindex="-1" role="dialog" aria-labelledby="createCampModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Create campagin</h5>
                      <button style="color:white;" type="button" class="close createCampClose" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <h3 style="text-align:center;">Please enter campaign details below.</h3>
                      <form action = "create_camp.php" method = "POST">
                          <div id="err-block">
                            <p></p>
                          </div>
                          <div class="form-group">
                            <label for="title">Campaign title</label>
                            <input type="text" maxlength="20" name="camp_title" class="form-control" id="title" placeholder="Campaign title">
                            <small class="text-muted">Characters left: <span style="color:#aa0000;" id="charNum">20<span></small>
                          </div>
                          <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" name="camp_location" class="form-control" id="location" placeholder="Campaign location">
                          </div>
                          <div class="form-group">
                            <label for="sdate">Start date</label>
                            <input type="date" min="'.date("Y-m-d").'" name="camp_start_date" class="form-control" id="sdate" placeholder="Campaign start date">
                          </div>
                          <div class="form-group">
                            <label for="edate">End date</label>
                            <input type="date" min="'.date("Y-m-d").'" name="camp_end_date" class="form-control" id="edate" placeholder="Campaign end date">
                          </div>
                          <div class="form-group">
                            <label for="camp_desc">Campaign description</label>
                            <textarea name="camp_desc" id="camp_desc" style="width:100%; height:100px; overflow-y:auto;white-space: pre-wrap;"></textarea>
                          </div>
                          <div class="form-group">
                            <label for="total_amt">Total amount</label>
                            <input type="number" class="form-control" id="total_amt" name="camp_total_amt" placeholder="Campaign total amount">
                          </div>
                          <input type="hidden" name="userid" value="<?= $userID ?>">
                          <div class="form-group">
                            <label for="total_amt">Upload images</label>
                            <div class="field" align="left">
                              <input type="file" id="files" name="files">
                            </div>
                            <p class="text-muted" style="font-size:13px;">You have uploaded <span class="uploaded_images" style="color:green;">0</span> images</p>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn w-100 createCampBtn" id="create_camp">Create now</button>
                          <button type="submit" class="createCampSubBtn" style="display:none;"></button>
                        </div>
                      </form>
                  </div>
                </div>
              </div>
            ');
          }
        ?>
        <!-- DASHBOARD's MAIN SECTION -->
        <section>
        <div class="container mt-4">
            <div class="monitor mb-4">
                  <div class="chart">
                    <div class="row">
                    <div class="d-flex">
                        <div>
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
                                        <h5 class="card-title"><?= $total_donors ?></h5>
                                        <p class="card-text">Total Donors</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <!-- ALL CAMPAIGN CARD -->
        <div class="d-flex justify-content-between campAndInfo">
          <div class="my-projects">
              <div class="d-flex justify-content-between">
                <h2>My projects</h2>
                <?php 
                  if($can_create){
                    echo('
                      <button data-toggle="modal" id = "addProject" data-target="#createCampModal">
                          <div class="but-text">
                          ADD NEW PROJECT
                          </div>
                      </button>
                    ');
                  }
                ?>
              </div>
              <?php  
                  if(isset($all_camp) == false){
                    //If no project is found 
                    echo("<p style='font-weight:bold';>No campagins</p>");
                  }else{
                    echo("<div style='height:450px; width:100%; overflow-y: auto;'>");
                    foreach($all_camp as $camp){ 
                      $PERCENTAGE = 0;
                      if($camp["amount"] != 0){
                        $PERCENTAGE = floor($camp["currentamount"] * 100 / $camp["amount"]);
                      }
                      echo('<div class="card mb-2 shadow-sm">
                              <a class="card-link" href="campaign-info.php?id='.get_encrypted_id($camp["id"]).'">
                                <div class="d-flex">
                                  <div class="campImgContainer">
                                    <img src="public/images/education.jpg">
                                  </div>
                                  <div class="card-body campDetails">
                                      <div class="d-flex justify-content-between">
                                        <p style="font-weight:bold; font-size:14px;">'.$camp["title"].'</p>
                                        <p style="font-size:14px;">'.$camp["startdate"].'  -- '.$camp["enddate"].'</p>
                                      </div>
                                      <div class="d-flex justify-content-between">
                                        <p style="font-weight:bold; font-size:13px;">&#8377 '.$camp["currentamount"].'</p>
                                        <p style="font-weight:bold; font-size:13px;">&#8377 '.$camp["amount"].'</p>
                                        <p style="font-weight:bold; font-size:13px">'.$PERCENTAGE.'%</p>
                                        <div class="d-flex">');if($camp["status"] == '1') {
                                            echo("<p style='text-align:end; color:green; width:100%;'>Active</p>");
                                          }else if($camp['status'] == '0'){
                                            echo("<p style='text-align:end; color:red; width:100%;'>Inactive</p>");
                                          }else if($camp['status'] == '2'){
                                            echo("<p style='text-align:end; color:black; width:100%;'>Request send</p>");
                                          }
                                          echo('
                                        </div>
                                      </div>
                                  </div>
                                </div>
                              </a>
                            </div>
                      ');
                    }
                    echo("</div>");
                  }
              ?>
          </div>
          <div class="my-info">
              <h2>Your info</h2>
              <div class="d-flex">
                <div class="profileImg">
                    <img src="public/images/av.jpg" alt="">
                </div>              
                <div class="personalDetails">
                  <div class="nameContainer">
                      <p id="name">Name</p>
                      <p style="font-weight:500;"><?= $user["name"]?></p>
                  </div>
                  <div class="emailContainer">
                      <p id="email">Email</p>
                      <p style="font-weight:500;"><?= $user["emailId"]?></p>
                  </div>
                  <div class="nameContainer">
                    <p id="name">Phone Number</p>
                    <p style="font-weight:500;"><?= isset($phoneNum[0]["phonenum"]) ? $phoneNum[0]["phonenum"] : 'No phone number added.' ?></p>
                  </div>
                </div>
              </div>
                    <button type="button" class="btn btn-warning w-100" data-toggle="modal" data-target="#editProfileModal">
                      EDIT
                    </button>
              </div>

                  <!-- EDIT PROFILE Modal -->
                  <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="ediProfileModalCenterTitle" aria-hidden="true">
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
                              <p id="name">Name</p>
                              <input class="form-control mr-sm-2" type="text" name="name" value="<?= $user["name"]?>" placeholder="first name" aria-label="text">
                            </div>
                            <div class="emailContainer">
                                <p id="email">Email</p>
                                <input class="form-control mr-sm-2" type="email" name="emailId" value="<?=$user["emailId"]?>" placeholder="Email ID" aria-label="text">
                            </div>
                            <div class="nameContainer">
                              <p id="name">Phone Number</p>
                              <input class="form-control mr-sm-2" name="phonenum" type="text" placeholder="Phone number" value="<?= isset($phoneNum[0]["phonenum"]) ? $phoneNum[0]["phonenum"] : '' ?>" aria-label="text">
                            </div>
                            <button id="save-changes" class="btn btn-primary mt-2 w-100">Save changes</button>
                          </form>
                        </div>
                        
                      </div>
                    </div>
                  </div>
          </div>
        </div>
      </div>
      <?php 
        // CHECK IF ADMIN OR NOT
        if($isAdmin){
          // LIST OF ALL USERS
          echo('
          <div class="container mt-4 users" style="max-height: 250px; overflow-y: auto;">
            <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">Name</th>
                  <th scope="col">Email id</th>
                  <th scope="col">Can approve/disapprove</th>
                  <th scope="col">Can create campaign</th>
                  <th scope="col">Admin</th>
                </tr>
              </thead>
              <tbody>');
          for($i = 0; $i < count($all_users); $i++){
            $ENCRYPTED_ID = get_encrypted_id($all_users[$i]["userID"]);
            echo('
                  <tr>
                    <td>'.$all_users[$i]['name'].'</td>
                    <td>'.$all_users[$i]['emailId'].'</td>
                    <td>'.($all_users[$i]['can_allow'] == 0 ? 'No <a href="can_allow.php?id='.$ENCRYPTED_ID.'" method="POST">Allow now!</a>' : 'YES <a href="can_allow.php?id='.$ENCRYPTED_ID.'" method="POST">Disallow now!</a>').'</td>
                    <td>'.($all_users[$i]['can_create'] == 0 ? 'No <a href="can_create.php?id='.$ENCRYPTED_ID.'" method="POST">Allow now!</a>' : 'Yes <a href="can_create.php?id='.$ENCRYPTED_ID.'" method="POST">Disallow now!</a>').'</td>
                    <td>'.($all_users[$i]['can_create'] == 0 ? 'No <a href="make_admin.php?id='.$ENCRYPTED_ID.'" method="POST">Make admin now!</a>' : 'Admin').'</td>
                  </tr>
                ');
          }

          echo('
              </tbody>
            </table>
          </div>');
        }          
      ?>
    </section>

    <?php require_once("templates/footer.php"); ?>
    
    
</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>