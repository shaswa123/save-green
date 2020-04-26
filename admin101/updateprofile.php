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
    //GET user
    $stml = $db_obj->prepare("SELECT * from users WHERE userID = :id");
    $stml->execute(array(':id' => $_SESSION["adminid"]));
    $user = $stml->fetchAll(PDO::FETCH_ASSOC);
    $user = $user[0];

    // GET phone number (max - 2)
    $stml = $db_obj->prepare("SELECT * from phonenumbers WHERE userid = :id");
    $stml->execute(array(':id' => $user["userID"]));
    $phone_nums = $stml->fetchAll(PDO::FETCH_ASSOC);
?>

<?php require "../templates/top.php";
      require "../templates/adminnav.php";
?>
    <link rel="stylesheet" href="../public/css/adminview.css">
    <div  style="width:30%; margin:auto; margin-top:5em;">
        <form method="POS">
            <div class="row">
                <div class="col">
                First name
                <input type="text" class="form-control" name="firstName" value = <?= $user["firstName"] ?>>
                </div>
                <div class="col">
                Last name
                <input type="text" class="form-control" name="lastName" value=<?= $user["lastName"]?>>
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" class="form-control" id="email" value=<?= $user["emailId"]?>>
            </div>
            <div class="row">
                <div class="col">
                Phone number
                <input type="text" class="form-control" name="phonenum" value=<?= $phone_nums[0]["phonenum"]?>>
                </div>
                <div class="col">
                Alternate phone number
                <input type="text" class="form-control" name="altphonenum">
                </div>
            </div>
            <button class="btn btn-danger mt-4 w-100">Update profile</button>
        </form>
    </div>