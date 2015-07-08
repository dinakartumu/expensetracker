<?php
include "connection.php";

//Fetching Values from URL
 //$tagName=$_GET['tagName']; 

      $result = mysql_query("SELECT * FROM tags");  
      $data = array();
      while ($row = mysql_fetch_array($result)) {
        array_push($data, $row['tag_name']);  
      } 
      echo json_encode($data);
?>
