<?php
namespace App\Models;
use App\Models\Model;
use PDO;
use PDOException;
class Group extends Model{
    protected $conn;
    protected $table="groups";

    public function __construct($db){
        $this->conn=$db;
    }
    public function readAll(){
        $q="SELECT * FROM ".$this->table . " ORDER BY Title";
        try{
            $stmt=$this->conn->prepare($q);
            $stmt->execute();
            return $stmt;
        }catch(PDOException $e){
            exit($e->getMessage());
        }
    }

    public function read($id){
        $q="SELECT g.Title AS Groups_Name, m.Name AS Mentors_Name, m.Surname AS Mentors_Surname,i.Name AS Interns_Name,i.Surname AS Interns_Surname FROM ". $this->table."  g LEFT JOIN mentors m ON g.id=m.idG LEFT JOIN interns i ON g.id=i.idG WHERE g.id=:id";   
        try{
            $stmt=$this->conn->prepare($q);
            $stmt->bindParam(":id",$id);
            $stmt->execute();
            return $stmt;
        }catch(PDOException $e){
            exit($e->getMessage());
        }
    }

    public  function create(Array $p){
        $q="INSERT INTO ".$this->table. " (Title) VALUES (:title )";
        try{
            $stmt=$this->conn->prepare($q);
            $stmt->bindParam(":title",$p["Title"]);
            $stmt->execute();
            return $stmt;
        }catch(PDOException $e){
            exit($e->getMessage());
        }
    }
    public function update($id, Array $p){
        $q="UPDATE ".$this->table." SET Title= :title WHERE id= :id";
        try{
            $stmt=$this->conn->prepare($q);
            $stmt->bindParam(":title",$p["Title"]);
            $stmt->bindParam(":id",$id);
            $stmt->execute();
            return $stmt;
        }catch(PDOException $e){
            exit($e->getMessage());
        }
    }
    public function groupListing(){
        $limit =30;
        $sort = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';
        $page = (isset($_GET['page']) && $_GET['page'] > 0) ? intval($_GET['page']) : 1;
        $offset = abs($page - 1)  * $limit;
        $q="SELECT g.Title AS Groups_Name, m.Name AS Mentors_Name, m.Surname AS Mentors_Surname,i.Name AS Interns_Name,i.Surname AS Interns_Surname FROM ". $this->table."  g LEFT JOIN mentors m ON g.id=m.idG LEFT JOIN interns i ON g.id=i.idG ORDER BY g.Title ".$sort." LIMIT :limit OFFSET :offset";
        try{
            $stmt=$this->conn->prepare($q);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt;
        }catch(PDOException $e){
            exit($e->getMessage());
        }
    }
}
?>