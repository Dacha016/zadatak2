<?php
namespace App\Controllers;
use PDO;
class Controller{
    protected $person;
    public function __construct( $person=null){
       
        if($person !== null){
            $this->person=$person;
          
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
                    "Name"=>$row["Name"],
                    "Surname"=>$row["Surname"],
                    "idG"=>$row["idG"]
                ];
                array_push($inArr,$in);
            }
        echo json_encode($inArr);
        $response['status_code_header'] = 'HTTP/1.1 201 Created';
        $response['body'] = json_encode($in);
        return $response;
         }
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
            "id"=>$row["id"],
            "Name"=>$row["Name"],
            "Surname"=>$row["Surname"],
            "idG"=>$row["idG"]
        ];
        echo json_encode($in);
        $response['status_code_header'] = 'HTTP/1.1 201 Created';
        $response['body'] = json_encode($in);
        return $response;
    }

    public function store()
    {
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        if (! $this->validate( $input)) {
            return $this->unprocessableEntityResponse();
        }
        $this->person->create($input);
        
       
        $response['status_code_header'] = 'HTTP/1.1 201 Created';
        
        return $response;
    }

    public function update($personId){
        $result = $this->person->read($personId);
        if (! $result) {
            return $this->notFoundResponse();
        }
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        if ( !$this->validate($input)) {
            return $this->unprocessableEntityResponse();
        }
        $this->person->update($personId, $input);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = null;
        return $response;
    }

    public function delete($personId){
        $result = $this->person->read($personId);
        $row= $result->fetch(PDO::FETCH_ASSOC);
        if (! $row) {
            return $this->notFoundResponse();
            
        }else{
            $this->person->delete($personId);
            $response['status_code_header'] = 'HTTP/1.1 200 OK';
        }
        return $response;
    }

    private function validate($input){
        var_dump($input);
        if (! isset($input['Name']) || $input['Name']==="" || $input['Name']=== null) {
            return false;
        }
        if (! isset($input['Surname']) || $input['Surname'] ==="" ||$input['Surname'] === null ) {
            return false;
        }
        if (! isset($input['idG']) || $input['idG']==="" || $input['idG']===null || !is_int($input['idG'])) {
            return false;
        }
        return true;
    }

    private function unprocessableEntityResponse(){
        
         http_response_code(422);
        $response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';
        $response['body'] = json_encode([
            'error' => 'Invalid input'
        ]);
        return $response;
    }

    private function notFoundResponse(){
        http_response_code(404);
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }
}