<?php 
    class DB{
        private $pdo;
        public function create_db($port_number, $dbname, $username, $password){
            $this->pdo = new PDO('mysql:host=localhost;port='.$port_number.';dbname='.$dbname,$username,$password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->pdo;
        }
        public function get_all_users(){
            $sql = "SELECT * FROM users";
            $stml = $this->pdo->query($sql);
            return $stml;
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

        public function get_one_user($emailId){
            $sql = "SELECT * FROM users WHERE emailId = :email;";
            // print($sql);
            $stml = $this->pdo->prepare($sql);
            $stml->execute(array(
                ':email' => $emailId
            ));
            $result = $stml->fetch();
            return $result;
        }

        public function insert_into_verify($user, $code){
            $sql = "INSERT INTO emailverify (userid, email, e_code, isVerified) VALUES (:id, :email, :code, :val)";
            $stml = $this->pdo->prepare($sql);
            $result = $stml->execute(array(
                ':id' => $user["userID"],
                ':email' => $user["emailId"],
                ':code'=> $code,
                ':pass' => 0
            ));
            return $result;
        }

        public function get_from_verify($emailid){
            $sql = "SELECT * FROM emailverify WHERE emailId = :email;";
            // print($sql);
            $stml = $this->pdo->prepare($sql);
            $stml->execute(array(
                ':email' => $emailid
            ));
            $result = $stml->fetch();
            return $result;
        }

        public function set_verify($userid){
            $sql = "UPDATE emailverify SET isverified = 1 WHERE userid = :userid";
            $stml = $this->pdo->prepare($sql);
            $result = $stml->execute(array(
                ':firstname' => $userid
            ));
            return $result;
        }
    }
?>
