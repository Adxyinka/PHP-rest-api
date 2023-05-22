<?php 

include_once '../config/Database.php';

class User {
    
    // connection
    private $conn;

    //Table
    private $table = 'rest.user';

    //columns
    public $username;
    public $password;

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
   

    public function login() {
        $sql = "SELECT * FROM " . $this->table . " 
        WHERE username = :username AND password = :password LIMIT 1";

        //prepare query
        $stmt = $this->conn->prepare($sql);

        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        
    }
}

// class User{
//     // Connection
//     private $conn;

//     // Table
//     private $table = 'rest.user';

//     //columns
//     public $user_id;
//     public $username;
//     public $password;
//     // Db connection
//     public function __construct($db){
//         $this->conn = $db;
//     }

//     //CREATE

//     public function CreateUser(){
//         $sqlQuery = "INSERT INTO
//                     ". $this->table ."
//                 SET
//                     user_id = :user_id, 
//                     username = :username, 
//                     password = :password";
    
//         $stmt = $this->conn->prepare($sqlQuery);

//         $this->username=htmlspecialchars(strip_tags($this->username));
//         $this->password=htmlspecialchars(strip_tags($this->password));

//         $this->user_id=htmlspecialchars(strip_tags($this->user_id));
    
//         // bind data
//         $stmt->bindParam(":name", $this->username);
//         $stmt->bindParam(":email", $this->password);
//         $stmt->bindParam(":id", $this->user_id);
    
//         if($stmt->execute()){
//            return true;
//         }

// }
// }