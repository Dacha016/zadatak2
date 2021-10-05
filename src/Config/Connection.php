<?php
namespace App\Config;
 use PDO;
class Connection {
    protected $host ="localhost";
    protected $user="root";
    protected $pass="";
    protected $dbName="practice";
    protected $conn;

    public function connect(){
        try{
            $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->dbName, $this->user,$this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }catch(\PDOException $e){
            return false;
        }
        return $this->conn;  
    }    
}
?>