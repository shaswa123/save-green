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

    // GET all users
    $all_users = $db->get_all_users();
    // foreach($all_users as $sub_arr)
    // {
    //     print($sub_arr["userID"]);
    //     print($sub_arr["firstName"]);
    // }
?>

<?php 
  require "../templates/top.php";
?>
    <link rel="stylesheet" href="../public/css/adminview.css">
    <div class="container mt-4">
        <h2>ALL USERS</h2>
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                <th scope="col">First name</th>
                <th scope="col">Last name</th>
                <th scope="col">email id</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($all_users as $sub_arr){?>
                    <tr>
                        <td><?php echo '<a href="user_detail.php?id='.$sub_arr["userID"].'">'.htmlentities($sub_arr["firstName"]).'</a>'?></td>
                        <td><?php echo htmlentities($sub_arr["lastName"])?></td>
                        <td><?php echo htmlentities($sub_arr["emailId"]) ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>


<?php require "../templates/foot.php"; ?>
