<?php
namespace App\Controllers;
use PDO;
use App\Controllers\Controller;
use App\Models\Group;
class GroupController extends Controller{
    public $db;
    protected $requestMethod;
    protected  $personId;
 
    public function __construct($db,$requestMethod,$personId){
       parent::__construct(new Group($db));
       $this->requestMethod = $requestMethod;
       $this->personId = $personId;
     
    } 
    
    public function listing(){
        $result = $this->person->groupListing();
       
        $n=$result->rowCount();
        
        if($n>0){
            $inArr=[];
            while($row= $result->fetch(\PDO::FETCH_ASSOC)){
                extract($row);
                $in=[
                    "Groups_Title"=>$row["Groups_Title"],
                    "Mentors_Name"=>$row["Mentors_Name"],
                    "Mentors_Surname"=>$row["Mentors_Surname"],
                    "Interns_Name"=>$row["Interns_Name"],
                    "Interns_Surname"=>$row["Interns_Surname"]
                    
                ];
                array_push($inArr,$in);
            }
        echo json_encode($inArr);
        $response['body'] = json_encode($in);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        return $response;
         }
    }
    public function index(){

        $result = $this->person->readAll();
        
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
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
        echo json_encode($inArr);
        $response['body'] = json_encode($in);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        return $response;
         }
    }
    public function show($personId){
        $result = $this->person->read($personId);
        if (! $result) {
           return $this->notFoundResponse();
       }
        $row= $result->fetch(PDO::FETCH_ASSOC);
        $in=[
            "id"=>$row["id"],
            "Title"=>$row["Title"]
       ];
       echo json_encode($in);
       $response['body'] = json_encode($in);
       $response['status_code_header'] = 'HTTP/1.1 200 OK';
       return $response;
   }
   private function notFoundResponse(){
    $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
    $response['body'] = null;
    return $response;
    }
}