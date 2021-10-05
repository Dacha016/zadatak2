<?php
namespace App\Models;
use PDOException;
abstract class Model {
// methods
    public function read($id){
    
        $q="SELECT * FROM ".$this->table ." WHERE id=:id";
        try{
            $stmt=$this->conn->prepare($q);
            $stmt->bindParam(":id",$id);
            $stmt->execute();
            return $stmt;
        }catch(PDOException $e){
            exit($e->getMessage());
        }
    }
    public function readAll(){

        $q="SELECT * FROM ".$this->table . " ORDER BY Surname";

        try{
            $stmt=$this->conn->prepare($q);
        
            $stmt->execute();
           
            return $stmt;
        }catch(PDOException $e){
            exit($e->getMessage());
        }
    }
    public  function create(array $p){
        $q="INSERT INTO ".$this->table. " (Name,Surname,idG) VALUES (:name, :surname,:idG)";
        try{
            $stmt=$this->conn->prepare($q);
            $stmt->bindParam(":name",$p["Name"]);
            $stmt->bindParam(":surname",$p["Surname"]);
            $stmt->bindParam(":idG",$p["idG"]);
            $stmt->execute();
            return $stmt;
        }catch(PDOException $e){
            exit($e->getMessage());
        }
    }
    public function update($id, array $p){
        $q="UPDATE ".$this->table." SET Name=:Name,Surname=:Surname,idG=:idG WHERE id=:id";
        try{
            $stmt=$this->conn->prepare($q);
            $stmt->bindParam(":Name",$p["Name"]);
            $stmt->bindParam(":Surname",$p["Surname"]);
            $stmt->bindParam(":idG",$p["idG"]);
            $stmt->bindParam(":id",$id);
            $stmt->execute();
            return $stmt;
        }catch(PDOException $e){
            exit($e->getMessage());
        }
    }
    public function delete($id){
        $q="DELETE FROM ".$this->table." WHERE id=:id";
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