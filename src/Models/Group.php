<?php
namespace App\Models;
use App\Models\Model;
use PDO;
use PDOException;
class Group extends Model{
    protected $conn;
    protected $table="Groups";

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

    public  function create(Array $p){
        $q="INSERT INTO ".$this->table. " (Title) VALUES (:title )";
        try{
            $stmt=$this->conn->prepare($q);
            print_r($stmt);
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
        $total = $this->conn->query("SELECT COUNT(*) FROM ".$this->table)->fetchColumn();
        $limit = 2;
        $pages = ceil($total / $limit);
        $page =(int)  min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array('default'   => 1)));
        var_dump($page);
        $offset = abs($page - 1)  * $limit;
        var_dump($offset);
        $q="SELECT g.Title AS Groups_Title, m.Name AS Mentors_Name, m.Surname AS Mentors_Surname,i.Name AS Interns_Name,i.Surname AS Interns_Surname FROM ". $this->table."  g LEFT JOIN Mentors m ON g.id=m.idG LEFT JOIN Interns i ON g.id=i.idG ORDER BY g.Title LIMIT :limit OFFSET :offset  ";
        var_dump($q);
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