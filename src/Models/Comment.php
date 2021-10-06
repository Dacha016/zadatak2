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
        var_dump($q);
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
}