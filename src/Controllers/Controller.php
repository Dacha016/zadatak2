<?php
namespace App\Controllers;
use PDO;
class Controller{
    protected $model;
    public function __construct( $model=null){
        if($model !== null){
            $this->model=$model;
         }
    }
   
    public function index(){
        $result = $this->model->readAll();
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
        $response['status_code_header'] = 'HTTP/1.1 201 Created';
        echo $response['body'] = json_encode($inArr);
        return $response;
         }
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
            "Mentors_Surname"=>$row["Mentors_Surname"],
            "Mentors_Name"=>$row["Mentors_Name"],
            "Groups_Title"=>$row["Groups_Title"]
        ];
        $response['status_code_header'] = 'HTTP/1.1 201 Created';
        echo $response['body'] = json_encode($in);
        return $response;
    }

    public function store()
    {
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        if (! $this->validate( $input)) {
            return $this->unprocessableEntityResponse();
        }
        $this->model->create($input);
        $response['status_code_header'] = 'HTTP/1.1 201 Created';
        return $response;
    }

    public function update($modelId){
        $result = $this->model->read($modelId);
        if (! $result) {
            return $this->notFoundResponse();
        }
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        if ( !$this->validate($input)) {
            return $this->unprocessableEntityResponse();
        }
        $this->model->update($modelId, $input);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = null;
        return $response;
    }

    public function delete($modelId){
        $result = $this->model->read($modelId);
        $row= $result->fetch(PDO::FETCH_ASSOC);
        if (! $row) {
            return $this->notFoundResponse();
        }else{
            $this->model->delete($modelId);
            $response['status_code_header'] = 'HTTP/1.1 200 OK';
        }
        return $response;
    }

    protected function validate($input){
        if (! isset($input['Name']) || $input['Name']==="" || $input['Name']=== null || !ctype_alpha($input['Name']) ) {
            return false;
        }
        if (! isset($input['Surname']) || $input['Surname'] ==="" ||$input['Surname'] === null || !ctype_alpha($input['Surname'] )){
            return false;
        }
        if (! isset($input['idG']) || $input['idG']==="" || $input['idG']===null || !is_int($input['idG'])) {
            return false;
        }
        return true;
    }

    protected function unprocessableEntityResponse(){
        http_response_code(422);
        $response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';
        $response['body'] = json_encode([
            'error' => 'Invalid input'
        ]);
        return $response;
    }

    protected function notFoundResponse(){
        http_response_code(404);
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }
}