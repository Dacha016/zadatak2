<?php
namespace App\Controllers;
use App\Controllers\Controller;
use App\Models\Intern;
use PDO;
class InternController extends Controller{
    public $db;
    protected $requestMethod;
    protected  $personId;
    public function __construct($db,$requestMethod,$personId){
       parent::__construct(new Intern($db));
       $this->requestMethod = $requestMethod;
       $this->personId = $personId;
    }    
    public function show($personId){
        $result = $this->person->read($personId);
        if (! $result) {
           return $this->notFoundResponse();
       }
       $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $row= $result->fetch(PDO::FETCH_ASSOC);
        if (! $row) {
           return $this->notFoundResponse();
       }
        $in=[
           "Interns_Surname"=>$row["Interns_Surname"],
           "Interns_Name"=>$row["Interns_Name"],
           "Groups_Title"=>$row["Groups_Title"]
       ];
       echo json_encode($in);
       $response['status_code_header'] = 'HTTP/1.1 201 Created';
       $response['body'] = json_encode($in);
       return $response;
   }
}