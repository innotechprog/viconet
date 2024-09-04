<?php
session_start();
include "include/connect.php";
include "include/functions.php";
if(isset($_SESSION['id'])) {
include "include/auth.php";
}
include "include/website_class.php";
if(isset($_POST['search_field'])){
unset($_POST['search_field']);
unset($_POST['job_category']);
}
$web = new Website($db); //Website class
include "../".$web->getWebLinkExt()."business.viconetgroup.com/include/jobs_class.php";
$jobs = new Jobs($db);
$corp = new Corporate($db);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Vico.net | Job Opportunities</title>
  <meta content="Our platform connects you with data science, digital, engineering, information systems, technology and analytical group of professionals critical to the future of work and business solutions." name="Jobs">
  <meta content="" name="data science, digital, engineering, information systems, technology">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<?php
include "head1.php";
?>	
</head>
<body class="body-b">
<?php
if (isset($_SESSION['id'])){
	include "candidate-header.php";
}
else{
	include "jobs-header.php";
}
?>
<div class="talent-blue-header <?php if(!isset($_SESSION['id'])){?> add-h2<?php }else{?> add-h<?php } ?>">
<div class="prof-container">
	<div  style="" class="mb-4">
		<label class="l-24 text-white<?php if(!isset($_SESSION['id'])){?> mt-5 <?php }else{ echo ' '; } ?>mb-4">Job search</label>
	</div>
	<!-- Talent seach form>-->
<div>
	<form id="myForm" method="post"> 
		<div class="talent-search">
			<div class="s_tal">
				<input type="text" name="search_field" autocomplete="off" placeholder="Job Title, keywords..." class="s_input" id="inputBox"> 
				<div class="autocomplete-search">
		          <!--Auto suggestion-->
		        </div>
	    	</div>
	    	<select class="cust-select mr-3 p-12" name="job_category" id="category">
	    		<option value="all">All Categories</option>
	    		<?php 
				$query = $corp->getAllIndustries();
				for ($i=0; $rows = $query->fetch() ; $i++) { ?>
					<option value="<?php echo $rows['industry'] ?>"><?php echo $rows['industry'] ?></option>
					<?php
				}
				?>	
	    	</select>
			<button class="search-btn bton btn1 " type="button" id="job_search">SEARCH</button>			
		</div>
	</form>
</div>
	<!-- End talent search form-->
	<div id="jobs_return">
	</div>
</div>
<?php
if (!isset($_SESSION['id'])) {
	include "jobs-footer.php";
}
?>
</body>
<?php
$method = "";
	$search="";
if(isset($_POST['search'])){
	
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
	<script type="text/javascript">
		$( window ).on("load", function() {
			
        var button = document.getElementById('job_search');		    
		        
$(function() {
    $('#job_search').click(function() {
        //this.click();
    	
    }).click();
});
		});	
</script>
<script>
var input = document.getElementById("inputBox");

input.addEventListener("keypress", function(event) {
  if (event.key === "Enter") {
    event.preventDefault();
    document.getElementById("job_search").click();
    }
});
</script>
 <script src="js/suggestions.js"></script>
  <script src="js/job-togglebtn.js"></script>
 <script src="js/return_jobs.js"></script>
  <script type="text/javascript" src="js/button_click.js"></script>
 <script src="js/search-script.js"></script>
 <script src="js/job-category-control.js"></script>

</html> 