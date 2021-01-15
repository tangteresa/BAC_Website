// Save current time of user's machine to hidden input element with id currTime
function setCurrTime() {
  // Time format is YYYY-MM-DD HH:MM
  var date = new Date();
  var year = date.getFullYear();

  // getMonth returns 0-based months 
  var month = date.getMonth() + 1;
  var day = padNum(date.getDate());
  var hr = date.getHours();
  var min = date.getMinutes();
  $("#currTime").val(year + "-" + month + "-" + day + " " + hr + ":" + min);
}

// If number is one digit, make it two 
function padNum(n) {
  if (n < "10") {
    return "0" + n;
  }
  return n;
}