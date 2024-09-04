function fetchState(id) {
	$('#state').html = "";
	$('#state').html('<option>Select City</option>');
	$.ajax({
		type:'post',
		url:'fetchStates.php',
		data:{country_id:id},
		success: function(data){
			$('#state').html(data);
		}
	});
}
