var maxLength = 700;
$('#about_cand').keyup(function() {
  var length = $(this).val().length;
  var length = maxLength-length;
  $('#count_chars').text(length);
});