<?php
namespace App\Models;
use App\Models\Model;
use PDOException;
class Mentor extends Model{
    protected $conn;
    protected $table="Mentors";
    
// //konstruktor
    public function __construct($db){
        $this->conn=$db;
    }
    public function read($id){
        $q="SELECT  m.Surname AS Mentors_Surname,m.Name AS Mentors_Name,g.Title AS Groups_Title  FROM ". $this->table."  m LEFT JOIN Groups g ON m.idG= g.id WHERE m.id=:id";
        
        try{
            $stmt=$this->conn->prepare($q);
            $stmt->bindParam(":id",$id);
            $stmt->execute();
            return $stmt;
        }catch(PDOException $e){
            exit($e->getMessage());
        }
    }
}

?>