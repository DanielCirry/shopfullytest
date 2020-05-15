<?php 
require "../bootstrap.php";
use Src\Controller\FlyerController;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//this is global so i can change the url at later date
$GLOBALS['uri'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$GLOBALS['uri'] = explode( '/', $GLOBALS['uri'] );
echo json_encode($GLOBALS['uri']);
echo "<script>console.log('" . json_encode($_SERVER['REQUEST_URI']) . "');</script>";

if($GLOBALS['uri'][4] !== 'api' && $GLOBALS['uri'][5] !== 'flyers' ){
  header("HTTP/1.1 404 Not Found");
  exit();
}

$requestMethod = $_SERVER["REQUEST_METHOD"];

$controller = new FlyerController($requestMethod);
$controller->processRequest();
?>