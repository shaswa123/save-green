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
    $stml->execute(array(':id' => $_GET["id"]));
    $user = $stml->fetchAll(PDO::FETCH_ASSOC);
    $user = $user[0];
    
    // GET phone number (max - 2)
    $stml = $db_obj->prepare("SELECT * from phonenumbers WHERE userid = :id");
    $stml->execute(array(':id' => $_GET["id"]));
    $phone_nums = $stml->fetchAll(PDO::FETCH_ASSOC);
?>

<?php require "../templates/top.php" ?>
    <div class="container mt-4">
        <div class="d-flex">
            <?php echo('<h3>'.$user["firstName"].'</h3>')?>
            <?php echo('<h5 style="margin:auto; margin-left:4em;">'.$user["emailId"].'</h5>') ?>
        </div>
        <?php echo('<p style="font-size: 15px" class="text-muted">Phone number: '.$phone_nums[0]["phonenum"]).'</p>' ?>
        <?php if(isset($phone_nums[1])){
            echo('<p style="font-size: 15px" class="text-muted">Phone number: '.$phone_nums[1]["phonenum"].'</p>');
        } ?>
        <div class="d-flex">
            <h4>All the campaings</h4>
            <form method="post">
                <select class="form-control form-control-sm" style="margin-left:10em;">
                    <option>Active</option>
                    <option>Deactived</option>
                    <option>Finished</option>
                </select>
            </form>
        </div>
        <?php echo('') ?>
    </div>
<?php require "../templates/foot.php" ?>
