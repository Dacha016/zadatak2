<?php
namespace App\Controllers;
use App\Controllers\Controller;
use App\Models\Intern;
class InternController extends Controller{
    public $db;
    protected $requestMethod;
    protected  $personId;
    public function __construct($db,$requestMethod,$personId){
       parent::__construct(new Intern($db));
       $this->requestMethod = $requestMethod;
       $this->personId = $personId;
    }    
}