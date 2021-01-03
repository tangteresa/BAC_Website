$(document).ready(function () {
  $("#adoptForm").hide();
  $("#otherForm").hide();

  $("input[type=radio]").on('change', function () {
    var reason = $('input[type=radio]:checked', '#Form').val();

    if (reason == "A") {
      $("#otherForm").hide();
      $("#adoptForm").show();
    } else if (reason == "O") {
      $("#adoptForm").hide();
      $("#otherForm").show();
    }
  });
});