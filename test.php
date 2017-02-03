<?php
  header("Content-type: application/json");
  $arr = array ('a'=>1,'b'=>'中文','c'=>3,'d'=>4,'e'=>5);
  echo json_encode($arr, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);



?>