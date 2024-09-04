<?php
session_start();
include "include/connect.php";
include "include/functions.php";
$corp = new Corporate($db);
$candidate = new Candidates($db);
$candidate->setCandidate($_GET['id']);
$num = "";
$candidate->address();
$candidate->getCvData();
$corp->getSubscription();
if(isset($_POST['add_cv'])){
	if(isset($_FILES['long_cv']))
	{
	//$candidate->a >ddCv($_FILES['upload_short_cv']);
	

		$file_array = $_FILES['long_cv'];
		
			if($file_array['error'])
			{
				?> <div class ="alert alert-danger">
				<?php echo $file_array['name']. ' - '.$phpFileUPloadErrors[$file_array['error']];?>
				</div>
				<?php
			}
			else{
				$allow = array('pdf');
				$fileExt = explode('.',$file_array['name']);
				$fileActualExt = strtolower(end($fileExt));
				if(!in_array($fileActualExt, $allow))
				{
					?> <div class ="alert alert-danger">
				<?php echo "{$file_array['name']} -invalid file extension"?>
				</div>
				<?php
				}
				else
				{
					move_uploaded_file($file_array['tmp_name'] ,'cv/'.$file_array['name']);
					?> <div class ="alert alert-danger">
					<?php echo $file_array['name']. ' - '.$phpFileUPloadErrors[$file_array['error']];
					
					?>
					</div>
					<?php  
					
				}
			}
		}
		$fileName =$file_array['name'];
		$email = md5($candidate->getCandEmail());
		$sql = $db->prepare("UPDATE `curriculum_vitae` SET `cv_file`='$fileName' WHERE c_email = '$email'");
		$sql->execute();
		?>
	<script> window.location = "c_p?id=<?php echo $email ?>"; </script>
	<?php
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">


 <meta content="" name="description">
<meta content="" name="keywords">

<!-- Favicons -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@100;200;400;500;600;700;800;900&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400&display=swap" rel="stylesheet">

<link rel="icon" href="img/small-logo.png" type="image/x-icon">
<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

<!-- Google Fonts -->
<!-- Vendor CSS Files -->
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="vendor/icofont/icofont.min.css" rel="stylesheet">
<link href="vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
<link href="vendor/venobox/venobox.css" rel="stylesheet">
<link href="vendor/animate.css/animate.min.css" rel="stylesheet">
<link href="vendor/remixicon/remixicon.css" rel="stylesheet">
<link href="vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
<link href="vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
<script src="js/jquery-3.4.1.min.js"></script>
<!-- Template Main CSS File -->
<link href="css/style.css" rel="stylesheet">
<link rel="stylesheet" href="build/css/intlTelInput.css">

</head>

<body class="body-b">

<div class="talent-blue-header">
	<div class="prof-container">		
		<div class="row">
			<div class="col-lg-4">
				<div class="white-container">
					<div class="profile-info">
						
						<div class="personal-info">
							<div><?php
							if($corp->getPackPrice() == 0)
							{
									?>
							<label class="l-14 pp-ini"><?php echo substr($candidate->getCandName(), 0,1).substr($candidate->getCandSurname(), 0,1); ?></label>
							<?php	

							}
							else if(!empty($candidate->getPP()))
							{
								?>
							<img src="img/<?php echo $candidate->getPP() ?>" class="prof-pic">
							<?php
							}
							else{
								?>
								<label class="l-14 pp-ini"><?php echo substr($candidate->getCandName(), 0,1).substr($candidate->getCandSurname(), 0,1); ?></label>
								<?php
							}
							?></div>
							<p class="l-18"><?php echo $candidate->getCandName().' '.$candidate->getCandSurname(); ?></p>
							
							<p class="p-14-n"><?php echo $candidate->getCandDOB() ?></p>
					
							<p class="p-14-n"><?php echo $candidate->getCandCell() ?></p>
							
							<p class="p-14-n"><?php echo $candidate->getCandEmail() ?></p>
							<label class="l-14">Address</label>
							<p class="p-14-n"><?php echo $candidate->getAddress() ?></p>
							<p class="p-14-n"><?php echo $candidate->getCity() ?></p>
							<p class="p-14-n"><?php echo $candidate->getState() ?></p>
							<p class="p-14-n"><?php echo $candidate->getCountry() ?></p>
						</div>
						<div class="d-row" style="text-align: center!important;align-content: center;">
								<?php
										$candidate->getCvData();
										$methods = $candidate->getWorkMethods();
										$methods = explode(',',$methods);
										foreach($methods as $method){
											if($method == "remote"){
												?>
											<label class="wtype">Remote</label>
											<?php
											}
											elseif ($method == "part") {
												?>
											<label class="wtype">Part time</label>
											<?php
											}	
											elseif ($method == "full") {
												?>
											<label class="wtype">Full time</label>
											<?php
											}									
										}
										?>
						</div>
					
						<div class="person-frame d-flex" style="background: #8888d8">
							<div>
								<a href="cv/<?php echo $candidate->getPdfCV() ?>"><img src="img/file-upload.svg"></a>
							</div>
							<div class=""><label class="l-18-n text-white" style="margin: 10px 10px">Upload CV</label></div>
							<div class="edit-tab2"  style="margin-right:15px">
								<a href="#" class="modal-open" id="up-cv"><img src="img/edit-text.svg" class="" ></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		<div class="col-lg-8">
				<div class="corp-edit">
						
				<div class="row">
						<div class="col-lg-12">
							<div class="d-flex">
								<div>
									<label class="rounddiv">
										<img src="img/about-icon.svg">
									</label>
								</div>
								<div class="d-block">
									<label class="l-18-n">About <?php echo $candidate->getCandName().' '.$candidate->getCandSurname(); ?></label>
									<p class="p-14-n"><?php echo $candidate->getBio() ?></p>
								</div>
							</div>
							<hr>
						</div>
					<div class="col-lg-12">					
					<div class="d-flex">
						<div>
								<label class="rounddiv">
										<img src="img/roles.svg">
								</label>
							</div>
						<div class="d-block">
							<label class="l-18-n">CURRENT ROLE & RESPONSIBITY</label>
							<?php 
						 	$candidate->getCurrentJob();
						?>
						<p class="p-14-n">Company Name : <?php echo $candidate->getCurCompName() ?> </p>
						<p class="p-14-n">Job Title : <?php echo $candidate->getCurJobTitle() ?> </p>
						<p class="p-14-n">Starting Date : <?php echo $candidate->getCurStartDate()?> </p>

						<div class="d-flex flex-row justify-content-between">
							<span ><p>Key Roles :</p></span>							
						</div>
						<p style="margin-top:-20px;">
							<?php 
							$query = $candidate->getRole();
							for($i=0;$row2=$query->fetch();$i++){
								$idd = 'id'.$i;
								?>
								<div class="d-flex record user_roles">									
										<div class="bullet" style="margin-top: 10px;"></div><label><?php echo $row2['role'] ?></label>										
								</div>
								<?php
							}
							?>
							</p>
						</div>
					</div>
						<hr>
					</div>
					<div class="col-lg-12">
						<div class="d-flex">
							<div>
								<label class="rounddiv">
										<img src="img/p-w-e-b.svg">
								</label>
							</div>
							<div class="d-block">
								<label class="l-18-n">PREVIOUS WORK EXPERIENCE</label>	
								<?php
								$query = $candidate->getExperiences();
								for($i=0;$rows=$query->fetch();$i++){
									?>								
								<div class="record">												
									<div class="lft-text"><p class="p-14-n"><?php echo $rows['company_name'].' - '.$rows['job_title'].' - '.$rows['starting_date'].' - '.$rows['end_date']; ?> </p>
									</div>					
								</div>
								<?php 
									}
								?>												
							</div>						
						</div>
						<hr>
					</div>
					<div class="col-lg-12">
						<div class="d-flex">
							<div>
								<label class="rounddiv">
										<img src="img/exp-blue.svg">
								</label>
							</div>
							<div class="d-block">
								<label class="l-18-n">YEARS OF EXPERIENCE</label>
								<p class="p-14-n"><?php echo $candidate->getYearsExperience() ?></p>
							</div>						
						</div>
						<hr>
					</div>
					<div class="col-lg-12">
						<div class="d-flex">
							<div>
								<label class="rounddiv">
										<img src="img/edu-blue.svg">
								</label>
							</div>
							<div class="d-block">
								<label class="l-18-n">EDUCATION</label>
								<?php 
								$query = $candidate->getQualifications();
								for($x=0; $rows=$query->fetch();$x++){
								?>
								<div>
									<label class="p-14"><?php echo $rows['q_name'] ?></label>
									<div class="d-flex">
										<div class="bullet mt-1"></div>
											<p class="p-14-n"><strong>Institute : </strong><?php echo $rows['institution_name']?></p>										
									</div>
									<div class="d-flex">
										<div class="bullet mt-1"></div>
										<p class="p-14-n"><strong>Year completed : </strong><?php echo $rows['qw_date_completed']?></p>
									</div>	
								</div>								
								<?php
									}
								?>
							</div>	
						</div>
						<hr>
					</div>
					<div class="col-lg-12">
						<div class="d-flex">
							<div>
								<label class="rounddiv">
										<img src="img/key-course-blue.svg">
								</label>
							</div>
							<div class="d-block">
								<label class="l-18-n">KEY COURSES</label>
								<?php 
								$query = $candidate->getKeyCourses();
								for($x=0; $rows=$query->fetch();$x++){
								?>	
								<div class="d-flex">	
								<div class="bullet"></div>		
									<div class="lft-text"><p class="move-up p-14-n"><?php echo $rows['key_course'] ?></p></div>
									
								</div>
								<?php
									}
								?>
							</div>						
						</div>						
					</div>
					<div class="col-lg-12">
						<div class="d-flex">
							<div>
								<label class="rounddiv">
										<img src="img/skills-blue.svg">
								</label>
							</div>
							<div class="d-block">
								<label class="l-18-n">KEY SKILLS	</label>
								<div class="s-around">
									<div class="row">
										<?php 
										$query = $candidate->getKeySkills();
										for($x=0; $rows=$query->fetch();$x++){
										?>										
										<p class="move-up p-14-n skillfrm"><?php echo $rows['skill'] ?></p>
										<?php
											}
										?>
									</div>
								</div>							
							</div>				
						</div>
					</div>
					<div class="col-lg-12">
						<div class="d-flex">
							<div>
								<label class="rounddiv">
										<img src="img/play-blue.svg">
								</label>
							</div>
							<div class="d-block">
								<label class="l-18-n">Introduction Video</label>
							</div>
						</div>
					</div>
				
				</div>
			</div>
			</div>
		</div>

	</div>
</div>

<!--Modal-->
<?php
include "modals.php";
?>

</body>
<!-- Javascripts -->
<script type="text/javascript">
	function getFileData(myFile){
   var file = myFile.files[0];  
   var filename = file.name;
   document.getElementById('filename').innerHTML = filename;
 }
</script>
<script type="text/javascript" src="js/toggle.js"></script>
<script type="text/javascript" src="js/button_click.js"></script>
<script type="text/javascript" src="js/delete.js"></script>
<script type="text/javascript" src="js/edit-boxes.js"></script>
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
	
$(document).ready(function(){
  $('.close').click(function(){
          $('#modal11').hide();
             
    });
  });
</script>
</html>