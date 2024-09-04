<?php
session_start();
include "include/connect.php";
include "include/functions.php";
?>
<!DOCTYPE html>
<html>
<?php
include "head.php";
?>
<body class="body-b">
	<div class="prof-container">
		<div class="cont-center col-lg-6">			
		<div class="white-container">
			
				<div class="text-center">
					<div style="margin-top:30px;margin-bottom: 30px;">
						<img src="img/success.svg">
					</div>
					<label class="l-18" style="margin-bottom:40px">Thank you for completing your profile</label>
					
				</div>
				<div class="">					
					<div class="row">					
						<div class="col-lg-12 form-group">
							<button class="bton btn2" id="redi" style="width:100%">VIEW PROFILE</button>						
						</div>						
					</div>
				</div>
				
				
		
			</div>
		</div>
	</div>


<?php
include "footer.php";
?>
</body>
<!-- Javascripts -->
<script type="text/javascript" src="js/toggle.js"></script>
<script type="text/javascript">
   $(document).ready(function(){
  $('#redi').click(function(){
window.location = "profile-view";

});
}); 
</script>

</html>