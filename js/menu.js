$(document).ready(function () {
  /* Used window.innerWidth instead of $(window).width() because .width() doesn't 
  include scrollbar (17 px) */
  // innerWidth includes scrollbar but not window border
  // outerWidth includes window border
  if (window.innerWidth >= 900) {
    $(".links").show();
  } else {
    $(".links").hide();
  }

  // Can also be done with media queries 
  $(window).on('resize', function () {
    if (window.innerWidth >= 900) {
      $(".links").show();
    } else {
      $(".links").hide();
    }
  });

  // Highlight hamburger menu icon if mobile menu is opened 
  $(".hamburg").on('click', function () {
    $(".links").toggle();
    if ($(".links").is(":hidden")) {
      $(".hamburg").css('background-color', "#03f0fc");
    } else {
      $(".hamburg").css('background-color', "#26b2b9b6");
    }
  });
});
