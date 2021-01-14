<?php 
 /* This script populates form dropdown select with cat ID options from database
 so that when cats are added/removed from database, the form doesn't have to be 
 manually updated */ 

require_once('db.php'); 

$db = new Database();
$result = $db->idnames(); 

// Default option, not chooseable by user 
$html = "<option id='default' value='' selected disabled hidden>Choose here</option>"; 
if ($result->num_rows > 0) {
  /* SELECT data will always return an association array, even if only one 
  column selected. Can access that one column by column name */ 
  while($row = $result->fetch_assoc()) {
    $id = $row["catid"]; 
    $name = ucfirst($row["name"]); 
    $html = $html . "<option id=$id value=$id>$name - $id</option>"; 
  }
}

echo $html; 
?>