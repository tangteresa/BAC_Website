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
  }

});