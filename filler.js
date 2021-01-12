// Check if form needs to be filled 
$(document).ready(function () {
  // Retrieve form values set in submit.php 
  var sessItem = sessionStorage.getItem("filler");
  if (typeof sessItem == 'string') {
    var data = JSON.parse(sessItem);
    if (data != null && data.fill) {
      $.each(data.formFields, function (idx, value) {
        var val = data.formVals[value];
        $("#" + value).val(val);
      });

      if (data.formType == 'A') {
        $("#adoption").prop('checked', true);
      } else if (data.formType == 'O') {
        $("#alternative").prop('checked', true);
      }

      // Clear session variable
      var filler = { fill: false, formFields: [], formVals: {}, formType: '' };
      sessionStorage.setItem("filler", JSON.stringify(filler));

    }
  }

}); 