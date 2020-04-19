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
            <img src="images/planting.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h1>First slide label</h1>
              <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
              <button class="btn btn-danger">Donate now</button>
            </div>
          </div>
          <div class="carousel-item">
            <img src="images/education.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h1>Second slide label</h1>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
              <button class="btn btn-danger">Donate now</button>
            </div>
          </div>
          <div class="carousel-item">
            <img src="images/other.jpg" class="d-block w-100" alt="...">
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
                        <div class="carousel-item">
                          <div class="d-flex justify-content-around">
                            <div class="card" style="width: 18rem;">
                              <img src="images/education.jpg" class="card-img-top" alt="...">
                              <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                              </div>
                              
                              <div class="card-body">
                                <a href="#" class="card-link">Card link</a>
                                <a href="#" class="card-link">Another link</a>
                              </div>
                            </div>
                          </div>
                        </div>
                          <div class="carousel-item">
                            <div class="d-flex justify-content-around">
                              <div class="card" style="width: 18rem;">
                                <img src="images/study.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                  <h5 class="card-title">Card title</h5>
                                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                </div>
                                
                                <div class="card-body">
                                  <a href="#" class="card-link">Card link</a>
                                  <a href="#" class="card-link">Another link</a>
                                </div>
                            </div>
                            </div>
                          </div>
                      <div class="carousel-item active">
                        <div class="d-flex justify-content-around">
                            <div class="card" style="width: 18rem;">
                                <img src="images/education.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                  <h5 class="card-title">Card title</h5>
                                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                </div>
                                
                                <div class="card-body">
                                  <a href="#" class="card-link">Card link</a>
                                  <a href="#" class="card-link">Another link</a>
                                </div>
                            </div>
                            <div class="card" style="width: 18rem;">
                                <img src="images/study.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                  <h5 class="card-title">Card title</h5>
                                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                </div>
                                
                                <div class="card-body">
                                  <a href="#" class="card-link">Card link</a>
                                  <a href="#" class="card-link">Another link</a>
                                </div>
                            </div>
                            <div class="card" style="width: 18rem;">
                                <img src="images/charity.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                  <h5 class="card-title">Card title</h5>
                                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                </div>
                                
                                <div class="card-body">
                                  <a href="#" class="card-link">Card link</a>
                                  <a href="#" class="card-link">Another link</a>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
            </div>
          </section>
          <!--All the Fundraiser-->
          <section class="section-2">
            <div class="container">
              <h1 class="section-title">All Fundraisers</h1>
              <div class="tags d-flex">
                <div>
                  <p>SORT BY:</p>
                </div>
                <div class="form-group" style="width:25%;">
                  <form action="" class="d-flex" style="width:100%;">
                    <select class="form-control" id="select">
                      <option>Education</option>
                      <option>Food</option>
                      <option value="">Env</option>
                    </select>
                    <button class="btn btn-danger">SEARCH</button>
                  </form>
                </div>
              </div>
              <div class="all-cards">
                <div class="rows">
                  <div class="d-flex justify-content-around">
                    <div class="card" style="width: 18rem;">
                        <img src="images/education.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                        
                        <div class="card-body">
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                            Details
                        </button>
                        <!-- Modal -->
                          <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                     Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dolorem rerum tempore, totam debitis voluptates aliquid laborum doloribus saepe accusamus! Deleniti!
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        </div>
                    </div>
                    <div class="card" style="width: 18rem;">
                        <img src="images/study.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                        
                        <div class="card-body">
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                            Details
                        </button>
                        <!-- Modal -->
                          <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                     Lorem, ipsum dolor sit amet consectetur adipisicing elit. Commodi voluptas dicta ad ducimus fugit exercitationem saepe sed deleniti, nam vitae.
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        </div>
                    </div>
                         
                        </div>
                  </div>
                    <div class="rows">
                      <div class="d-flex justify-content-around">
                        <div class="card" style="width: 18rem;">
                            <img src="images/charity.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                              <h5 class="card-title">Card title</h5>
                              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                            
                            <div class="card-body">
                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                                Details
                            </button>
                            <!-- Modal -->
                              <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem odit illo eum eos adipisci! Quia a nemo at impedit autem!
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            </div>
                        </div>
                      </div>
                    </div>
                        </div>
                    </div>
                </div>
                </div>
              </div>
            </div>
          </section>
    </main>
    <section style="height: 500px; width: 100%;">

    </section>

    <footer>
        <div class="container-fluid p-0">
          <div class="row-text-left">
            <div class="d-flex pt-3">
              <div class="col-md-3">
                  <img src="./images/Save-Green-logo-PNG.png" style="width: 50%;" alt="">
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
