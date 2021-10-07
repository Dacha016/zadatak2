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
      
        $result = $this->model->readId();
        $row= $result->fetch(PDO::FETCH_ASSOC);
       $in=[
           "m.idG"=>$row["m.idG"],
           "i.idG"=>$row["i.idG"]
       ];
       
       var_dump($in[1]);
        if($row["m.idG"]!==$row["i.idG"]){
            return false;
        }
        if( ! isset($input['idM']) || $input['idM']==="" || $input['idM']=== null  ){
            return false;
        }
        if( ! isset($input['idI']) || $input['idI']==="" || $input['idI']=== null  ){
            return false;
        }

        return true;
    }
}
?>