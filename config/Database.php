<?php 
 include_once 'config.php';

// class Database {

//     protected $conn;

//     function __construct() {
//         $this->connection();
//     }

//     // Database connection

//     public function connection() {
//         try {

//             $this->conn = new PDO(DNS, USER, DB_PASS);
//             $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//             $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,
//             PDO::FETCH_OBJ);
//         } catch (PDOException $err) {

//             echo "Connection error " . $err->getMessage();
//         }
//     }
// }

class Database {
    private $host = "127.0.0.1";
    private $database_name = "rest";
    private $username = "root";
    private $password = "123456";
    public $conn;
    public function connection(){
        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Database could not be connected: " . $exception->getMessage();
        }
        return $this->conn;
    }
}  
?>