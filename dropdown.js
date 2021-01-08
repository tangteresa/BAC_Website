$(document).ready(function () {
  var highest = 6;

  for (i = 1; i <= highest; i++) {
    $("#d" + i).hide();
  }

  $(".drop").click(function () {
    var num = $(this).attr('id');
    toggleDrop(num);
  });

  function toggleDrop(num) {
    $("#d" + num).toggle();

    if ($("#d" + num).is(":visible")) {
      $("#" + num).html("About me <br> &#9650;");
    } else {
      $("#" + num).html("About me <br> &#9660;");
    }
  }

});