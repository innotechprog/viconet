$(document).ready(function(){
// Get references to the select element and input box
const selectElement = document.getElementById("category");
const inputElement = document.getElementById("inputBox");

// Add an event listener to the select element
selectElement.addEventListener("change", function() {
  // Clear the input box when an option is selected
  inputElement.value = "";
});
});




