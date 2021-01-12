$(document).ready(function () {
  // Code modeled from W3 
  // AJAX 
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("catid").innerHTML = this.responseText;

      // If form is being refilled 
      // Want to set catID to whatever user previously set it as 
      var sessItem = sessionStorage.getItem("filler");
      if (typeof sessItem == 'string') {
        var data = JSON.parse(sessItem);
        if (data != null && data.fill && data.formType == 'A') {
          $("#" + data.formVals["catid"]).prop('selected', true);
        }
      }
      // Clear session variable 
      // Cannot clear in filler.js because we don't know when the AJAX
      // response acceptance will be executed 
      var filler = { fill: false, formFields: [], formVals: {}, formType: '' };
      sessionStorage.setItem("filler", JSON.stringify(filler));
    }
  };
  xmlhttp.open("GET", "getids.php", true);
  xmlhttp.send();
}); 