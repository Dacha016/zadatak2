<?php
namespace App\Router;
use App\Config\Connection;

class Router{
   public $route=[];
    function processRequest(){
        $db= new Connection;
        $db=$db->connect();
        $route=[
            "GET"=>[
                "/interns"=>"App\Controllers\InternController@index",
                "/interns/id"=>"App\Controllers\InternController@show",
                "/mentors"=>"App\Controllers\MentorController@index",
                "/mentors/id"=>"App\Controllers\MentorController@show",
                "/groups"=>"App\Controllers\GroupController@index",
                "/groups/id"=>"App\Controllers\GroupController@show",
                "/groups/listing"=>"App\Controllers\GroupController@listing"
                ],
            "POST"=>[
                "/interns/create"=>"App\Controllers\InternController@store",
                "/mentors/create"=>"App\Controllers\MentorController@store",
                "/interns/create"=>"App\Controllers\GroupController@store"
             ],
            "PUT"=>[
                "/interns/id"=>"App\Controllers\InternController@update",
                "/mentors/id"=>"App\Controllers\MentorController@update",
                "/groups/id"=>"App\Controllers\GroupController@update"
            ],
            "DELETE"=>[
                "/interns/id"=>"App\Controllers\InternController@destroy",
                "/mentors/id"=>"App\Controllers\MentorController@destroy",
                "/groups/id"=>"App\Controllers\GroupController@destroy"]
            ];
        $requestMethod =strtoupper ($_SERVER["REQUEST_METHOD"]);
        $uri = explode('/', $_SERVER['REQUEST_URI']);
        var_dump($_SERVER['REQUEST_URI']);
        $personId= isset($_GET["id"]) ? (int)$_GET["id"]:null;
        if($personId !== null){
            $uriq = explode("?",$uri[count($uri) - 1]);
            $uri='/' . $uri[count($uri) - 2].'/'.$uriq[count($uriq)-2];
            $route=$route[$requestMethod][$uri]; 
            $routeName= explode("@",$route);
            $className=$routeName[count($routeName)-2];
            $methodName=$routeName[count($routeName)-1];
            $object = new $className($db,$requestMethod,$personId);
            return $object->{$methodName}($personId);
        }if( $uri[count($uri) - 1]==="listing"){
            $uri='/' . $uri[count($uri) - 2].'/'.$uri[count($uri)-1];
            $route=$route[$requestMethod][$uri]; 
            var_dump($uri);
            $routeName= explode("@",$route);
            $className=$routeName[count($routeName)-2];
            $methodName=$routeName[count($routeName)-1];
            $object = new $className($db,$requestMethod,$personId);
            return $object->{$methodName}($personId);
        }
        else{
            $uri = '/' . $uri[count($uri)-1];
            $route=$route[$requestMethod][$uri];
            $routeName= explode("@",$route);
            $className=$routeName[count($routeName)-2];
            $methodName=$routeName[count($routeName)-1];
            $object = new $className($db,$requestMethod,$personId);
            return $object->{$methodName}();
        }
      
            
    }
}
?>