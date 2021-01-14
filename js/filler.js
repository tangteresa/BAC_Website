/* If user submitted an invalid form, then repopulate form with their
inputs so that they can correct their mistakes */
$(document).ready(function () {
  // Retrieve form values stored in submit.php 
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

    }
  }

}); 