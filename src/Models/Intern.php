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
        $data=$this->conn->query("SELECT m.idG,i.idG FROM ".$this->table. "  c LEFT JOIN mentors m ON c.idM=m.id LEFT JOIN interns i ON c.idI=i.id" );
        var_dump($data);
        $q="SELECT  i.Surname AS Interns_Surname,i.Name AS Interns_Name,c.Comment AS Comment, g.Title AS Groups  FROM ". $this->table."  i LEFT JOIN groups g ON i.idG= g.id LEFT JOIN comments c ON c.id=i.idG  WHERE i.id=:id";
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