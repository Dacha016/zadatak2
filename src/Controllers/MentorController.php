<?php
namespace App\Controllers;
use App\Controllers\Controller;
use App\Models\Mentor;
class MentorController extends Controller{
    public $db;
    protected $requestMethod;
    protected  $personId;
    public function __construct($db,$requestMethod,$personId){
       parent::__construct(new Mentor($db));
       $this->requestMethod = $requestMethod;
       $this->personId = $personId;
    } 
}