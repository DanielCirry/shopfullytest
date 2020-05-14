<?php
namespace Src\Services;

class CsvReader{
   function exportCsvv()
   {
    $filePath = $_SERVER['DOCUMENT_ROOT']. "/../src/Services/flyers_data.csv";
    
    if (($handle = fopen($filePath, 'r')) === false) {
      die('Error opening file');
    }
      
    $headers = fgetcsv($handle, 1024, ',');
    $complete = array();
    while ($row = fgetcsv($handle, 1024, ',')) {
       $complete[] = array_combine($headers, $row);
     }
    fclose($handle);

    $totalItems = count($complete);    
    $paginatedJson = $this->pagination($complete, $totalItems);

    $json = json_encode($paginatedJson);
    return $json;
  }

  function pagination($data, $totalItems)
  {
    $page = !isset($_GET['page']) ? 1 : $_GET['page'];
    $limit = !isset($_GET['limit']) ? 100 : $_GET['limit'];
    $offset = ($page - 1) * $limit;
    $totalPages = ceil($totalItems / $limit);
    $final = array_splice($data, $offset, $limit);
    // $this->urlChanges('page', $page);
    // $this->urlChanges('limit', $limit);
    return $final;
  }
//change url at later date
  // function urlChanges( $key, $value)
  // {	
  //   echo $GLOBALS['uri'];
  //   $GLOBALS['uri'][3] = preg_replace('/(.*)(?|&)'. $key .'=[^&]+?(&)(.*)/i', '$1$2$4', $GLOBALS['uri'] .'&');
  //   $GLOBALS['uri'] = substr($GLOBALS['uri'], 0, -1);
  
  //   if (strpos($GLOBALS['uri'], '?') === false) {
  //   	return ($GLOBALS['uri'] .'?'. $key .'='. $value);
  //   } else {
  //   	return ($GLOBALS['uri'] .'&'. $key .'='. $value);
  //   }
  // }
}
?>