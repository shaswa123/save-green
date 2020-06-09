
<style>
/*Navbar CSS*/
.navigation-bar {
	width: 100%;
	background: #2e3c4b;
	z-index: 99;
}

.navbar ul li a {
	font-family: 'Barlow', sans-serif;
	color: #ffffff;
	font-weight: bold;
}

.nav-link:hover {
	color: #fed857 !important;
}

.navbar img {
	width: 200px;
	height: 45px;
}
.nav-link:hover{
  color:#fed857;
}
.number_of_requests{
  color: black;
  position: absolute;
  right: 1px;
  top: -5px;
  width: 20px;
  text-align: center;
  height: 20px;
  border-radius: 50%;
  background-color: white;
}

.camp_requests{
  position:relative;
}
</style>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- The Navigation Bar -->
    <?php 
      $temp = explode("/",$_SERVER["REQUEST_URI"]);
      $len = count($temp);
      $file = explode(".php",$temp[$len - 1])[0];
    ?>
    <div class="navigation-bar">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <a class="navbar-brand" href="<?php 
              if($file == "dashboard" || $file == "ngo_detail"){
                echo("dashboard.php");
              }else{
                echo("index.php");
              } 
            ?>">
              <img src="public/images/Save-Green-logo-PNG.png" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
              <ul class="nav navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="<?php  
                      if($file == "dashboard" || $file == "ngo_detail"){
                        echo("dashboard.php");
                      }else{
                        echo("index.php");
                      }
                  ?>">Home</a>
                </li>
                <?php 
                  if(isset($_SESSION["adminid"])){
                    echo ('
                      <li class="nav-item">
                        <a class="nav-link" href="ngo_detail.php">NGO details</a>
                      </li>
                      <li class="nav-item camp_requests">
                        <div clas="number_of_requests" style="  color: black;
                          position: absolute;
                          right: 1px;
                          top: -5px;
                          width: 20px;
                          text-align: center;
                          height: 20px;
                          border-radius: 50%;
                          background-color: white;">'.$db->get_all_unconfirmed_campagins()[0]["COUNT(*)"].'</div>
                        <a class="nav-link" href="requests.php">Campaign requests</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="website_dashboard.php">Website dashboard</a>
                      </li>
                    ');
                  }
                
                ?>
                <?php
                    if($file != "dashboard" && $file != "ngo_detail"){
                      echo('
                        <li class="nav-item">
                          <a class="nav-link" href="contact.php">Contact Us</a>
                        </li> 
                      ');
                    }
                ?>
              </ul>
            </div>
        </nav>
    </div>
    