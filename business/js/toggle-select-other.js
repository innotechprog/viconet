function toggleInput(optionId) {
  var selectElement = document.getElementById(optionId);
  var otherInput = document.getElementById("otherInput");
  if (selectElement.value === "other") {
    otherInput.style.display = "block";

  } else {
    otherInput.style.display = "none";
  }
}