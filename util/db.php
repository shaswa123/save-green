<?php 
    class DB{
        private $pdo;
        public function create_db($port_number, $dbname, $username, $password){
            $this->pdo = new PDO('mysql:host=localhost;port='.$port_number.';dbname='.$dbname,$username,$password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->pdo;
        }
        //--------------------------------------------------------------------//
        //                          USERS TABLE                               //
        //--------------------------------------------------------------------//
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
                ':firstname' =>htmlentities($firstName, ENT_QUOTES, 'UTF-8'),
                ':lastname' =>htmlentities($lastName, ENT_QUOTES, 'UTF-8'),
                ':email'=>htmlentities($emailId, ENT_QUOTES, 'UTF-8'),
                ':pass' =>htmlentities($pass, ENT_QUOTES, 'UTF-8')
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
            $stml = $this->pdo->prepare($sql);
            $stml->bindParam(":firstName",htmlentities($firstName, ENT_QUOTES, 'UTF-8'),PDO::PARAM_STR);
            $stml->bindParam(":lastName",htmlentities($lastName,ENT_QUOTES, 'UTF-8'),PDO::PARAM_STR);
            $stml->bindParam(":emailId",htmlentities($emailId,ENT_QUOTES, 'UTF-8'),PDO::PARAM_STR);
            $stml->bindParam(":id",htmlentities($id,ENT_QUOTES, 'UTF-8'),PDO::PARAM_INT);
            $stml->execute();
            return $stml;
        }
        public function update_user_pass($userid, $newPass){
            $sql = 'UPDATE users SET pass = :newpass WHERE userID = :id';
            $stml = $this->pdo->prepare($sql);
            $stml->bindParam(":newpass",htmlentities($newPass,ENT_QUOTES, 'UTF-8'),PDO::PARAM_STR);
            $stml->bindParam(":id",htmlentities($userid,ENT_QUOTES, 'UTF-8'),PDO::PARAM_INT);
            $stml->execute();
            return $stml; 
        }
        public function get_one_user($emailId, $pass){
            $stml = $this->pdo->prepare("SELECT * FROM users WHERE emailId = :email AND pass = :pass");
            $stml->bindParam(':email',htmlentities($emailId,ENT_QUOTES, 'UTF-8'),PDO::PARAM_STR);
            $stml->bindParam(':pass',htmlentities($pass,ENT_QUOTES, 'UTF-8'),PDO::PARAM_STR);
            $stml->execute();
            $data = $stml->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
        
        public function get_one_user_by_email($email){
            $stml = $this->pdo->prepare("SELECT * FROM users WHERE emailId = :email");
            $stml->execute(array(':email' =>htmlentities($email,ENT_QUOTES, 'UTF-8')));
            $data = $stml->fetchAll(PDO::FETCH_ASSOC);
            return $data; 
        }

        public function get_user_by_id($id){
            $stml = $this->pdo->prepare("SELECT * FROM users WHERE userID = :id");
            $stml->bindParam(':id',$id,PDO::PARAM_INT);
            $stml->execute();
            $data = $stml->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }

        //--------------------------------------------------------------//
        //                      PHONE NUMBER TABLE                      //
        //--------------------------------------------------------------//

        public function get_phone_numbers($id){
            $stml = $this->pdo->prepare("SELECT * from phonenumbers WHERE userid = :id");
            $stml->execute(array(':id' => $id));
            $phone_nums = $stml->fetchAll(PDO::FETCH_ASSOC);
            return $phone_nums;
        }
        public function update_phone_number($id, $newphonenum){
            $stml = $this->pdo->prepare("UPDATE phonenumbers SET phonenum = :newnum WHERE userid = :id");
            $stml->execute(array(
                ':id' => $id, 
                ':newnum' =>htmlentities($newphonenum,ENT_QUOTES, 'UTF-8')
            ));
            return $stml;
        }

        //------------------------------------------------------//
        //                      ADMIN TABLE                     //
        //------------------------------------------------------//

        public function get_one_admin_user($id){
            $stml = $this->pdo->prepare("SELECT * FROM admins WHERE id = :id");
            $stml->bindParam(':id',$id,PDO::PARAM_INT);
            $stml->execute();
            $result = $stml->fetchAll(PDO::FETCH_ASSOC); 
            return $result;
        }

        //------------------------------------------------------//
        //                          VERIFY TABLE                //
        //------------------------------------------------------//
        
        public function insert_into_verify($user, $code){
            $sql = "INSERT INTO emailverify (userid, e_code, isVerified) VALUES (:id, :code, :val)";
            $stml = $this->pdo->prepare($sql);
            $result = $stml->execute(array(
                ':id' => htmlentities($user["userID"],ENT_QUOTES, 'UTF-8'),
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
        public function unset_verify($userid, $newcode){
            $sql = "UPDATE emailverify SET isverified = 0, e_code = :newcode WHERE userid = :userid";
            $stml = $this->pdo->prepare($sql);
            $result = $stml->execute(array(
                ':userid' => $userid,
                ':newcode' => $newcode
            ));
            return $result; 
        }
        
        //-------------------------------------------------------------//
        //                     CAMPAIGN TABLE                          //
        //-------------------------------------------------------------//

        public function insert_into_campaigns($camp_details){
            $stml = $this->pdo->prepare("INSERT INTO campaigns (title,location,startdate,enddate,amount,description,userID, status) VALUES (:title,:loc,:startdate,:enddate,:amount,:description,:userid, 2)");
            $res = $stml->execute(array(
                ':title' =>htmlentities($camp_details["camp_title"],ENT_QUOTES, 'UTF-8'),
                ':loc' => htmlentities($camp_details["camp_location"],ENT_QUOTES, 'UTF-8'),
                ':startdate' =>htmlentities($camp_details["camp_start_date"],ENT_QUOTES, 'UTF-8'),
                ':enddate' =>htmlentities($camp_details["camp_end_date"],ENT_QUOTES, 'UTF-8'),
                'amount' =>htmlentities($camp_details["camp_total_amt"],ENT_QUOTES, 'UTF-8'),
                ':description'=>htmlentities($camp_details["camp_desc"],ENT_QUOTES, 'UTF-8'),
                ':userid'=>htmlentities($camp_details["userid"],ENT_QUOTES, 'UTF-8')
            ));
            return $this->pdo->lastInsertId();
        }
        public function get_campaigns_by_user($userid){
            $stml = $this->pdo->prepare("SELECT * FROM campaigns where userID = :id ORDER BY startdate DESC");
            $stml->execute(array(':id' => $userid));
            $result = $stml->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        public function get_all_campaigns(){
            $stml = $this->pdo->prepare("SELECT * FROM campaigns WHERE campaigns.status = 1 ORDER BY startdate DESC");
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
        public function get_all_unconfirmed_campagins(){
            $stml = $this->pdo->prepare("SELECT COUNT(*) FROM campaigns WHERE status = 2");
            $stml->execute();
            return $stml->fetchAll(PDO::FETCH_ASSOC);
        }
        public function update_campaign_amount($id, $amt){
            $stml = $this->pdo->prepare("UPDATE campaigns SET currentamount = :amt WHERE id = :id");
            return $stml->execute(array(':amt' =>htmlentities($amt,ENT_QUOTES, 'UTF-8'), ':id' => $id));
        }
        public function set_campaign_status($id){
            $stml = $this->pdo->prepare("UPDATE campaigns SET status = 1 WHERE id = :id");
            return $stml->excute(array(':id' => $id));
        }
        //--------------------------------------------------//
        //                  IMAGES TABLE                    //
        //--------------------------------------------------//

        public function insert_into_images($url,$campid){
            $stml = $this->pdo->prepare("INSERT INTO images (imgurl, campaginID) VALUES (:imgurl, :campid)");
            $stml->execute(array(
                ':imgurl' => $url,
                ':campid' => $campid
            ));
        }
        public function get_images($campid){
            $stml = $this->pdo->prepare("SELECT imgurl FROM images WHERE campaginID = :id");
            $stml->execute(array(':id' => $campid));
            return $stml->fetchAll(PDO::FETCH_ASSOC);
        }

        //--------------------------------------------------//
        //                   DONORs TABLE                   //
        //--------------------------------------------------//

        public function insert_in_donor($info){
            $stml = $this->pdo->prepare("INSERT INTO donors (name, email, phonenumber, pancardnumber, address) VALUES(:n, :email, :phone, :pan,:ad)");
            for($i = 0; $i < count($info); $i++){
                $info[$i] = htmlentities($info[$i],ENT_QUOTES, 'UTF-8');
            }
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
        
        //---------------------------------------------------//
        //                  DONATIONS TABLE                  //
        //---------------------------------------------------//

        public function get_orders_for_campaigns(){
            $stml = $this->pdo->prepare("SELECT COUNT(*) FROM donations");
            $stml->execute();
            return $stml->fetchAll(PDO::FETCH_ASSOC);
        }
        public function insert_in_donations($info){
            $stml = $this->pdo->prepare("INSERT INTO donations (txnid, amount, razor_order_id, orderid, campid, donorid) VALUES (:tnxid, :amt, :r_oid, :oid, :campid, :donorid)");
            return $stml->execute(array(':tnxid' => htmlentities($info["razorpay_payment_id"],ENT_QUOTES, 'UTF-8'), ':amt' => htmlentities($info["amount"],ENT_QUOTES, 'UTF-8'), ':r_oid' => htmlentities($info["razorpay_order_id"],ENT_QUOTES, 'UTF-8'), ':oid' => htmlentities($info["shopping_order_id"],ENT_QUOTES, 'UTF-8') , ':campid' => htmlentities($info["campid"],ENT_QUOTES, 'UTF-8'), ':donorid' =>htmlentities($info["donorid"],ENT_QUOTES, 'UTF-8')));
        }
        public function get_all_donations($campid){
            $stml = $this->pdo->prepare("SELECT * FROM donations WHERE campid = :cid ORDER BY txndate DESC");
            $stml->bindParam(":cid",$campid);
            $stml->execute();
            return $stml->fetchAll(PDO::FETCH_ASSOC);
        }
        public function get_number_of_donors($campid){
            $stml = $this->pdo->prepare("SELECT COUNT(*) FROM donations WHERE campid = :campid");
            $stml->execute(array(':campid' => $campid));
            return $stml->fetchAll(PDO::FETCH_ASSOC);
        }

        //-------------------------------------------------//
        //                     EMAIL TABLE                 //
        //-------------------------------------------------//
        public function insert_into_email($info, $id){
            $stml = $this->pdo->prepare("DELETE FROM emaildata WHERE id = :id");
            $stml->execute(array(':id' => $id));
            $stml = $this->pdo->prepare("INSERT INTO emaildata (id,address, pass, body, subject) VALUES (:id,:email,:pass, :body, :subject);");
            return $stml->execute(array(
                ':id' => htmlentities($id, ENT_QUOTES,'UTF-8'),
                ':email' => htmlentities($info["email"], ENT_QUOTES, 'UTF-8'),
                ':pass' => htmlentities($info["password"], ENT_QUOTES, 'UTF-8'),
                ':body' => htmlentities($info["body"], ENT_QUOTES, 'UTF-8'),
                ':subject' => htmlentities($info["subject"],ENT_QUOTES,'UTF-8')
            ));
        }
        public function get_from_email(){
            $stml = $this->pdo->prepare("SELECT * FROM emaildata");
            $stml->execute();
            return $stml->fetchAll(PDO::FETCH_ASSOC);
        }
        
        //-----------------------------------------------//
        //             NGO DETAILS TABLE                 //
        //-----------------------------------------------//
        public function insert_into_ngo($info){
            $stml = $this->pdo->prepare("DELETE FROM ngodetails");
            $stml->execute();
            $stml = $this->pdo->prepare("INSERT INTO ngodetails (orgnization_name, phonenum, pancard, email, A, G) VALUES (:org, :pho, :pan, :email, :A, :G);");
            return $stml->execute(array(
                ':org' => htmlentities($info["orgName"], ENT_QUOTES, 'UTf-8'),
                ':pho' => htmlentities($info["phoneNum"], ENT_QUOTES, 'UTf-8'),
                ':pan' => htmlentities($info["panCardNum"], ENT_QUOTES, 'UTf-8'),
                ':email' => htmlentities($info["email"], ENT_QUOTES, 'UTf-8'),
                ':A' => htmlentities($info["12-A"], ENT_QUOTES, 'UTf-8'),
                ':G' => htmlentities($info["80-G"], ENT_QUOTES, 'UTf-8')
            ));
        }
        public function get_from_ngo_details(){
            $stml = $this->pdo->prepare("SELECT * FROM ngodetails");
            $stml->execute();
            return $stml->fetchAll(PDO::FETCH_ASSOC);
        }

        //-----------------------------------------------//
        //              MISC TABLE                       //
        //-----------------------------------------------//
        public function insert_into_misc($info, $where){
            $stml = $this->pdo->prepare("UPDATE misc SET :w = :info;");
            return $stml->execute(array(
                ':w' => htmlentities($where, ENT_QUOTES, 'UTF-8'),
                ':info' => htmlentities($info, ENT_QUOTES, 'UTF-8')
            ));
        }
        public function get_from_misc(){
            $stml = $this->pdo->prepare("SELECT * FROM misc");
            $stml->execute();
            return $stml->fetchAll(PDO::FETCH_ASSOC);
        }

    }
?>