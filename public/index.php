<?php 
require "../bootstrap.php";
use Src\Controller\FlyerController;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//make this is global to change url at later date. uncomment for local test
$uri = parse_url($_SERVER['REQUEST_URI']);
echo "<script>console.log('" .  $uri . "');</script>";
echo $uri;
$uri = explode( '/', $uri );

///this works on local but doesn't work on cloud, $uri = "/". it doesn't take on any extra path, very weird
if($uri[0] !== 'api' && $uri[1] !== 'flyers' ){
  header("HTTP/1.1 404 Not Found");
  exit();
}

$requestMethod = $_SERVER["REQUEST_METHOD"];

$controller = new FlyerController($requestMethod);
$controller->processRequest();
?>