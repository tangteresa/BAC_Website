$(document).ready(function () {
  var images = [
    "images/sign.png",
    "images/poster.png",
    "images/mural.png",
    "images/catroom.png",
    "images/surgeryroom.png"
  ];

  var currIdx = 0;

  $("#nxt").click(function () {
    if (currIdx == images.length - 1) {
      currIdx = 0;
    } else {
      currIdx = currIdx + 1;
    }
    $("#slideImg").attr('src', images[currIdx]);
  });

  $("#prev").click(function () {
    if (currIdx == 0) {
      currIdx = images.length - 1;
    } else {
      currIdx = currIdx - 1;
    }
    $("#slideImg").attr('src', images[currIdx]);
  });

}); 