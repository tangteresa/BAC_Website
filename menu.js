$(document).ready(function () {
  // Use window.innerWidth instead of $(window).width() 
  // .width() doesn't include scrollbar (17 px)
  // innerWidth includes scrollbar but not window border
  // outerWidth includes window border
  if (window.innerWidth >= 900) {
    $(".links").show();
  } else {
    $(".links").hide();
  }

  $(window).on('resize', function () {
    if (window.innerWidth >= 900) {
      $(".links").show();
    } else {
      $(".links").hide();
    }
  });

  $(".hamburg").on('click', function () {
    $(".links").toggle();
    if ($(".links").is(":hidden")) {
      $(".hamburg").css('background-color', "#03f0fc");
    } else {
      $(".hamburg").css('background-color', "#26b2b9b6");
    }
  });
});
