$(document).ready(function () {
  // Stores whether each cat profile 'About Me' dropdown is down or retracted 
  var is_down = [];

  // Number of cat profiles on cats page 
  var numProfiles = document.getElementsByClassName("catDropdown").length;

  for (i = 1; i <= numProfiles; i++) {
    is_down.push(false);
    $("#d" + i).hide();

    /* If function is defined directly here and uses i in the body, it will 
    evaluate to 7 because that is the last value of i. However, JS uses 
    lexical scope? Might have to do with hoisting or execution contexts */

    /* Passing reference to function reset (instead of the value resulting from
    executing reset via reset()) */
    $("#d" + i).on('animationend', reset);
  }

  $(".drop").click(function () {
    var num = $(this).attr('id');
    toggleDrop(num);
  });

  // Code for non-animated dropdown 
  /*function toggleDrop(num) {
    $("#d" + num).toggle();

    if ($("#d" + num).is(":visible")) {
      $("#" + num).html("About me <br> &#9650;");
    } else {
      $("#" + num).html("About me <br> &#9660;");
    }
  }*/

  function toggleDrop(num) {
    // Uncomment for non-animated dropdown 
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

  /* Whenever drop or retraction animation is over, reset CSS properties to 
  default */
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