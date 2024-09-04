$(function() {
	$(".delbutton").click(function(){ 
		//Save the link in a variable called element
		var element = $(this);
		//Find the id of the link that was clicked
		var del_id = element.attr("id");
		var table = "qualifications";
		var field = "q_id";
		//Built a url to send
		var info = 'id=' + del_id +'&ta='+table +'&fi=' + field;
		if(confirm("Do you want to delete this qualification? There is NO undo!"))
		{
			$.ajax({
			type: "GET",
			url: "cand_delete.php",
			data: info,
			success: function(){

			}
		});
		$(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast").animate({ opacity: "hide" }, "slow");
		}
		return false;
	});
});
$(function() {
	$(".delskill").click(function(){
		//Save the link in a variable called element
		var element = $(this);
		//Find the id of the link that was clicked
		var del_id = element.attr("id");
		var table = "key_skills";
		var field = "id";
		//Built a url to send
		var info = 'id=' + del_id +'&ta='+table +'&fi=' + field;
		if(confirm("Do you want to delete this skill? There is NO undo!"))
		{
			$.ajax({
			type: "GET",
			url: "cand_delete.php",
			data: info,
			success: function(){

			}
		});
		$(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast").animate({ opacity: "hide" }, "slow");
		}
		return false;
	});
});
$(function() {
	$(".delcourse").click(function(){
		//Save the link in a variable called element
		var element = $(this);
		//Find the id of the link that was clicked
		var del_id = element.attr("id");
		var table = "key_courses";
		var field = "id";
		//Built a url to send
		var info = 'id=' + del_id +'&ta='+table +'&fi=' + field;
		if(confirm("Do you want to delete this course? There is NO undo!"))
		{
			$.ajax({
			type: "GET",
			url: "cand_delete.php",
			data: info,
			success: function(){

			}
		});
		$(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast").animate({ opacity: "hide" }, "slow");
		}
		return false;
	});
});

$(function() {
	$(".delexp").click(function(){
		//Save the link in a variable called element
		var element = $(this);
		//Find the id of the link that was clicked
		var del_id = element.attr("id");
		var table = "candidate_role";
		var field = "id";
		//Built a url to send
		var info = 'id=' + del_id +'&ta='+table +'&fi=' + field;
		if(confirm("Do you want to delete this work experience? There is NO undo!"))
		{
			$.ajax({
			type: "GET",
			url: "cand_delete.php",
			data: info,
			success: function(){

			}
		});
		$(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast").animate({ opacity: "hide" }, "slow");
		}
		return false;
	});
});
$(function() {
	$(".delrole").click(function(){
		//Save the link in a variable called element
		var element = $(this);
		//Find the id of the link that was clicked
		var del_id = element.attr("id");
		var table = "key_roles";
		var field = "id";
		//Built a url to send
		var info = 'id=' + del_id +'&ta='+table +'&fi=' + field;
		if(confirm("Do you want to delete this work experience? There is NO undo!"))
		{
			$.ajax({
			type: "GET",
			url: "cand_delete.php",
			data: info,
			success: function(){

			}
		});
		$(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast").animate({ opacity: "hide" }, "slow");
		}
		return false;
	});
});
$(function() {
	$(".delproj").click(function(){
		//Save the link in a variable called element
		var element = $(this); 
		//Find the id of the link that was clicked
		var del_id = element.attr("id");
		var page_id = "projects";
		var table = "receipts";
		var field = "receipt_id";
		del_id = del_id.substr(1);
		//Built a url to send
		var info = 'id=' + del_id +'&ta='+table +'&fi=' + field+'&pid='+page_id;
		if(confirm("Do you want to delete this project? There is NO undo!"))
		{
			$.ajax({
			type: "GET",
			url: "delete.php",
			data: info,
			success: function(){
				let numProjects = parseInt(document.getElementById("numProj").textContent) - 1;
        		$('#numProj').html(numProjects);
			}
		});
		$(this).parents(".projtabs").animate({ backgroundColor: "#fbc7c7"}, "fast").animate({ opacity: "hide" }, "slow");
		}
		
		return false;
		
	});
});
$(function() {
	$(".delJob").click(function(){
		//Save the link in a variable called element
		var element = $(this); 
		//Find the id of the link that was clicked
		var del_id = element.attr("id");
		var page_id = "jobs";
		var table = "jobs";
		var field = "job_id";
		del_id = del_id.substr(1);
		//Built a url to send
		var info = 'id=' + del_id +'&ta='+table +'&fi=' + field+'&jid='+page_id;
		if(confirm("Do you want to delete this Job? There is NO undo!"))
		{
			$.ajax({
			type: "GET",
			url: "delete.php",
			data: info,
			success: function(){
				//let numProjects = parseInt(document.getElementById("numProj").textContent) - 1;
        		//$('#numProj').html(numProjects);
			}
		});
		$(this).parents(".projtabs").animate({ backgroundColor: "#fbc7c7"}, "fast").animate({ opacity: "hide" }, "slow");
		}
		
		return false;
		
	});
});