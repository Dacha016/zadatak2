<?php
namespace App\Config;

 use PDO;
 use PDOException;
class Connection {
    protected $conn;
   
    public function connect(){
        try{
            $this->conn = new PDO("mysql:host=".$_ENV["HOST"].";dbname=".$_ENV["DATABASE"], $_ENV["USERNAME"],$_ENV["PASSWORD"]);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            return false;
        }
        return $this->conn;  
    }    
}
?>