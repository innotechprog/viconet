<?php
session_start();
include "include/connect.php";
include "include/functions.php";
$candidate = new Candidates($db);
include "include/jobs_class.php";
$jobs = new Jobs($db);
?>
<!DOCTYPE html>
<html>
<?php
include "head.php";
?>
<body class="body-b">

<div class="talent-blue-header add-h">
<div class="prof-container ">	
	<!-- Talent seach form>-->
	<form id="myForm" method="post"> 
		<div class="talent-search">
			<div class="s_tal">
				<input type="text" name="search_field" autocomplete="off" placeholder="Job Title, keywords..." class="s_input" id="inputBox"> 
				<div class="autocomplete-search">
		          <!--Auto suggestion-->
		        </div>
	    	</div>
			<button class="search-btn bton btn1 " type="button" id="job_search">SEARCH</button>			
		</div>
	</form>
	<!-- End talent search form-->
	<div id="jobs_return">
	</div>
</div>
<?php
include "footer.php";
?>
</body>
<?php
if(isset($_POST['search'])){
	$method = "";
	$search="";
	if(isset($_POST['wmethod'])){
	foreach ($_POST['wmethod'] as $key => $value) {
		$method = $method.','.$value;
	}
	$search = $_POST['search'].$method;
}
else{
	$search = $_POST['search_field'].$method;
}
}
	//$method = substr($method, 1);
	
	?>
<!-- Javascripts -->
<script type="text/javascript">	
var input = "<?php echo $search ?>";
	document.getElementById('inputBox').value = input;
</script>
<script type="text/javascript" src="js/toggle.js"></script>
<script>
var searchInput = 'search_location';
 
$(document).ready(function () {
 var autocomplete;
 autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInput)), {
  types: ['geocode'],
  /*componentRestrictions: {
   country: "USA"
  }*/
 });  
 google.maps.event.addListener(autocomplete, 'place_changed', function () {
  var near_place = autocomplete.getPlace();
 });
});
</script>
 <script src="js/suggestions.js"></script>
 <script src="js/return_jobs.js"></script>
  <script type="text/javascript" src="js/button_click.js"></script>
 <script src="js/search-script.js"></script>

</html> 