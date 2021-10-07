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
    public function readId($input){
        $q="SELECT i.id AS INTERN_ID,m.id AS MENTOR_ID, i.idG AS IDG_INTERN, m.idG AS IDG_MENTOR  FROM interns i INNER JOIN mentors m ON m.idG=i.idG WHERE i.id=:idI AND m.id=:idM ;";
        try{
            $stmt=$this->conn->prepare($q);
            $stmt->bindParam(":idM",$input["idM"]);
            $stmt->bindParam(":idI",$input["idI"]);
            $stmt->execute();
            return $stmt;
        }catch(PDOException $e){
            exit($e->getMessage());
        }
    }
}