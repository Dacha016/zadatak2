<?php
namespace App\Controllers;
use App\Controllers\Controller;
use App\Models\Mentor;
use PDO;
class MentorController extends Controller{
    public $db;
    protected $requestMethod;
    protected  $modelId;
    public function __construct($db,$requestMethod,$modelId){
       parent::__construct(new Mentor($db));
       $this->requestMethod = $requestMethod;
       $this->modelId = $modelId;
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
            "Groups_Name"=>$row["Groups_Name"],
           "Mentors_Surname"=>$row["Mentors_Surname"],
           "Mentors_Name"=>$row["Mentors_Name"],
           
       ];
       $response['status_code_header'] = 'HTTP/1.1 201 Created';
       echo $response['body'] = json_encode($in);
       return $response;
   }
}