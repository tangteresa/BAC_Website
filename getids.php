<?php 
require_once('submit.php'); 

$db = new Database();
$result = $db->idnames(); 

// Default option
$html = "<option value='' selected disabled hidden>Choose here</option>"; 
if ($result->num_rows > 0) {
  // SELECT data will always return an association array
  // Even if only one column selected
  // Simpy access that one column by name, as if the assoc array had
  // other columns 
  while($row = $result->fetch_assoc()) {
    $id = $row["catid"]; 
    $name = ucfirst($row["name"]); 
    $html = $html . "<option value=$id>$name - $id</option>"; 
  }
}

echo $html; 
?>