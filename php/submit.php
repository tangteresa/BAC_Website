<!DOCTYPE html>
<html>

<head>
  <title>Submission</title>
  <script src="../js/jquery-3.5.1.min.js"></script>
  <link rel="stylesheet" href="../css/all.css">
</head>

<body>
<div id="submitted">

<?php 
// Sends confirmation email once user submits form and it is validated 
// Currently disabled 
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
// Server-side form validation script 

require_once("db.php"); 

function check_input($data) {
  // Remove extra spaces 
  $data = trim($data);
  // Remove things like <script> for security 
  $data = htmlspecialchars($data);
  return $data;
}

// Form fields 
$adopt = array("catid", "date1", "date2", "time1", "time2");
$other = array("otherDescr");
$general = array("fname", "lname", "email", "phone"); 

// User-submitted form field values 
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

// Assume form is valid at first 
$valid = True; 

// Check required fields are not empty first 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $form_type = check_input($_POST["radioBtn"]); 
  $form_fields = array(); 

  if ($form_type == "A") {
    $form_fields = array_merge($general, $adopt); 
  } else if ($form_type == "O") {
    $form_fields = array_merge($general, $other); 
  } else {
    echo "<p class='descr'>You must specify the type of inquiry you are making</p><br>"; 
    $valid = False; 
    $form_fields = $general; 
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

  // Check format of required fields for adoption type form 
  if ($form_type == "A") {

    if(!preg_match('/^[0-9]{6}$/', $dict["catid"])) {
      $valid = False;
      echo "<p class='descr'>The cat ID must be 6 digits and contain only numbers. </p><br>";  
    } else {
      // Check if cat ID exists in database 
      $db = new Database(); 
      $idErr = $db->is_valid_id($dict["catid"]); 
      echo $idErr; 
      $valid = $valid && ($idErr == ""); 
      $catname = $db->cat_name($dict["catid"]); 
    }
    
    foreach (array("date1", "date2") as $date) {
      $val = $dict[$date]; 

      if (!preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $val)) {
        // HTML format for date is YYYY-MM-DD
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
  if($form_type == 'A') {
    $capname = ucfirst($catname); 
    echo "<p class='descr'>We will contact you within 3 business days about your adoption of $capname.</p>"; 
  }

  // Confirmation email feature 
  // Use if SMTP server is setup with account inquiries@bac.com 
  // Otherwise, can test by uncommenting and also installing Papercut on machine
  // send_confirmation($form_type, $dict, $catname); 
} else {
  echo "<p class='descr'>Please correct these errors and resubmit.</p>"; 
}
?>

<a href="../contact.html#Form" id="return">Click here to return</a>
</div>

<script>
    // Script to store user-submitted form values if form was invalid 
    // So that the form can be repopulated when user goes to fix their errors 
    $(document).ready(function () {
      function save_fields() {
        var isValid = <?php echo json_encode($valid) ?>; 
        if(!isValid) {
          var fields = <?php echo json_encode($form_fields); ?>; 
          var values = <?php echo json_encode($dict); ?>; 
          var form_type = <?php echo json_encode($form_type) ?>; 
          var filler = {fill: true, formFields: fields, formVals: values, formType: form_type}; 

          // sessionStorage saves string key/value pairs 
          // JSON stringify cannot stringify functions since functions aren't valid JSON
          // Available to other pages in application until browser is closed 
          sessionStorage.setItem("filler", JSON.stringify(filler)); 
        }
      }
      $("#return").click(save_fields); 
    }); 
</script>

</body>
</html>