<?php 
    require "util/util.php";
    require "util/db.php"; 
    $db = new DB;
    $db_obj = $db->create_db(3306,"fundraising","root","");
    
    
    $campid = get_decrypted_id($_GET["id"]);
    $campid = explode('_', $campid)[1];
    $camp = $db->get_campaigns_by_id($campid);
    //print_r($camp[0]["image"]);  
    $img = $camp[0]["image"];  
    // print($img);
    $user_name = $db->get_user_by_id($camp[0]["userID"])[0]["firstName"];
    
    if(isset($_POST["donate-amount"]) && $_POST["donate-amount"] >= 10){
      require "razor/pay.php";
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
                                
                                    <input type="number" step="any" min="10" placeholder="25" name="donate-amount" class="input-text amount donate-amount" value="25" data-min-price="10" data-max-price>
                                    <input type="hidden" value="144" name="add-to-cart">
                                    <button type="submit" class="donate-button">Donate to Campaign</button>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
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
                        <table>
                            <tbody>
                                <tr>
                                    <th>Name</th>
                                    <th>Donate Amount</th>
                                    <th>Date</th>
                                </tr>
                                <tr>...</tr>
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
    
</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>