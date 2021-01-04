// TODO add error messages underneath respective field on contact (make php)
// validate textbox (cannot be empty string)
<?php 
$adopt = array("catid", "date1", "date2", "time1", "time2");
$general = array("fname", "lname", "email", "phone"); 

$dict = array(
  "fname" => "", 
  "lname" => "",
  "email" => "",
  "phone" => "",
  "catid" => "",
  "date1" => "",
  "date2" => "",
  "time1" => "",
  "time2" => "",
); 

// Check required fields are not empty first 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $form_type = check_input($_POST["radioBtn"]); 
  $form_fields = array(); 

  if ($form_type == "A") {
    $form_fields = array_merge($general, $adopt); 
  } else {
    $form_fields = $general; 
  }

  foreach ($form_fields as $field) {
    if (empty($_POST[$field])) {
      $error = "You are missing a required field(s)"; 
    } else {
      $dict[$field] = check_input($_POST[$field]); 
    }
  }

  foreach (array("fname", "lname") as $name) {
    if (!preg_match("/^[a-zA-Z-' ]*$/", $dict[$name])) {
      $nameErr = "Only letters and white space allowed";
    }
  }

  if (!filter_var($dict["email"], FILTER_VALIDATE_EMAIL)) {
    $emailErr = "Invalid email format";
  }

  if(preg_match('/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/', $dict["phone"])) {
    $phoneErr = ""; 
  }

  if(preg_match('/^[0-9]{6}$/', $dict["catid"])) {
    $phoneErr = ""; 
  }

  foreach (array("date1", "date2") as $date) {
    $val = $dict[$date]; 
    if (!preg_match("/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/", $val)) {
      $day = substr($val, 0, 2); 
      $month = substr($val, 2, 2); 
      $yr = substr($val, 4, 4); 
      checkdate($day, $month, $yr); 
    }
  }

  foreach (array("time1", "time2") as $time) {
    if (!preg_match("/^[0-9]{2}:[0-9]{2}$/", $dict[$time])) {
      $nameErr = "Only letters and white space allowed";
    }
  }
}

function check_input($data) {
  // Remove extra spaces 
  $data = trim($data);
  // Remove things like <script> so less chance of hacking 
  $data = htmlspecialchars($data);
  return $data;
}
?>