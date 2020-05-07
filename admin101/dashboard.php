<?php 
    require "../util/db.php";
    require "../util/util.php";
    session_start();
    $db = new DB;
    $db_obj = $db->create_db(3306,"fundraising","root","");

    // If logged in check if admin or not
    if(!isset($_SESSION["adminid"]))
    {
        header("Location: ../login.php");
        return;
    }

    // GET the user
    $user = $db->get_user_by_id($_SESSION["adminid"])[0];

    // GET all the fund raisers associated to the user
    $all_camp = $db->get_all_campaigns($user["userID"]);

?>

<?php 
    require "../templates/top.php";
    require "../templates/adminnav.php";
?>
<div class="container mt-4">
    <?php echo('<h2 style="color:rgba(0,0,0,0.7);">Hi, '.$user["firstName"].'</h2>'); ?>
    <h4 class="mt-3" style="color:rgba(0,0,0,0.7);">Active Campaigns</h4>
</div>
              <div class="all-cards">
              <?php 
                $k = count($all_camp) - 1;
                for($i = 0; $i < count($all_camp) / 3 + 1; $i++)
                {
                  echo('<div class="rows mt-2"> <div class="d-flex justify-content-around">');
                  for($j =0; $j < 3; $j++){
                    echo('<div class="card" style="width: 18rem;">
                        <img src="../uploadimages/'.$all_camp[$k]["image"].'" class="card-img-top" style="object-fit:cover;" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">'.$all_camp[$k]["title"].'</h5>
                          <p class="card-text">'.str_split($all_camp[$k]["description"],25)[0].'...</p>
                        </div>
                        <div class="card-body">
                          <div class="progress mb-2">
                            <div class="progress-bar" role="progressbar" style="width:'.(float)$all_camp[$k]["currentamount"]*100/$all_camp[$k]["amount"].'%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">'.(float)$all_camp[$k]["currentamount"]*100/$all_camp[$k]["amount"].'%</div>
                          </div>
                          <a href="/save-green/viewcampaign.php?id='.get_encrypted_id($all_camp[$k]["id"]).'" style="text-decoration: none;">SEE MORE</a>
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
<link rel="stylesheet" href="../public/css/adminview.css">
<?php require "../templates/foot.php"; ?>