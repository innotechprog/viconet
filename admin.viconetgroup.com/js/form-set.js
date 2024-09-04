
//var check = document.getElementById("userConsentForm").checked;
function getDate(){
var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();
today = mm + '-' + dd + '-' + yyyy;
today = new Date(today);
return today;
}

let todayDate = getDate();
var currentTab = 0; // Current showTab is set to be the first tab (0)
showTab(currentTab); // Display the current tab
function showTab(n) {
// This function will display the specified tab of the form ...
var x = document.getElementsByClassName("tab");
x[n].style.display = "block";
// ... and fix the Previous/Next buttons:
if (n == 0) {
document.getElementById("prevBtn").style.display = "none";
} else {
document.getElementById("prevBtn").style.display = "inline";
}
if (n == (x.length - 1)) {
document.getElementById("nextBtn").innerHTML = "Submit";

} else {
document.getElementById("nextBtn").innerHTML = "Next";

  //var i=1;
  $('#nextBtn').click(function(){
        $.ajax({
            url: "auto_save.php", 
            type: "POST",
            dataType: "JSON",             
            data: new FormData(document.forms.myForm),
            contentType: false,       
            cache: false,             
            processData:false, 
            success: function(data) {
               
            }
        });
    });
}
// ... and run a function that displays the correct step indicator:
fixStepIndicator(n)
}
function nextPrev(n) {
// This function will figure out which tab to display
var x = document.getElementsByClassName("tab");
// Exit the function if any field in the current tab is invalid:
if (n == 1 && !validateForm()) return false;
// Hide the current tab:
x[currentTab].style.display = "none";
// Increase or decrease the current tab by 1:
currentTab = currentTab + n;
// if you have reached the end of the form... :
if (currentTab >= x.length) {
//...the form gets submitted:
//document.getElementById("myForm").submit();
$(document).ready(function(){
  //var i=1;
    $.ajax({
      url:"save_profile.php",
      method:"POST",
      data:$('#myForm').serialize(),
      success:function(data)
      {
        //$('#myForm')[0].reset();        
         window.location.replace(window.location.protocol + "//" + window.location.host + "/success");
      }
    });
});
return false;
}
// Otherwise, display the correct tab:
showTab(currentTab);
}
function validateForm() {
// This function deals with validation of the form fields
var x, y, i, valid = true;
x = document.getElementsByClassName("tab");
y = x[currentTab].getElementsByClassName("mendatory_input");
// A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
// If a field is empty...
if (y[i].value == "") {
// add an "invalid" class to the field:
y[i].className += " invalid";
// and set the current valid status to false:
valid = false;
}
else{
  y[i].className.replace("invalid",""); 
  valid = true; 
}
}

/*if(currentTab == 1)
{
  
let startDate1 = new Date(document.getElementById("start_date1").value);
//let endDate = new Date(document.getElementById("end_date").value);
  if(startDate1 > todayDate)
  {
    alert("Start date cannot be greater than today date")
    valid = false;
  }
}*/
// If the valid status is true, mark the step as finished and valid:
if (valid) {
document.getElementsByClassName("step")[currentTab].className += " finish";
}
return valid; // return the valid status
}
function fixStepIndicator(n) {
// This function removes the "active" class of all steps...
var i, x = document.getElementsByClassName("step");
for (i = 0; i < x.length; i++) {
x[i].className = x[i].className.replace(" active", "");
}
//... and adds the "active" class to the current step:
x[n].className += " active";
}