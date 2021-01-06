<!DOCTYPE html>
<html>
<body>

<?php 
$adopt = array("catid", "date1", "date2", "time1", "time2");
$other = array("otherDescr"); 
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
  "otherDescr" => ""
); 

$valid = True; 

// Check required fields are not empty first 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $form_type = check_input($_POST["radioBtn"]); 
  $form_fields = array(); 

  if ($form_type == "A") {
    $form_fields = array_merge($general, $adopt); 
  } else {
    $form_fields = array_merge($general, $other); 
  }

  foreach ($form_fields as $field) {
    if (empty($_POST[$field])) {
      $valid = False; 
      // $error = "You are missing a field(s). All fields are required."; 
    } else {
      $dict[$field] = check_input($_POST[$field]); 
    }
  }

  foreach (array("fname", "lname") as $name) {
    if (!preg_match("/^[a-zA-Z-' ]*$/", $dict[$name])) {
      //$nameErr = "Only letters and white space allowed";
      $valid = False;
    }
  }

  if (!filter_var($dict["email"], FILTER_VALIDATE_EMAIL)) {
    //$emailErr = "Invalid email format";
    $valid = False;
  }

  if(preg_match('/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/', $dict["phone"])) {
    //$phoneErr = ""; 
    $valid = False;
  }

  if ($form_type == "A") {

    if(preg_match('/^[0-9]{6}$/', $dict["catid"])) {
      $valid = False;
    }
    
    foreach (array("date1", "date2") as $date) {
      $val = $dict[$date]; 

      if (!preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $val)) {
        // HTML form for date is YYYY-MM-DD
        $yr = intval(substr($val, 0, 4)); 
        $day = intval(substr($val, 4, 2)); 
        $month = intval(substr($val, 6, 2)); 
        if (!checkdate($day, $month, $yr)) {
          $date = False; 
        }
      }
    }

    foreach (array("time1", "time2") as $time) {
      if (!preg_match("/^[0-9]{2}:[0-9]{2}$/", $dict[$time])) {
        $valid = False; 
      }
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

<?php

echo "The values you submitted are as follows: ";
foreach($form_fields as $item) {
  echo $dict[$item];  
}

if ($valid) {
  echo "Your form submission is valid. Thank you!"; 
} else {
  echo "There are one or more errors with your form. Please make sure 
  that names only contain whitespace and letters. Make sure you have the 
  correct format for phonenumbers, dates, times, etc."; 
}
?>

<a href="contact.html">Return</a>

</body>
</html>