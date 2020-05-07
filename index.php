<?php 
  require "util/util.php";
  require "util/db.php";
  $db = new DB;
  $db_obj = $db->create_db(3306,"fundraising","root","");
  $all_camp = $db->get_all_campaigns();
  // print_r([$all_camp[0]]);
?>


<?php 
  require "templates/top.php";
  require "templates/navbar.php";
?>
  <!--Landing Images-->
  <div class="carousel-home-page">
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
          <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="public/images/planting.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h1>First slide label</h1>
              <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
              <button class="btn btn-danger">Donate now</button>
            </div>
          </div>
          <div class="carousel-item">
            <img src="public/images/education.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h1>Second slide label</h1>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
              <button class="btn btn-danger">Donate now</button>
            </div>
          </div>
          <div class="carousel-item">
            <img src="public/images/other.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h1>Third slide label</h1>
              <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
              <button class="btn btn-danger">Donate now</button>
            </div>
          </div>
        </div>
    </div>
    <div class="promo-container shadow">
      <div class="video-container">
        <iframe src="https://www.youtube.com/embed/TFNUij_1I5Q" style="width:100%; min-height:100%;" frameborder="0"></iframe>
      </div>
      <div class="title">
        Help US!
      </div>
      <div class="desc">
        We raise funds for people in need and with your help we can make everyone's life happy
      </div>
    </div>
  </div>

    
    <main>
      <!--Card Caruosel-->
        <section class="section-1">
          <div class="section-title container">
            Latest Fundraisers
          </div>
            <div class="carousel-main-page container">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                      <?php $k = 0; $limit; if(count($all_camp) < 3){$limit = 1;}else{$limit = 3;} for($i = 0; $i < (count($all_camp) %3 == 0 ? 3 : count($all_camp) % 3); $i++){
                         if($k == 0){ echo('<div class="carousel-item active">');}else{ echo('<div class="carousel-item">');}
                           echo('<div class="d-flex justify-content-around">');
                       for($j=0; $j <$limit; $j++){ 
                            echo('<div class="card" style="width: 18rem;">
                              <img src="public/images/education.jpg" class="card-img-top" alt="...">
                              <div class="card-body">
                                <h5 class="card-title">'.$all_camp[$k]["title"].'</h5>
                                <p class="card-text">'.str_split($all_camp[$k]["description"],25)[0].'...</p>
                              </div>
                              <div class="card-body">
                                <label>'.(float)$all_camp[$k]["currentamount"].' raised</label>
                                <div class="progress mt-2 mb-2">
                                   <div class="progress-bar" role="progressbar" style="width:'.(float)$all_camp[$k]["currentamount"]*100/$all_camp[$k]["amount"].'%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">'.(float)$all_camp[$k]["currentamount"]*100/$all_camp[$k]["amount"].'%</div>
                                 </div>
                              </div>
                              <div class="card-body">
                                <a href="viewcampaign.php?id='.get_encrypted_id($all_camp[$k]["id"]).'" style="text-decoration: none;" class="card-link">SEE MORE</a>
                              </div>
                            </div>');
                            $k++;
                        }    
                        echo('</div>
                       </div>');
                      }
                      ?>
                  </div>
            </div>
          </section>
          <!--All the Fundraiser-->
          <section class="section-2 mb-4" id="fundraisers">
            <div class="container">
              <h1 class="section-title">All Fundraisers</h1>
              <div class="tags d-flex">
                <div>
                  <p>SORT BY:</p>
                </div>
                <div class="form-group" style="width:25%;">
                  <form method="get" class="d-flex" style="width:100%;">
                    <select name="op" class="form-control" id="select">
                      <option>Education</option>
                      <option>Food</option>
                      <option>Env</option>
                    </select>
                    <button class="btn btn-danger">SEARCH</button>
                  </form>
                </div>
              </div>
              <div class="all-cards">
              <?php 
                $k = count($all_camp) - 1;
                for($i = 0; $i < count($all_camp) / 3 + 1; $i++)
                {
                  echo('<div class="rows"> <div class="d-flex justify-content-around">');
                  for($j =0; $j < 3; $j++){
                    echo('<div class="card" style="width: 18rem;">
                        <img src="uploadimages/'.$all_camp[$k]["image"].'" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">'.$all_camp[$k]["title"].'</h5>
                          <p class="card-text">'.str_split($all_camp[$k]["description"],25)[0].'...</p>
                        </div>
                        <div class="card-body">
                          <div class="progress mb-2">
                            <div class="progress-bar" role="progressbar" style="width:'.(float)$all_camp[$k]["currentamount"]*100/$all_camp[$k]["amount"].'%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">'.(float)$all_camp[$k]["currentamount"]*100/$all_camp[$k]["amount"].'%</div>
                          </div>
                          <a href="viewcampaign.php?id='.get_encrypted_id($all_camp[$k]["id"]).'" style="text-decoration: none;">SEE MORE</a>
                        </div>
                       </div>
                      </div>
                     </div>');
                     $k--;
                     if($k <= 0)
                     {
                      break;
                     }
                  }
                }
              ?>


               </div>
          </section>
    </main>

    <footer class="mt-4">
        <div class="container-fluid p-0">
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
    </footer>
<?php require "templates/foot.php"; ?>
