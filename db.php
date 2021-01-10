<?php 
class Database {
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

  function is_valid_id($id) {
    if (is_null($this->conn)) {
      echo "<p class='descr'>Problem connecting to database. Cannot verify submission.</p><br>"; 
      return false; 
    }

    $sql = "SELECT * FROM bac.cats WHERE catid=" . $id;
    $result = $this->conn->query($sql);
    
    if($result->num_rows == 0) {
      echo "<p class='descr'>The cat ID you specified does not exist in the database.</p><br>"; 
      return false; 
    }
    return true;  
  }

  function idnames() {
    if (is_null($this->conn)) { 
      return null; 
    }

    $sql = "SELECT catid, name FROM bac.cats";
    $result = $this->conn->query($sql);
    
    return $result; 
  }

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
