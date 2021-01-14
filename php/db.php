<?php 
class Database {
  // Representing connection to mySQL database 
  public $conn; 

  function __construct() {
    // From W3 Schools tutorial 
    $servername = "localhost";
    $username = "root";
    $password = ""; 

    $this->conn = new mysqli($servername, $username, $password);

    if ($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
      $this->conn = null; 
    } 
  }

  // Returns empty error message if cat ID is valid, otherwise returns error message 
  function is_valid_id($id) {
    if (is_null($this->conn)) {
      return "<p class='descr'>Problem connecting to database. Cannot verify submission.</p><br>"; 
    }

    $sql = "SELECT * FROM bac.cats WHERE catid=" . $id;
    $result = $this->conn->query($sql);
    
    if($result->num_rows == 0) {
      return "<p class='descr'>The cat ID you specified does not exist in the database.</p><br>"; 
    }
    return "";  
  }

  // Get all cat IDs from database 
  // Is null if error fetching IDs 
  function idnames() {
    if (is_null($this->conn)) { 
      return null; 
    }

    $sql = "SELECT catid, name FROM bac.cats";
    $result = $this->conn->query($sql);
    
    return $result; 
  }

  // Get name of cat whose ID is specified 
  // Returns empty string if ID does not exist 
  function cat_name($id) {
    if (is_null($this->conn)) { 
      return ""; 
    }

    $sql = "SELECT name FROM bac.cats WHERE catid=" . $id;
    $result = $this->conn->query($sql);
    
    if($result->num_rows == 0) {
      return ""; 
    }
    $row = $result->fetch_assoc();
    return $row["name"];  
  }
}
?>
