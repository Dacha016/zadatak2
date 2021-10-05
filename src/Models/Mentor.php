<?php
namespace App\Models;
use App\Models\Model;

class Mentor extends Model{
    protected $conn;
    protected $table="Mentors";
    
// //konstruktor
    public function __construct($db){
        $this->conn=$db;
    }
}

?>