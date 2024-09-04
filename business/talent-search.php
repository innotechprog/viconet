<?php
session_start();
include "include/connect.php";
include "include/functions.php";
include 'include/corp_auth.php';
?>
<!DOCTYPE html>
<html>
<?php
include "head.php";
?>
<body class="body-b">
<?php
include "userHeader.php";
?>
<div class="blue-bg">
<div class="prof-container vertical-center">
	
	<!-- Talent seach form>-->
	<label class="mb-5 l-36-n text-white">Search For<label class="text-purple"> Talent</label> </label>
	<form id="" method="post" action="talent-profile" enctype="multipart/form-data"> 
		<div class="talent-search">
			<!--
			<div class="s_tal">
				<input type="text" name="search_field" autocomplete="off" placeholder="Job Title, keywords..." class="s_input">
				<div class="autocomplete-search">
		          Auto suggestio
		        </div>
	    	</div><input type="text" name="loc" id="search_location" placeholder="Location">--> 
	    	<div class="s_tal">
				<input type="text" name="search" value="" id="searchInput" autocomplete="off" placeholder="Job Title, Qualifications, Skills, Location, Keywords..." class="s_input">	
				<div class="autocomplete-search">
          <!--Auto suggestion-->
        </div>			
	    	</div>
	        
			<button type="submit" class="bton btn1 search-btn" id="talSearch">search</button>
			
		</div>
	</form>
	<!-- End talent search form-->
</div>

</div>
</body>
<!-- Javascripts -->
<script type="text/javascript" src="js/toggle.js"></script>
 <script type="text/javascript" src="js/button_click.js"></script>
 
 <script>
var input = document.getElementById("searchInput");
input.addEventListener("keypress", function(event) {
  if (event.key === "Enter") {
    event.preventDefault();
     var button = document.getElementById('talSearch');
    button.form.submit();
  }
});
</script>

</html>