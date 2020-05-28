<?php 
    class DB{
        private $pdo;
        public function create_db($port_number, $dbname, $username, $password){
            $this->pdo = new PDO('mysql:host=localhost;port='.$port_number.';dbname='.$dbname,$username,$password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->pdo;
        }
        public function get_all_users(){
            $stmt = $this->pdo->prepare("SELECT * FROM users");
            $stmt->execute(); 
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }

        public function insert_user($firstName, $lastName, $emailId, $pass)
        {
            $sql = "INSERT INTO users (firstName,lastName,emailId,pass) VALUES (:firstname, :lastname, :email, :pass)";
            $stml = $this->pdo->prepare($sql);
            $result = $stml->execute(array(
                ':firstname' => $firstName,
                ':lastname' => $lastName,
                ':email'=> $emailId,
                ':pass' => $pass
            ));
            return $result;
        }

        public function delet_user($id,$emailId){
            $sql = "DELETE FROM users WHERE userID = :id AND emailId = :email";
            $stml = $this->pdo->prepare($sql);
            return $stml->execute(array(
                ':id' => $id,
                ':email' => $emailId
            ));
        }
        public function update_user_details($id, $firstName, $lastName, $emailId){
            $sql = 'UPDATE users SET firstName = :firstName, lastName = :lastName, emailId = :emailId WHERE userID = :id';
            // echo($sql);
            $stml = $this->pdo->prepare($sql);
            $stml->bindParam(":firstName",$firstName,PDO::PARAM_STR);
            $stml->bindParam(":lastName",$lastName,PDO::PARAM_STR);
            $stml->bindParam(":emailId",$emailId,PDO::PARAM_STR);
            $stml->bindParam(":id",$id,PDO::PARAM_INT);
            $stml->execute();
            return $stml;
            // $stml2 = $this->pdo->prepare("UPDATE phonenumbers SET phonenum = :num WHERE userid = :id");
            // $stml_2 = $stml2->execute(array(
            //     ":num"=>$num, 
            //     ":id"=>$id
            // ));
            // return $stml_1;
            // echo("Ok");
        }
        public function get_phone_numbers($id){
            $stml = $this->pdo->prepare("SELECT * from phonenumbers WHERE userid = :id");
            $stml->execute(array(':id' => $id));
            $phone_nums = $stml->fetchAll(PDO::FETCH_ASSOC);
            return $phone_nums;
        }
        public function get_one_user($emailId, $pass){
            $stml = $this->pdo->prepare("SELECT * FROM users WHERE emailId = :email AND pass = :pass");
            $stml->bindParam(':email',$emailId,PDO::PARAM_STR);
            $stml->bindParam(':pass',$pass,PDO::PARAM_STR);
            $stml->execute();
            $data = $stml->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }

        public function get_one_admin_user($id){
            $stml = $this->pdo->prepare("SELECT * FROM admins WHERE id = :id");
            $stml->bindParam(':id',$id,PDO::PARAM_INT);
            $stml->execute();
            $result = $stml->fetchAll(PDO::FETCH_ASSOC); 
            return $result;
        }

        public function get_user_by_id($id){
            $stml = $this->pdo->prepare("SELECT * FROM users WHERE userID = :id");
            $stml->bindParam(':id',$id,PDO::PARAM_INT);
            $stml->execute();
            $data = $stml->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }

        public function insert_into_verify($user, $code){
            $sql = "INSERT INTO emailverify (userid, e_code, isVerified) VALUES (:id, :code, :val)";
            $stml = $this->pdo->prepare($sql);
            $result = $stml->execute(array(
                ':id' => $user["userID"],
                ':code'=> $code,
                ':val' => 0
            ));
            return $result;
        }

        public function get_from_verify($user_id){
            $sql = "SELECT * FROM emailverify WHERE userid = :id;";
            // print($sql);
            $stml = $this->pdo->prepare($sql);
            $stml->execute(array(
                ':id' => $user_id
            ));
            $result = $stml->fetchAll();
            return $result[0];
        }

        public function set_verify($userid){
            $sql = "UPDATE emailverify SET isverified = 1 WHERE userid = :userid";
            $stml = $this->pdo->prepare($sql);
            $result = $stml->execute(array(
                ':firstname' => $userid
            ));
            return $result;
        }
        public function insert_into_campaigns($camp_details){
            $stml = $this->pdo->prepare("INSERT INTO campaigns (title,location,startdate,enddate,amount,image,description,currentamount,userID) VALUES (:title,:loc,:startdate,:enddate,:amount,:img,:description,:curramt,:userid)");
            $res = $stml->execute(array(
                ':title' => $camp_details["title"],
                ':loc' => $camp_details["loc"],
                ':startdate' => $camp_details["sdate"],
                ':enddate' => $camp_details["edate"],
                'amount' => $camp_details["amt"],
                ':img' => $camp_details["img"],
                ':description'=>$camp_details["desc"],
                ':curramt'=>$camp_details["curramt"],
                ':userid'=>$camp_details["userid"]
            ));
            return $res;
        }
        public function get_campaigns_by_user($userid){
            $stml = $this->pdo->prepare("SELECT * FROM campaigns where userID = :id ORDER BY startdate DESC");
            $stml->execute(array(':id' => $userid));
            $result = $stml->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        public function get_all_campaigns(){
            $stml = $this->pdo->prepare("SELECT * FROM campaigns ORDER BY startdate DESC");
            $stml->execute();
            $result = $stml->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        public function get_campaigns_by_id($id){
            $stml = $this->pdo->prepare("SELECT * FROM campaigns where id = :id");
            $stml->execute(array(':id' => $id));
            $res = $stml->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }
        public function update_campaign_amount($id, $amt){
            $stml = $this->pdo->prepare("UPDATE campaigns SET currentamount = :amt WHERE id = :id");
            return $stml->execute(array(':amt' => $amt, ':id' => $id));
        }
        public function get_popular_campaign($id){
            $result;
            if($id == -1){
                // GET from all the campaigns in the DB
                $stml = $this->pdo->prepare("SELECT * FROM campaigns ORDER BY currentamount DESC LIMIT 0,1");
                $stml->execute();
                $result = $stml->fetchAll(PDO::FETCH_ASSOC);
            }else{
                //GET for a particular volunteer
                $stml = $this->pdo->prepare("SELECT * FROM campaigns WHERE userID = :id ORDER BY currentamount DESC LIMIT 0,1");
                $stml->execute(array(':id'=> $id));
                $result = $stml->fetchAll(PDO::FETCH_ASSOC);
            }
            return $result;
        }
        public function insert_in_donor($info){
            $stml = $this->pdo->prepare("INSERT INTO donors (name, email, phonenumber, pancardnumber, address) VALUES(:n, :email, :phone, :pan,:ad)");
            return $stml->execute(array(':n'=>$info["name"], ':email'=>$info["email"], ':phone'=>$info["phoneNumber"], ':pan' => $info["pancardNum"],':ad'=>$info["address"] ));
        }
        public function get_all_donors(){
            $stml = $this->pdo->prepare("SELECT name FROM donors");
            $stml->execute();
            return $stml->fetchAll(PDO::FETCH_ASSOC);
        }
        public function get_donor_by_id($id){
            $stml = $this->pdo->prepare("SELECT * FROM donors WHERE id = :ID");
            $stml->execute(array(':ID' => $id));
            return $stml->fetchAll(PDO::FETCH_ASSOC);
        }
        public function get_donor_by_email($email){
            $stml = $this->pdo->prepare("SELECT * FROM donors WHERE email = :email");
            $stml->bindParam(":email",$email);
            $stml->execute();
            return $stml->fetchAll(PDO::FETCH_ASSOC);
        }
        public function get_orders_for_campaigns(){
            $stml = $this->pdo->prepare("SELECT COUNT(*) FROM donations");
            $stml->execute();
            return $stml->fetchAll(PDO::FETCH_ASSOC);
        }
        public function insert_in_donations($info){
            $stml = $this->pdo->prepare("INSERT INTO donations (txnid, amount, razor_order_id, orderid, campid, donorid) VALUES (:tnxid, :amt, :r_oid, :oid, :campid, :donorid)");
            return $stml->execute(array(':tnxid' => $info["razorpay_payment_id"], ':amt' => $info["amount"], ':r_oid' => $info["razorpay_order_id"], ':oid' => $info["shopping_order_id"] , ':campid' => $info["campid"], ':donorid' => $info["donorid"] ));
        }
        public function get_all_donations($campid){
            $stml = $this->pdo->prepare("SELECT donorid,txndate,amount FROM donations WHERE campid = :cid ORDER BY txndate DESC");
            $stml->bindParam(":cid",$campid);
            $stml->execute();
            return $stml->fetchAll(PDO::FETCH_ASSOC);
        }
    }

?>
