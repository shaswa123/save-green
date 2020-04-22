<?php 
    require "util/db.php";
    require "util/util.php";
    $db = new DB;
    $db_obj = $db->create_db(3306,"fundraising","root","");
    if(isset($_POST["email"]) && isset($_POST["code"]))
    {
        // check with DB
        $res = $db->get_from_verify($_POST["email"]);

        if(isset($res["userid"]))
        {
            // Found one
            if(strcmp($_POST["code"], $res["code"] == 0))
            {
                // Matches so we update isVerified to 1
                $db->set_verify($red["userid"]);

            }else{
                // PRINT ERROR
            }
        }
        
    }
?>

<?php 
  require "templates/top.php";
  require "templates/navbar.php";
?>
    <form method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Confirmation code</label>
            <input type="code" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>