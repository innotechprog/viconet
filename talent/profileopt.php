<?php
session_start();
include "include/connect.php";
include "include/functions.php";
include "include/create-profile-auth.php";
$candidate->address();
$candidate->getCvData();
$candidate->setDate();
?>
<!DOCTYPE html>
<html>
<?php  
include "head.php";
?>
<body class="body-b">
<div class="talent-blue-header">
	<div class="prof-container">
	   <div class="cont-center col-lg-6">			
		<div class="white-container" id="theform">
				<div class="text-center">
					<div>
						<img src="img/viconet-logo.svg" style="margin-bottom:20px;" width="200px">
					</div>
						<label class="l-18">Create a Talent Profile</label>
						 <br>
						 <p>Select one option to build your profile: either upload your CV for quick setup or manually enter details for a personalized experience.</p>
					</div>
					<hr>
					<div class="row">
						<div class="col-lg-6">
							<div class="cvopt">
									<h5>Upload CV</h5>
									<p>Upload your CV for instant profile creation by extracting key details like work experience, education, and skills.</p>
									<a href="cvextract"><button class="bton btn1 w-100">Create a Profile</button></a>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="cvopt">
									<h5>Create profile manually</h5>
									<p>Manually enter your details to fully control and personalize your profile, creating a custom and detailed setup from scratch.</p>
									<a href="create-profile"><button class="bton btn2 w-100">Create a Profile</button></a>
							</div>
						</div>
					</div>
		</div>
	</div>
</div>
</div>
<script type="text/javascript">
	function getFileData(myFile){
   var file = myFile.files[0];  
   var filename = file.name;
   document.getElementById('filename').innerHTML = filename;

   var xhr = new XMLHttpRequest();
        var progressBar = document.getElementById('progressBar');

        xhr.upload.addEventListener('progress', function(event) {
          if (event.lengthComputable) {
            var percentComplete = (event.loaded / event.total) * 100;
            progressBar.style.width = percentComplete + '%';
          }
        });
         xhr.open('POST', 'upload', true);
        var formData = new FormData();
        formData.append('file', file);
        xhr.send(formData);
 }
 function getFileData1(myFile){
   var file = myFile.files[0];  
   var filename = file.name;
   document.getElementById('filename1').innerHTML = filename;
   var xhr = new XMLHttpRequest();
        var progressBar2 = document.getElementById('progressBar2');

        xhr.upload.addEventListener('progress', function(event) {
          if (event.lengthComputable) {
            var percentComplete = (event.loaded / event.total) * 100;
            progressBar2.style.width = percentComplete + '%';
          }
        });
         xhr.open('POST', 'upload', true);
        var formData = new FormData();
        formData.append('file', file);
        xhr.send(formData);
 }
</script>
</body>
</html>
