<?php
session_start();
include "include/connect.php";
include "include/functions.php";
include 'include/corp_auth.php';
include "include/website_class.php";
$web = new Website($db); //Website class
$corp->getSubscription();

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
	$search = $_POST['search'].$method;
}
$_SESSION['searchedVal'] = $search;
}
else{
$search = $_SESSION['searchedVal'];
}

?>
<!DOCTYPE html>
<html>
<?php
include "head.php";
?>
<script type="text/javascript">
	let loadmore = "";
	let currentItems = "";
	let numRow = "";
	
</script>
<body class="body-b">
<?php
include "userHeader.php";
?>
<div class="talent-blue-header add-h">
<div class="prof-container ">
	
	<!-- Talent seach form>-->
	<form id="myForm3" method="post" action="talent-profile" enctype="multipart/form-data"> 
		<div class="talent-search">
			
	    	<div class="s_tal">
				<input type="text" name="search" id="inputBox" autocomplete="off" placeholder="Job Title, Qualifications, Skills, Location, Keywords..." value="<?php echo $search ?>" class="s_input">				
	    	</div>
	        
			<button type="submit" class="bton btn1 search-btn" id="tal_search">search</button>
			
		</div>
	</form>
	<!-- End talent search form-->
	<?php
	if($corp->getPackPrice() == 0){
		echo $corp->getUpgradeMessage();
	} 
	?>
  <div class="preloader-container">
   <div class="c c1" style="--i:1;"></div>
       <div class="c c2" style="--i:2;"></div>
       <div class="c c3" style="--i:3;"></div>
       <div class="c c4" style="--i:4;"></div>
       <div class="c c5" style="--i:5;"></div>
  </div>
	<div id="search_return" class="mt-7">
		<?php include("global_search.php");?>
	</div>
	
</div>
<?php

	//$method = substr($method, 1);
	
	?>
	<script type="text/javascript">	
	//var input = "<?php echo $search ?>";
		//document.getElementById('inputBox').value = input;
	</script>

	<?php

?>
</body>
<!-- Javascripts -->
<script type="text/javascript" src="js/toggle.js"></script>
  <script type="text/javascript" src="js/shortlist.js"></script>
  <script type="text/javascript" src="js/button_click.js"></script>
  <script>
    // Function to simulate the loading process
    function simulateLoading() {
      return new Promise(resolve => {
        setTimeout(resolve, 1000); // Simulating a 3-second loading time
      });
    }
			var preloader = document.querySelector('.preloader-container');
      var content = document.getElementById('search_return');
      content.style.display = 'none'; // Show the div content

    // Show the preloader while loading the div content
    window.addEventListener('DOMContentLoaded', function() {

      simulateLoading().then(function() {
        preloader.style.display = 'none'; // Hide the preloader
        content.style.display = 'block'; // Show the div content
      });
    });
  </script>
 <script>
 	 var button = document.getElementById('tal_search');	
var input = document.getElementById("inputBox");

input.addEventListener("keypress", function(event) {
  if (event.key === "Enter") {
  	//content.style.display = 'none'; // Show the div content
  			//Display preloader when enter is pressed
  	   //preloader.style.display = 'flex'; 

  	   //simulateLoading().then(function() {
        preloader.style.display = 'none'; // Hide the preloader
        content.style.display = 'block'; // Show the div content
      //});
   // event.preventDefault();
    document.getElementById("tal_search").click();
  }
});
</script>
	<script type="text/javascript">
		/*$( window ).on("load", function() {
			
        var button = document.getElementById('tal_search');		    
		        
$(function() {
    $('#tal_search').click(function() {
    	content.style.display = 'none'; // Show the div content
        //this.click();
    	preloader.style.display = 'flex'; 
  	   simulateLoading().then(function() {
        preloader.style.display = 'none'; // Hide the preloader
        content.style.display = 'block'; // Show the div content
      });
    }).click();
});
		});	*/

	</script>
<script>
$(document).ready(function () {
    $('#openChildTab').click(function(event){
        event.preventDefault();
       // alert('inno');
        // Open the child tab
        const childTab = window.open(this.href, '_blank');

        // Communicate with the child tab
        if (childTab) {
            childTab.onload = function () {
                childTab.postMessage("Hello from parent window!", "*");
            };
        }
    });
});
</script>


 
</html>