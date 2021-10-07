<?php
header("Access-Control-Allow-Methods:GET,POST,PUT,DELETE");
require realpath("../../vendor/autoload.php");
use App\Controllers\InternController;
use App\Controllers\MentorController;
use App\Controllers\GroupController;
use App\Router\Router;
//  require_once "../.env";

//  $host=getenv("PATH");
 
//  var_dump($host);
//  $host="index";
//  var_dump($host);
$url= new Router;
$url->processRequest();
?>