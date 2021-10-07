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
        if (! $result) {
           return $this->notFoundResponse();
       }
       $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $row= $result->fetch(PDO::FETCH_ASSOC);
        if (! $row) {
           return $this->notFoundResponse();
       }
        $in=[
            "Group_Name"=>$row["Group_Name"],
           "Interns_Surname"=>$row["Interns_Surname"],
           "Interns_Name"=>$row["Interns_Name"],
           "Comment"=>$row["Comment"]
       ];
       $response['status_code_header'] = 'HTTP/1.1 201 Created';
       echo $response['body'] = json_encode($in);
       return $response;
   }
}