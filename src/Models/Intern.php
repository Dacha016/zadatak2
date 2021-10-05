<?php
namespace App\Models;

use App\Models\Model; 
class Intern extends Model {
    protected $conn;
    protected $table="Interns";//mala slova
 
//construct
    public function __construct($db){
        $this->conn=$db;
    }
}
?>