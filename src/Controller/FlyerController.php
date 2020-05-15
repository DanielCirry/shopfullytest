<?php 
namespace Src\Controller;

use Src\Services\CsvReader;

class FlyerController {

  private $requestMethod;

  private $csvReader;

  public function __construct($requestMethod)
  {
    $this->requestMethod = $requestMethod;

    $this->csvReader = new CsvReader();
  }

  public function processRequest()
  {
    switch($this->requestMethod) {
      case 'GET' :
        $response = $this->getAllFlyers();
      break;
      default:
      $response = $this->notFoundResponse();
    break;
    }
    header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
  }

  private function getAllFlyers()
 {
    $result = $this->csvReader->exportCsvv();
    $response['status_code_header'] = 'HTTP/1.1 200 OK';
    $response['body'] = $result;

    return $response;
 }
}

?>