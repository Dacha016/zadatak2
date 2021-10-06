<?php
namespace App\Controllers;
use App\Controllers\Controller;
use App\Models\Comment;
use PDO;
class CommentController extends Controller{
    public $db;
    protected $requestMethod;
    protected  $modelId;
    public function __construct($db,$requestMethod,$modelId){
       parent::__construct(new Comment($db));
       $this->requestMethod = $requestMethod;
       $this->modelId = $modelId;
    } 
    
    protected function validate($input){
        $data=$this->conn->query("SELECT m.idG,i.idG FROM ".$this->table. "  c LEFT JOIN mentors m ON c.idM=m.id LEFT JOIN interns i ON c.idI=i.id" );
        $row= $result->fetch(PDO::FETCH_ASSOC);
        var_dump($data);
        if( ! isset($input['idM']) || $input['idM']==="" || $input['idM']=== null  ){
            return false;
        }
        if( ! isset($input['idI']) || $input['idI']==="" || $input['idI']=== null  ){
            return false;
        }
        if($row["m.idG"]===$row["i.idG"]){
            return false;
        }
        return true;
    }
}
?>