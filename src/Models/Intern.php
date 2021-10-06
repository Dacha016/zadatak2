<?php
namespace App\Models;
use PDOException;
use App\Models\Model; 
class Intern extends Model {
    protected $conn;
    protected $table="Interns";//mala slova
 
//construct
    public function __construct($db){
        $this->conn=$db;
    }
    public function read($id){
        $q="SELECT  i.Surname AS Interns_Surname,i.Name AS Interns_Name,g.Title AS Groups_Title  FROM ". $this->table."  i LEFT JOIN Groups g ON i.idG= g.id WHERE i.id=:id";
        
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