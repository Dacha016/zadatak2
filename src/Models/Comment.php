<?php
namespace App\Models;
use PDOException;
use App\Models\Model; 
class Comment extends Model {
    protected $conn;
    protected $table="comments";
 
//constructor
    public function __construct($db){
        $this->conn=$db;
    }

    public  function create(Array $p){
        $q="INSERT INTO ".$this->table. " (Comment,idM,idI) VALUES (:comment,:idM,:idI )";

        try{
            $stmt=$this->conn->prepare($q);
            $stmt->bindParam(":comment",$p["Comment"]);
            $stmt->bindParam(":idM",$p["idM"]);
            $stmt->bindParam(":idI",$p["idI"]);
            $stmt->execute();
            return $stmt;
        }catch(PDOException $e){
            exit($e->getMessage());
        }
    }
    public function readId(){

        $q="SELECT  i.idG,m.idG FROM ". $this->table."  c LEFT JOIN mentors m ON c.idM= m.id LEFT JOIN interns i ON c.idI=i.id";
        
        try{
            $stmt=$this->conn->prepare($q);
            $stmt->execute();
            return $stmt;
        }catch(PDOException $e){
            exit($e->getMessage());
        }
    }
}