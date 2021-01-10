<!DOCTYPE html>
<html>

<head>
  <title>Submission</title>
  <link rel="stylesheet" href="all.css">
</head>

<body>
<div id="submitted">

<?php 
function send_confirmation($form_type, $values, $catname) {
  $to = $values["email"];
  $subject = "Buddy Adoption Center Inquiry Confirmation Email";
  $greeting = "Hello " . $values["fname"] . " " . $values["lname"] . "!\r\n";

  if ($form_type == "A") {
    $body = "You requested an interview for the adoption of " . ucfirst($catname) . 
    " at times " . $values["time1"] . " on " . $values["date1"] . " and "
    . $values["time2"] . " on " . $values["date2"] . "."; 
  } else {
    $body = "We have received your inquiry request, which was as follows: \r\n \r\n" . 
    $values["otherDescr"]; 
  } 

  $end = "\r\n \r\nWe will be in touch within 3 business days!\r\nPeace, \r\nBuddy Adoption Center"; 
  $msg = $greeting . wordwrap($body, 70) . $end; 
  $headers = "From: inquiries@bac.com"; 
  
  mail($to, $subject, $msg, $headers);
}
?>

<?php  
require_once("db.php"); 

function check_input($data) {
  // Remove extra spaces 
  $data = trim($data);
  // Remove things like <script> so less chance of hacking 
  $data = htmlspecialchars($data);
  return $data;
}

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
$catname = ""; 

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
      echo "<p class='descr'>The required field " . $field . " is missing. </p><br>"; 
    } else {
      $dict[$field] = check_input($_POST[$field]); 
    }
  }

  foreach (array("fname", "lname") as $name) {
    if (!preg_match("/^[a-zA-Z-' ]*$/", $dict[$name])) {
      $valid = False;
      echo "<p class='descr'> Field " . $name . " is invalid. Names can only have letters or whitespace. </p><br>"; 
    }
  }

  if (!filter_var($dict["email"], FILTER_VALIDATE_EMAIL)) {
    $valid = False;
    echo "<p class='descr'>The email format is invalid. </p><br>"; 
  }

  if(!preg_match('/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/', $dict["phone"])) {
    $valid = False;
    echo "<p class='descr'>The phone format is invalid. It must be xxx-xxx-xxxx. </p><br>"; 
  }

  if ($form_type == "A") {

    if(!preg_match('/^[0-9]{6}$/', $dict["catid"])) {
      $valid = False;
      echo "<p class='descr'>The cat ID must be 6 digits and contain only numbers. </p><br>";  
    } else {
      // Check if cat ID exists in database 
      $db = new Database(); 
      $valid = $valid && $db->is_valid_id($dict["catid"]); 
      $catname = $db->cat_name($dict["catid"]); 
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
          echo "<p class='descr'>An invalid date was submitted. </p><br>"; 
        }
      }
    }

    foreach (array("time1", "time2") as $time) {
      if (!preg_match("/^[0-9]{2}:[0-9]{2}$/", $dict[$time])) {
        $valid = False; 
        echo "<p class='descr'>An invalid time was submitted. </p><br>"; 
      }
    }
  } 
}

if ($valid) {
  echo "<p class='descr'>Your form submission is valid. Thank you!</p>"; 
  if(strlen($catname) > 0) {
    $capname = ucfirst($catname); 
    echo "<p class='descr'>We will contact you within 3 business days about your adoption of $capname.</p>"; 
  }

  // Use if SMTP server is setup with account inquiries@bac.com 
  // Otherwise, can test by uncommenting and also installing Papercut on machine
  // send_confirmation($form_type, $dict, $catname); 
} else {
  echo "<p class='descr'>Please correct these errors and resubmit.</p>"; 
}
?>

<a href="contact.html" id="return">Click here to return</a>
</div>

</body>
</html>