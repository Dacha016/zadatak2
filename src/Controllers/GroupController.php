<?php
namespace App\Controllers;
use PDO;
use App\Controllers\Controller;
use App\Models\Group;
class GroupController extends Controller{
    public $db;
    protected $requestMethod;
    protected  $modelId;
 
    public function __construct($db,$requestMethod,$modelId){
       parent::__construct(new Group($db));
       $this->requestMethod = $requestMethod;
       $this->modelId = $modelId;
    } 
    
    public function listing(){
        $result = $this->model->groupListing();
        $n=$result->rowCount();
        if($n>0){
            $inArr=[];
            while($row= $result->fetch(\PDO::FETCH_ASSOC)){
                extract($row);
                $in=[
                    "Groups_Name"=>$row["Groups_Name"],
                    "Mentors_Name"=>$row["Mentors_Name"],
                    "Mentors_Surname"=>$row["Mentors_Surname"],
                    "Interns_Name"=>$row["Interns_Name"],
                    "Interns_Surname"=>$row["Interns_Surname"]
                ];
                array_push($inArr,$in);
            }
        $response['body'] = json_encode($inArr);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        return $response;
        }
    }
    public function index(){
        $result = $this->model->readAll();
        $n=$result->rowCount();
        if($n>0){
            $inArr=[];
            while($row= $result->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $in=[
                    "id"=>$row["id"],
                    "Title"=>$row["Title"]
                ];
                array_push($inArr,$in);
            }
        $response['body'] = json_encode($inArr);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        return $response;
        }
    }
    public function show($modelId){
        $result = $this->model->read($modelId);
        $n=$result->rowCount();
        if($n>0){
            $inArr=[];
            while($row= $result->fetch(\PDO::FETCH_ASSOC)){
                extract($row);
                $in=[
                    "Groups_Name"=>$row["Groups_Name"],
                    "Mentors_Name"=>$row["Mentors_Name"],
                    "Mentors_Surname"=>$row["Mentors_Surname"],
                    "Interns_Name"=>$row["Interns_Name"],
                    "Interns_Surname"=>$row["Interns_Surname"]
                ];
                array_push($inArr,$in);
            }
        $response['body'] = json_encode($inArr);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        return $response;
        }
    }
  
    protected function validate($input){
        if( ! isset($input['Title']) || $input['Title']==="" || $input['Title']=== null ){
            return false;
        }
        return true;
    }
}