<?php
namespace App\Controllers;
use App\Controllers\Controller;
use App\Models\Mentor;
use PDO;
class MentorController extends Controller{
    public $db;
    protected $requestMethod;
    protected  $personId;
    public function __construct($db,$requestMethod,$personId){
       parent::__construct(new Mentor($db));
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
           "Mentors_Surname"=>$row["Mentors_Surname"],
           "Mentors_Name"=>$row["Mentors_Name"],
           "Groups_Title"=>$row["Groups_Title"]
       ];
       echo json_encode($in);
       $response['status_code_header'] = 'HTTP/1.1 201 Created';
       $response['body'] = json_encode($in);
       return $response;
   }
}