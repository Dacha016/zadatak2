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
 
        $result = $this->model->readId($input);
        $row= $result->fetch(PDO::FETCH_ASSOC);
        if(!$row){
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