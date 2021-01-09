$(document).ready(function () {
  var is_down = [];
  var highest = 6;

  for (i = 1; i <= highest; i++) {
    is_down.push(false);
    $("#d" + i).hide();

    // If you define function closure directly here and use i in the body
    // It will evaluate to 7 because that is the last value of i 
    // But JS uses lexical scope??? Confusion 
    // Maybe something to do with JS execution contexts/no compilation 

    // Passing reference to function reset (instead of the value resulting from
    // executing reset via reset())
    // That way callback function can be called whenever necessary 
    $("#d" + i).on('animationend', reset);
  }

  $(".drop").click(function () {
    var num = $(this).attr('id');
    toggleDrop(num);
  });

  // Code for non-animation dropdown 
  /*function toggleDrop(num) {
    $("#d" + num).toggle();

    if ($("#d" + num).is(":visible")) {
      $("#" + num).html("About me <br> &#9650;");
    } else {
      $("#" + num).html("About me <br> &#9660;");
    }
  }*/

  function toggleDrop(num) {
    // Non-animation dropdown 
    //$("#d" + num).toggle();

    if (is_down[num]) {
      up(num);
    } else {
      drop(num);
    }
  }

  function drop(num) {
    is_down[num] = true;
    $("#d" + num).show()
    $("#d" + num).css('animation-direction', 'normal');
    $("#d" + num).css('animation-name', 'drop');
  }

  function up(num) {
    is_down[num] = false;
    $("#d" + num).css('animation-name', 'drop');
    $("#d" + num).css('animation-direction', 'reverse');
  }

  function reset() {
    var id = $(this).attr('id');
    var num = id.charAt(1);
    if (is_down[num]) {
      $("#" + num).html("About me <br> &#9650;");
      $("#d" + num).css('animation-name', 'none');
    } else {
      $("#d" + num).hide()
      $("#d" + num).css('animation-name', 'none');
      $("#" + num).html("About me <br> &#9660;");
    }
  }

});