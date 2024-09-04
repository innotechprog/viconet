$(function() {
	$("#delAcc").click(function(){
	 
		//Find the id of the link that was clicked
		var id = "corp";
		//Built a url to send
		var info ='id='+id;
		if(confirm("Are you sure you want to delete this account? There is NO undo!"))
		{
			$.ajax({
			type: "GET",
			url: "deleteCAcc.php",
			data: info,
			success: function(){

			}
		});
			window.location = "message?del=user";
		}
		return false;
	});
});
$(function() {
	$("#delCAcc").click(function(){
	
		//Find the id of the link that was clicked
		var id = "cand";
		//Built a url to send
		var info ='id='+id;
		if(confirm("Are you sure you want to delete this account? There is NO undo!"))
		{
			$.ajax({
			type: "GET",
			url: "deleteCAcc.php",
			data: info,
			success: function(){

			}
		});
			window.location = "message?del=user";
		}
		return false;
	});
});