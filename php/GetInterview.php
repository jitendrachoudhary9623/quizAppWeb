<?php
   require_once 'Program.php';
  
   $userObject = new User();
  $json_array2 = $userObject->getInterview();
    
  header("Content-Type: application/json");
  echo json_encode($json_array2,JSON_PRETTY_PRINT);  
  
?>