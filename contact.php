<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CrowdFunding</title>
    <link rel="stylesheet" href="public/css/style-final.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/f0c4100b26.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<style>
  html{
    scroll-behavior : smooth;
  }
  .navigation-bar{
    background-color:#2e3c4b!important;
  }
  .navigation-bar .nav-link{
      color:white!important;
  }
  .contactOnSubmit{
    width:50%;
    margin:auto;
    margin-top:5em;
    margin-bottom:5em;
    height:500px;
  }
  .contactOnSubmit  p{
    height:fit-content;
    text-align:center;
    font-size:150px;
  }
  .contactOnSubmit div{
    height:fit-content;
    margin:auto;
  }

</style>
<body>
    <?php require "templates/navbar.php";  ?>
    <div style="width:fit-content; margin:auto;" class="gform">
        <iframe style= "margin-top:5em;" src="https://docs.google.com/forms/d/e/1FAIpQLSeEXPNcFyWwHoqdRGhWcovzLLOH8XtLqJeVEguVyCc7iA1XRA/viewform?embedded=true" width="640" height="900" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>
    </div>
    <div class="contactOnSubmit shadow" style="display:none;">
      <div class="w-100">
        <p><i class="fas fa-check-circle"></i></p>
        <h3 style="text-align: center;">Thank you!</h3>
        <h5 style="text-align:center">Your submission has been received</h5>
      </div>
    </div>
    <?php require_once("templates/footer.php"); ?>
    
    
    <!-- jQuery min JS -->
    <script
      src="https://code.jquery.com/jquery-3.5.1.min.js"
      integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
      crossorigin="anonymous"></script>
    <!-- ANIMATE ON SCROLL(A0S) JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
    <!-- CUSTOM JS FILES -->
    <script src="main.js"></script>
    <script>
      document.getElementsByClassName("appsMaterialWizButtonPaperbuttonContent")[0].onclick = () => {
        document.getElementsByClassName("gform")[0].style.display = "none";
        document.getElementsByClassName("contactOnSubmit")[0].style.display = "block";
        document.getElementsByClassName("contactOnSubmit")[0].classList.add("d-flex");

      }

    </script>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>