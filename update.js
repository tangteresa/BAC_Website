$(document).ready(function () {
  // Code modeled from W3 
  // AJAX 
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("catid").innerHTML = this.responseText;
    }
  };
  xmlhttp.open("GET", "getids.php", true);
  xmlhttp.send();
}); 