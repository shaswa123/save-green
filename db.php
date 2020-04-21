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
            return $stml->execute(array(
                ':firstname' => $firstName,
                ':lastname' => $lastName,
                ':email'=> $emailId,
                ':pass' => $pass
            ));
        }

        public function delet_user($pdo,$id,$emailId){
            $sql = "DELETE FROM users WHERE userID = :id AND emailId = :email";
            $stml = $this->pdo->prepare($sql);
            return $stml->execute(array(
                ':id' => $id,
                ':email' => $emailId
            ));
        }
    }

    // INSERT INTO DB --> INSERT INTO users(userID,firstName,lastName,emailId,pass) VALUES (1,"shaswat","patel","shaswat178@gmail.com","random01");
?>
