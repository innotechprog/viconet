function toggleInput(optionId) {
  var selectElement = document.getElementById(optionId);
  var otherInput = document.getElementById("otherInput");
  if (selectElement.value === "other") {
    otherInput.style.display = "block";

  } else {
    otherInput.style.display = "none";
  }
}
 $(document).ready(function() {
  $('.rbtn').change(function() {
     if ($('#otherOption').is(':checked')) {
          $('#otherText').removeClass('hidden');
        } else {
          $('#otherText').addClass('hidden');
        }
  });
});