<?php
namespace App\Models;
use PDOException;
use App\Models\Model; 
class Intern extends Model {
    protected $conn;
    protected $table="interns";
 
//constructor
    public function __construct($db){
        $this->conn=$db;
    }
    public function read($id){
        // $sort="asc";
        $q="SELECT i.Surname AS Interns_Surname,i.Name AS Interns_Name,c.Comment AS Comment FROM groups g LEFT JOIN interns i ON g.id= i.idG LEFT JOIN comments c ON c.idI=i.id WHERE i.id=:id ORDER BY Comment ";
        try{
            $stmt=$this->conn->prepare($q);
            $stmt->bindParam(":id",$id);
            // $stmt->bindParam(":sort_by",$sort);
            $stmt->execute();
            return $stmt;
        }catch(PDOException $e){
            exit($e->getMessage());
        }
    }
}
?>