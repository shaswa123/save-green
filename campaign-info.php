<?php
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
    <style>
      body{
        overflow-x:hidden;
      }
    </style>
</head>
<body>
    <?php 
      if(!empty($err)){
        echo("<script>alert('".$err."');</script>");
      }
    ?>
    <section>
        <!-- The Navigation Bar -->
        <div class="navigation-bar">
            <nav class="navbar">
                <a class="navbar-brand" href="index.php">
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
                    <h2>Explore</h2>
                    <?php echo("<p>Home / Campaigns / ".$camp[0]["title"]."</p>") ?>
                    <!-- <p>Home / Campaigns /KeyFrame-portable 3D Printer</p> -->
                </div>
        </div> 
        <div class="info-card">
            <div class="card mb-3" style="max-width: 1200px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <div class="landing-image">
                        <?php // have image ?>
                        <img src="public/images/planting.jpg" class="card-img" alt="...">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $camp[0]["title"]; ?></h5>
                            <p class="card-text"><small class="text-muted"><?php echo("Location:".$camp[0]["location"]); ?></small></p>
                            <div class="avatar">
                                <a href="author">
                                  <img src="public/images/av.jpg" alt="avatar">
                                  <div class="text">
                                  <text-muted><?php echo("By ".$user_name); ?></text-muted>
                                  </div>
                                </a>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: <?php echo(floor($camp[0]["currentamount"]*100 / $camp[0]["amount"])) ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="stat-text">
                                <?php echo("&#8377 ".$camp[0]["currentamount"]); ?>
                                <div class="text-muted">
                                  <?php echo("raised of &#8377 ".$camp[0]["amount"]); ?>
                                </div>
                                <div class="perc">
                                <p><?= (floor($camp[0]["currentamount"] * 100 / $camp[0]["amount"]))."%" ?></p>
                                </div>
                            </div>
                            <div class="sidebar">
                                <span class="tool">...</span>
                                <div class="formz">
                                <?php // Create a page for payment ?>
                                <form method="post" class="cart">
                                    
                                    &#8377 
                                
                                    <input type="number" step="any" min="10" name="donate-amount" id="donateAmt" class="input-text amount donate-amount" value="25" data-min-price="10" data-max-price>
                                    <input type="hidden" value="144" name="add-to-cart">
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
                  <input type="hidden" name="donateAmount" id="donateAmountHidden">
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
                      <?php echo $camp[0]["description"] ?>
                    </div>
                    <div class="tab-pane fade" id="donor-list" role="tabpanel" aria-labelledby="donor-list-tab">
                        <table style="<?php if($userPresent) echo("width = 75%;"); else echo("width:50%;");?>">
                            <tbody>
                                <tr>
                                    <th>Name</th>
                                    <?php 
                                    if($userPresent){
                                      echo("<th>Email</th>
                                        <th>Payment ID</th>
                                        <th>Amount</th>
                                      ");
                                    }
                                    ?>
                                    <th>Date</th>
                                </tr>
                                <?php 
                                  if(isset($donors)){
                                    for($i = 0; $i < count($donors); $i++){
                                      echo("<tr><td>".$donors[$i]["name"]."</td>");
                                        if($userPresent){
                                          echo('<td>'.$donors[$i]["email"].'</td>
                                            <td>'.$donors[$i]["txnid"].'</td>
                                            <td>'.$donors[$i]["amount"].'</td>
                                          ');
                                        }
                                        echo("<td>".$donors[$i]["date"]."</td>
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
    <!-- <footer>
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
    </footer> -->
        <!-- jQuery min JS -->
    <script
      src="https://code.jquery.com/jquery-3.5.1.min.js"
      integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
      crossorigin="anonymous">
    </script>
    <script>
      document.getElementsByClassName("donate-button")[0].addEventListener("click",()=>{
        let amt = document.getElementById("donateAmt").value;
        document.getElementById("donateAmountHidden").value = amt;
      })
      document.getElementById("razorPayBtn").addEventListener("click", ()=>{
        
      })
    </script>
   <!-- <script src="main.js"></script>  -->
</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>