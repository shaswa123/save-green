<?php 
    if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) 
      ob_start('ob_gzhandler'); 
    else ob_start();

    session_start();
    require "util/util.php";
    require "util/db.php"; 

    $db = new DB;
    $db_obj = $db->create_db(3306,"fundraising","root","");
    
    //CHECK IF LOGIN
    $userid;
    $isAdmin = false;
    if(isset($_SESSION["userid"]) || isset($_SESSION["adminid"])){
      $userid = isset($_SESSION["userid"]) == true ? $_SESSION["userid"] : $_SESSION["adminid"];
    }

    //GET campagin details using the ID from the URL's GET PARAM    
    $campid = get_decrypted_id($_GET["id"]);
    $campid = explode('_', $campid)[1];
    $camp = $db->get_campaigns_by_id($campid);

    //GET the images associated with the CAMPAGIN
    $imgs = $db->get_images($campid);
    $imgCounter = 0;
    $total_images = count($imgs);

    $desc = explode("\n",$camp[0]["description"]);

    if(isset($_POST["desc"]) && $_POST["title"] && $_POST["total_amt"]){
      // UPDATE DB WITH NEW INFORMATION
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit campaign</title>
    <link rel="stylesheet" href="public/css/style-info.css">
    <link href="https://fonts.googleapis.com/css2?family=Barlow&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- FONT AWESOME CDN -->
    <script src="https://kit.fontawesome.com/f0c4100b26.js" crossorigin="anonymous"></script>
    <style>
      body{
        overflow-x:hidden;
      }
    </style>
        <!-- jQuery min JS -->
    <script
      src="https://code.jquery.com/jquery-3.5.1.min.js"
      integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
      crossorigin="anonymous">
    </script>
    <script>
      window.onload = () => {
        setTimeout(() => {
          let spinnerContainer = document.getElementsByClassName("spinnerContainer")[0].style.display = "none";
          let main_body = document.getElementsByClassName("main-body-section")[0].style.display = "block";
        },2000)
      }
      
    </script>
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
                        </div>
                    </div>
                </div>
            </div> 
        </div>

    </section>
    <?php require_once("templates/footer.php"); ?>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>