<?php
namespace App\Controllers;
use App\Controllers\Controller;
use App\Models\Intern;
use PDO;
class InternController extends Controller{
    public $db;
    protected $requestMethod;
    protected $modelId;
    public function __construct($db,$requestMethod,$modelId){
       parent::__construct(new Intern($db));
       $this->requestMethod = $requestMethod;
       $this->modelId =$modelId;
    }    
    public function show($modelId){
        $result = $this->model->read($modelId);
        $n=$result->rowCount();
        if($n>0){
            $inArr=[];
            while($row= $result->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $in=[
                    "Group_Name"=>$row["Group_Name"],
                    "Interns_Surname"=>$row["Interns_Surname"],
                    "Interns_Name"=>$row["Interns_Name"],
                    "Comment"=>$row["Comment"]
                ];
                array_push($inArr,$in);
            }
        $response['status_code_header'] = 'HTTP/1.1 201 Created';
        $response['body'] = json_encode($inArr);
        return $response;
         }
   }
}