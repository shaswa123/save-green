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
    $stml = $db_obj->prepare("SELECT * from users WHERE userID = :id");
    $stml->execute(array(':id' => $_SESSION["adminid"]));
    $user = $stml->fetchAll(PDO::FETCH_ASSOC);
    $user = $user[0];

?>

<?php 
    require "../templates/top.php";
    require "../templates/adminnav.php";
?>
<div class="container mt-4">
    <?php echo('<h2 style="color:rgba(0,0,0,0.7);">Hi, '.$user["firstName"].'</h2>'); ?>
    <h4 class="mt-3" style="color:rgba(0,0,0,0.7);">Active Campaigns</h4>
</div>

<link rel="stylesheet" href="../public/css/adminview.css">
<?php require "../templates/foot.php"; ?>