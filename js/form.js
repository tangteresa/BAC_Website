$(document).ready(function () {
  // Initialization 
  // For if radio input was already checked on page reload, such as by filler.js
  var reason = $('input[type=radio]:checked', '#Form').val();
  if (reason == "A") {
    $("#otherForm").hide();
  } else if (reason == "O") {
    $("#adoptForm").hide();
  } else {
    $("#otherForm").hide();
    $("#adoptForm").hide();
  }

  // Toggle which form fields show based on type of form selected by user 
  $("input[type=radio]").on('change', function () {
    reason = $('input[type=radio]:checked', '#Form').val();

    if (reason == "A") {
      $("#otherForm").hide();
      $("#adoptForm").show();
    } else if (reason == "O") {
      $("#adoptForm").hide();
      $("#otherForm").show();
    }
  });

  // onsubmit will not call this from an external file, so it is moved to html
  /* function required(item, idx) {
    if ($("#" + item).val() == "") {
      valid = valid && false;
    }
  }

  // Check required items for adopt vs other form type 
  // Cannot validate with required keyword in HTML for hidden elements, as this
  // causes weird issues with page submission and browser element not focusable
  // error
  function validation() {
    window.alert("called"); 
    // Force Javascript to execute before submission to php 
    //e.preventDefault();

    valid = true;
    var form_type = $('input[type=radio]:checked', '#Form').val();
    var adopt = ["catid", "date1", "date2", "time1", "time2"];
    var general = ["fname", "lname", "email", "phone", "radioBtn"];

    general.forEach(required);

    if (form_type == "A") {
      adopt.forEach(required);
    } else if (form_type == "O") {
      required("otherDescr", 0);
    } else {
      valid = false;
    }

    if (!valid) {
      window.alert("Please fill in all fields before submitting.")
    }

    return false;
  }*/
});