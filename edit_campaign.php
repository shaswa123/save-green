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
    



    </section>
    <?php require_once("templates/footer.php"); ?>
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
      });

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