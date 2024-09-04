
//var check = document.getElementById("userConsentForm").checked;
function getDate() {
  var today = new Date();
  return today.toLocaleDateString();
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
//Interchange submit and 
if (n == (x.length - 1)) {
document.getElementById("nextBtn").innerHTML = "Submit";

} else {
document.getElementById("nextBtn").innerHTML = "Next";

  //var i=1;
  
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
 document.getElementById("theform").style.display="none"; 
//document.getElementById("myForm").submit();
 preloader.style.display = 'flex'; 
   simulateLoading().then(function() {
    preloader.style.display = 'none'; // Hide the preloader
    //content.style.display = 'block'; // Show the div content
  });
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
else{
// Otherwise, display the correct tab:
  //$('#nextBtn').click(function(){
        $.ajax({
            url: "auto_save.php", 
            type: "POST",
            dataType: "JSON",             
            data: new FormData(document.forms.myForm),
            contentType: false,       
            cache: false,             
            processData:false, 
            success: function(data) {
               //$('#myForm')[0].reset();
            }
        }); 
    //}); 
showTab(currentTab);

}
}
 function changeTabs(n) {
if(document.getElementsByClassName("finish")[n].className)
{
// This function will figure out which tab to display
var x = document.getElementsByClassName("tab");
// Exit the function if any field in the current tab is invalid:
//if (n == 1 && !validateForm()) return false;
// Hide the current tab:
for (i = 0; i < 6; i++) {
x[i].style.display = "none";
}
// Increase or decrease the current tab by 1:
currentTab1 = n;
// if you have reached the end of the form... :
if (currentTab1 >= x.length) {
//...the form gets submitted:
//document.getElementById("myForm").submit();
}
// Otherwise, display the correct tab:
x[currentTab1].style.display = "none";
   currentTab = currentTab1;
  showTab(currentTab1);
}
 
}

  function validateForm() {
    var x = $(".tab");
    var y = x.eq(currentTab).find(".mendatory_input");
    var valid = true;
    y.each(function () {
      if ($(this).val() === "" || $(this).find("option:selected").val() === "") {
        valid = false;
        $(this).addClass("invalid");
      } else {
        $(this).removeClass("invalid");
      }
    });

    if (valid) {
      $(".step").eq(currentTab).addClass("finish");
    }

    return valid;
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

//for gender
 function onGenderChange() {
      var genderSelect = document.getElementById("gender");
      var customGenderContainer = document.getElementById("customGenderContainer");
      var customGenderInput = document.getElementById("customGender");

      if (genderSelect.value === "Other") {
        customGenderContainer.style.display = "block";
        customGenderInput.focus();
      } else {
        customGenderContainer.style.display = "none";
        customGenderInput.value = "";
      }
    }


function checkInput(inputElement) {
if (inputElement.value.trim() !== '') {
inputElement.classList.remove('empty');
inputElement.classList.add('non-empty');
} else {
inputElement.classList.remove('non-empty');
inputElement.classList.add('empty');
}
}