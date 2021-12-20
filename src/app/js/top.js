// JavaScript Document


function showTabs(n) {
  var tabsNumber = 3;
  for (i = 0; i < tabsNumber; i++) {
      if (i == n) {
          document.getElementById("tabPanel-" + i).style.display = "block";
      } else {
          document.getElementById("tabPanel-" + i).style.display = "none";
      }
  }
}

