document.getElementById("open0").click();

function viewJobs(evt,tabName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("jobs-tab");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
 // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("pdiv");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace("active", "");
  }
  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(tabName).style.display = "block";
  //let tabId ="#"+tabName;
  evt.currentTarget.className += " active";
}
//$(".defaultOpen").click();