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

.navbar img {
	width: 200px;
	height: 45px;
}
.nav-link:hover{
  color:#fed857;
}
}

</style>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- The Navigation Bar -->
    <div class="navigation-bar">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <a class="navbar-brand" href="index.php">
              <img src="public/images/Save-Green-logo-PNG.png" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
              <ul class="nav navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="contact.php">Contact Us</a>
                </li>
              </ul>
            </div>
        </nav>
    </div>