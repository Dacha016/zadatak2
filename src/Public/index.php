<?php
header("Access-Control-Allow-Methods:GET,POST,PUT,DELETE");
require realpath("../../vendor/autoload.php");
use App\Controllers\InternController;
use App\Controllers\MentorController;
use App\Controllers\GroupController;
use App\Router\Router;
$dotenv = Dotenv\Dotenv::createImmutable(trim(__DIR__,"\src\Public"));
$dotenv->load();


$url= new Router;
$url->processRequest();
?>