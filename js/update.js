$(document).ready(function () {
  // Code modeled from W3 
  // AJAX 
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      // Populate cat ID dropdown select on form with IDs from database 
      document.getElementById("catid").innerHTML = this.responseText;

      // If form is being repopulated with user inputs 
      // Want to set catID to whatever user previously set it as 
      var sessItem = sessionStorage.getItem("filler");
      if (typeof sessItem == 'string') {
        var data = JSON.parse(sessItem);
        if (data != null && data.fill && data.formType == 'A') {
          $("#" + data.formVals["catid"]).prop('selected', true);
        }
      }
      // Clear session variable 
      // Cannot clear in filler.js because unknown when the AJAX
      // response acceptance will be executed/callbacked 
      var filler = { fill: false, formFields: [], formVals: {}, formType: '' };
      sessionStorage.setItem("filler", JSON.stringify(filler));
    }
  };
  xmlhttp.open("GET", "php/getids.php", true);
  xmlhttp.send();
}); 