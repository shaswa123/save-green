<?php 
        require "../util/db.php";
        require "../util/util.php";
        session_start();
    
        $db = new DB;
        $db_obj = $db->create_db(3306,"fundraising","root","");
        
        // If logged in check if non-admin or not
        if(!isset($_SESSION["userid"]))
        {
            if(isset($_SESSION["adminid"]))
            {
                header("Location: ../admin101/dashboard.php");
            }
            header("Location: ../login.php");
            return;
        }

        $stml = $db_obj->prepare("SELECT * from users WHERE userID = :id");
        $stml->execute(array(':id' => $_SESSION["userid"]));
        $user = $stml->fetchAll(PDO::FETCH_ASSOC);
        $user = $user[0];
?>
<?php require "../templates/top.php";
    require "../templates/navbar.php";
    echo('<div class="container"><h2 class="mt-4 text-muted">Hi, '.$user["firstName"].'</h2></div>');
?>
   