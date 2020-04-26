<?php 
    require "util/db.php";
    require "util/util.php";
    session_start();
    if(!isset($_SESSION["isverified"]))
    {
        // NOT logged in
        header("Location: login.php");
        return;
    }
    print($_SESSION["userid"]);
    // if($_SESSION["isverified"] == true)
    // {
    //     header("Location: index.php");
    //     return;
    // }
    $db = new DB;
    $db_obj = $db->create_db(3306,"fundraising","root","");
    $err="";
    if(isset($_POST["email"]) && isset($_POST["code"]))
    {
        // print_r($_POST["email"]);
        //GET USERID USING EMAIL
        $stml = $db_obj->prepare("SELECT userID from users WHERE emailId = :email");
        $stml->bindParam(':email',$_POST["email"],PDO::PARAM_STR);
        $stml->execute();
        $userid = $stml->fetchAll(PDO::FETCH_ASSOC);
        if(isset($userid[0])){
            //If email entered was able to find a user
            $userid = $userid[0]["userID"];
            //GET e_code using $userid from above
            $stml = $db_obj->prepare("SELECT e_code from emailverify WHERE userid = :id");
            $stml->execute(array(':id' => $userid));
            $ecode = $stml->fetchAll(PDO::FETCH_ASSOC);
            $ecode = $ecode[0]["e_code"];
            
            $user_code =str_split($_POST["code"],10)[0];

            //Check if enterd code matches ecode
            if(!strcmp($ecode, $user_code))
            {
                // SUCCESSFUL
                // UPDATE emailverify SET e_code = "1001" WHERE userid = 23;
                $stml = $db_obj->prepare("UPDATE emailverify SET isverified = 1 WHERE userid = :id;");
                if($stml->execute(array(':id' => $userid))){
                    //DONE
                    $_SESSION["isverified"] = true;
                }else{
                    $err = "Please try again.";
                }
                
            }else{
                $err = "Please enter a valid code";
            }
        }
        else{
            $err = "Enter valid email and code";
        }
    }else{
        $err = "Please enter email and code";
    }

?>

<?php 
  require "templates/top.php";
  if($_SESSION["isverified"] == true)
  {
      echo('<h1 class="mt-4 ml-4">Thank you for confirming</h1>');
      echo('<button class="btn btn-danger ml-4"><a href="dashboard.php" style="text-decoration: none;">Go to dashboard</a></button>');
  }else{
     echo('<div class="container" style="width: 30%;margin-top: 5em;"><form method="post">
     <div class="form-group">
       <label for="exampleInputEmail1">Email address</label>
       <input type="email" class="form-control" name="email" placeholder="Enter email">
     </div>
     <div class="form-group">
       <label for="exampleInputPassword1">Code</label>
       <input type="text" class="form-control" name="code" placeholder="Enter code">
     </div>
     <button type="submit" class="btn btn-danger">Submit</button>
   </form>
   <div class="mt-2"><p style="color:red;font-size="15px>'.$err.'</p></div>
   </div>');
  }
    require "templates/foot.php";  
?>



