<?php 

include_once '../config/Database.php';

class User {
    
    // connection
    private $conn;

    //Table
    private $table = 'rest.user';
    private $itemTable = 'rest.items';

    //columns
    public $username;
    public $password;

    public $title;
    public $body;

    public static $table_fields = array('user_id', 'username','password');

    //DB connection
    public function __construct($db) {
        $this->conn = $db;

    }

    // Create User
    public function createUser() {
       global $database;
       
        $sql = "INSERT INTO
        ". $this->table ."
    SET
        username = :username, 
        password = :password";
        // user_id = :user_id
   
        
        // Prepare query
        $stmt = $this->conn->prepare($sql);

        
        // bind data
        $stmt->bindParam(":username", $this->username);
        
        $stmt->bindParam(":password", $this->password);

        // execute query
        if($stmt->execute()) {
           return true;
        }

    }


    public function getItems() {
        $sql = "SELECT * FROM " . $this->itemTable . "";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
   

    public function login() { 


            if (isset($_POST['username']['password'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];
        

        
        $sql = "SELECT * FROM " . $this->table . " 
        WHERE username = :username AND password = :password LIMIT 1";

        //prepare query
        $stmt = $this->conn->prepare($sql);

            // bind data
        $stmt->bindParam(":username", $this->username);
        
        $stmt->bindParam(":password", $this->password);
         
        $stmt->execute([$username], [$password]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $storedPass = $row['password'];
            $storedUser = $row['username'];
            
            if($password == $storedPass && $username == $storedUser) {
                return true;
            } 
        } else {
            echo "Invalid username and password";
        }
        
    } else {
        echo "Invalid username or password";
    }
}
}

