<?php
    if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) 
      ob_start('ob_gzhandler'); 
    else ob_start();
    session_start();
    require "util/util.php";
    require "util/db.php"; 
    $db = new DB;
    $db_obj = $db->create_db(3306,"fundraising","root","");
    
    //GET campagin details using the ID from the URL's GET PARAM    
    $campid = get_decrypted_id($_GET["id"]);
    $campid = explode('_', $campid)[1];
    $camp = $db->get_campaigns_by_id($campid);

    //GET the images associated with the CAMPAGIN
    $imgs = $db->get_images($campid);
    $imgCounter = 0;
    $total_images = count($imgs);

    //GET the details of the CAMPAIGN creater
    $user_name = $db->get_user_by_id($camp[0]["userID"])[0]["firstName"];

    //GET donor id list from DB
    $donations = $db->get_all_donations($campid);

    //All the donors
    $donors;
    $amt = 0;
    for($i = 0; $i < count($donations); $i++){
      $donors[$i]["date"] = $donations[$i]["txndate"];
      $amt = $amt + $donations[$i]["amount"];
      $donors[$i]["txnid"] = $donations[$i]["txnid"];
      $donors[$i]["amount"] = $donations[$i]["amount"];
      $temp = $db->get_donor_by_id($donations[$i]["donorid"])[0];
      $donors[$i]["name"] = $temp["name"];
      $donors[$i]["email"] = $temp["email"];

    }

    $desc = explode("\n",$camp[0]["description"]);

    //Total donation amount to update current donated amount in CAMPAGIN TABLE
    if($amt != $camp[0]["currentamount"] && count($donations) > 0)
    {
      //IF the two total amounts from donation and campaign tables are different, they should not be different
      $db->update_campaign_amount($campid, $amt);
      $camp = $db->get_campaigns_by_id($campid);
    }
    $userPresent = false;    
    //If the campaigner is visiting the page
    if(isset($_SESSION["adminid"]) || isset($_SESSION["userid"])){
      //Check if this campaign is created by you or not
      $userid = isset($_SESSION["adminid"]) == true ? $_SESSION["adminid"] : $_SESSION["userid"];
      if($userid == $camp[0]["userID"]){
        //Show the email, and txnid, amount
        $userPresent = true;
      }
    }

    $err = 0;
    if(isset($_POST["emailId"])){
      if($_POST["emailId"] == ""){
        $err = "Invalid emailId. Please try again.";
      }else if($_POST["name"] == ""){
        $err = "Invalid Name. Please try again.";
      }else if($_POST["pancardNum"] == ""){
        $err = "Invalid Pan card Number. Please try again.";
      }else if($_POST["phoneNumber"] == ""){
        $err = "Invalid Phonen number. Please try again.";
      }else if($_POST["address"] == ""){
        $err = "Invalid address. Please try again.";
      }
      else{
        // $rec = $db->get_orders_for_campaigns()[0]["COUNT(*)"];
        require "razor/pay.php";
      }
    }
    
    //CHECK IF LOGIN
    $userid;
    if(isset($_SESSION["userid"]) || isset($_SESSION["adminid"])){
      $userid = isset($_SESSION["userid"]) == true ? $_SESSION["userid"] : $_SESSION["adminid"];
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campaign-Info</title>
    <link rel="stylesheet" href="public/css/style-info.css">
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
    <style>
      body{
        overflow-x:hidden;
      }
      .box-image {
        top:0!important;
      }
      .box .box-image-text h2{
        bottom:200px!important;
      }
      .box .box-image-text p{
        bottom:200px!important;
      }
    </style>
</head>
<body>
<?php 
      if(!empty($err)){
        echo("<script>alert('".$err."');</script>");
      }
    ?>
    <?php require "templates/navbar.php";?>
    <div class="w-100 spinnerContainer" style="height:600px;">
        <div style="margin:auto; width:fit-content; padding-top:300px;">
          <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
          </div>
          <p class="Spinneradvice"></p>
        </div>
    </div>
    <section class="main-body-section" style="display:none;">
        <!--box-->  
        <div class="box">
            <div class="box-image"></div>
                <div class="box-image-text">
                    <h2>Explore</h2>
                    <?php echo("<p>Home / Campaigns / ".$camp[0]["title"]."</p>") ?>
                </div>
        </div> 
        <div class="info-card">
            <div class="card mb-3" style="max-width: 1200px;">
                <div class="row no-gutters">
                    <div>
                        <div class="landing-image">
                        <img src="<?php if($total_images == 0) {echo("public/images/bg4.jpeg"); }else { echo($imgs[$imgCounter++]["imgurl"]); }?>" class="card-img" alt="...">
                        </div>
                    </div>
                    <div>
                        <div class="card-body infoContainer">
                            <h5 class="card-title"><?php echo $camp[0]["title"]; ?></h5>
                            <p class="card-text"><small class="text-muted"><?php echo("Location:".$camp[0]["location"]); ?></small></p>
                            <div class="avatar">
                                <a href="author" class="d-flex">
                                  <img src="public/images/av.jpg" alt="avatar">
                                  <div class="text">
                                  <text-muted><?php echo("By ".$user_name); ?></text-muted>
                                  </div>
                                </a>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: <?php echo(floor($camp[0]["currentamount"]*100 / $camp[0]["amount"])) ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="stat-text d-flex justify-cotent-between">
                                <div class="d-flex">
                                  <?php echo("&#8377 ".$camp[0]["currentamount"]); ?>
                                  <div class="text-muted">
                                    <?php echo("raised of &#8377 ".$camp[0]["amount"]); ?>
                                  </div>
                                </div>
                                <div class="perc">
                                <p><?= (floor($camp[0]["currentamount"] * 100 / $camp[0]["amount"]))."%" ?></p>
                                </div>
                            </div>
                            <div class="sidebar">
                                <div class="formz">
                                <form method="post" class="cart">
                                    <button type="button" data-toggle="modal" data-target="#personalInfoModal" class="donate-button">Donate to Campaign</button>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <!-- Modal -->
        <div class="modal fade" id="personalInfoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header" style="background-color:#2e3c4b; color:white;">
                <h5 class="modal-title" id="exampleModalLongTitle">Personal information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span style="color:white;" aria-hidden="true">&times;</span>
                </button>
              </div>
              <form method="POST">
                <div class="modal-body">
                  <?php 
                    if($err != ""){
                      echo(
                        '<script>alert('.$err.')</script>'
                      );
                    }
                  ?>
                  <div class="form-group">
                    <label>Donation amount</label>
                    <input type="number" name="donateAmount" required class="form-control" placeholder = "Enter donation amount">
                  </div>
                  <div class="form-group">
                    <label for="firstName">Name</label>
                    <input type="text" name="name" require class="form-control" id="firstName" placeholder="Enter your name">
                  </div>
                  <div class="form-group">
                    <label for="emailId">Email address</label>
                    <input type="text" name="emailId" require class="form-control" id="emailId" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label for="phoneNumber">Phone number</label>
                    <input type="text" name="phoneNumber" require class="form-control" id="phoneNumber" placeholder="Enter phone number">
                  </div>
                  <div class="form-group">
                    <label for="address">Permanent address</label>
                    <input type="text" name="address" require class="form-control" id="address" placeholder="Enter address">
                  </div>
                  <div class="form-group">
                    <label for="pancardNum">Pan card number</label>
                    <!-- pattern="[a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}" -->
                    <input type="text" name="pancardNum" require class="form-control" aria-describedby="pancardHelp"  id="pancardNum" placeholder="Enter pan card number">
                    <small id="pancardHelp" class="form-text text-muted">We'll never share your pan card details with anyone else.</small>
                  </div>
                  <input type="hidden" name="campid" value="<?= $campid ?>">
                </div>
                <div class="modal-footer d-flex justify-content-between">
                  <button class="yellow-button" style="width:100%" id="razorPayBtn">Proceed to donate</button>
                  <!-- <button type="submit" method="POST" class="yellow-button infoSubmitBtn w-100">SUBMIT</button> -->
                </div>  
              </form>
            </div>
          </div>
        </div>
        <!-- INFO AND LIST -->
        <div class="content">
            <div class="tabs">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="campaign-story-tab" data-toggle="tab" href="#campaign-story" role="tab" aria-controls="campaign-story" aria-selected="true">Campaign Story</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="donor-list-tab" data-toggle="tab" href="#donor-list" role="tab" aria-controls="donor-list" aria-selected="false">Donor List</a>
                    </li>
                  </ul>
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="campaign-story" role="tabpanel" aria-labelledby="campaign-story-tab">
                      <?php
                        for($i =0; $i < count($desc); $i++){
                          echo('<p style="white-space:pre-line;" id="desc_p" class="desc_para">'.$desc[$i].'</p>');
                          if(strlen($desc[$i]) > 50 && $imgCounter < $total_images){                            
                            echo('<img style="width:100%; height:500px; object-fit:contain; margin-top:0.5em; margin-bottom:0.5em;" src = "'.$imgs[$imgCounter++]["imgurl"].'">');
                          }
                        }
                        if($imgCounter < $total_images){
                          while($imgCounter < $total_images){
                            echo('<img style="width:100%; height:500px; object-fit:contain;" src = "'.$imgs[$imgCounter++]["imgurl"].'">');
                          }
                        }
                      ?>
                    </div>
                    <div class="tab-pane fade" id="donor-list" role="tabpanel" aria-labelledby="donor-list-tab">
                        <table class="table" style="width:100%;">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Name</th>
                                    <?php 
                                    if($userPresent){
                                      echo("<th>Email</th>
                                        <th>Payment ID</th>
                                        ");
                                      }
                                      ?>
                                    <th>Amount</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                  if(isset($donors)){
                                    for($i = 0; $i < count($donors); $i++){
                                      echo("<tr><td>".$donors[$i]["name"]."</td>");
                                        if($userPresent){
                                          echo('<td>'.$donors[$i]["email"].'</td>
                                            <td>'.$donors[$i]["txnid"].'</td>
                                            ');
                                          }
                                        echo(" <td>Rs ".$donors[$i]["amount"]."</td>
                                        <td>".explode(' ',$donors[$i]["date"])[0]."</td>
                                        </tr>
                                      ");
                                    }
                                  }
                                ?>
                            </tbody>
                        </table>
                    </div>
                  </div>
            </div>
        </div>
    </section>
    <?php require_once("templates/footer.php"); ?>
    <script>
      setTimeout(() => {
        let spinnerContainer = document.getElementsByClassName("spinnerContainer")[0].style.display = "none";
        let main_body = document.getElementsByClassName("main-body-section")[0].style.display = "block";
      },2000)
      
    </script>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>