<?php
session_start();
include "include/connect.php";
include "include/functions.php";
$corp = new Corporate($db);
include 'include/corp_auth.php';
$candidate->setCandidate($_GET['id']);
$num = "";
$num = $_GET['num'];
$candidate->address();
$candidate->getCvData();
$corp->getSubscription();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

<title><?php echo $corp->getHidden($candidate->getCandSurname()).' '.$corp->getHidden($candidate->getCandName()); ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@100;200;400;500;600;700;800;900&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400&display=swap" rel="stylesheet">

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
<?php
include "userHeader.php";
?>
<div class="talent-blue-header">
	<div class="prof-container">
		
		<div class="row">
			<div class="col-lg-4">
				<div class="white-container">
					<div class="profile-info">
						<label class="candnum" style="margin-left:-15px;font-size: 14px"><?php echo '#'.$num; ?></label>
						<div class="personal-info">
							<div><?php
							if($corp->getPackPrice() == 0)
							{
									?>
							<label class="l-14 pp-ini"><?php echo $corp->getHidden(substr($candidate->getCandName(), 0,1).substr($candidate->getCandSurname(), 0,1)); ?></label>
							<?php	

							}
							else if(!empty($candidate->getPP()))
							{
								?>
							<img src="http://talent.viconetgroup.com/img/<?php echo $candidate->getPP() ?>" class="prof-pic">
							<?php
							}
							else{
								?>
								<label class="l-14 pp-ini"><?php echo substr($candidate->getCandName(), 0,1).substr($candidate->getCandSurname(), 0,1); ?></label>
								<?php
							}
							?></div>
							<p class="l-18"><?php echo $corp->getHidden($candidate->getCandName()).' '.$corp->getHidden($candidate->getCandSurname()); ?></p>
							
							<p class="p-14-n"><?php echo $candidate->getCandDOB() ?></p>
							<p class="p-14-n">Gender : <?php echo $candidate->getGender() ?></p>
							<p class="p-14-n">Race : <?php echo $candidate->getRace() ?></p>
					
							<p class="p-14-n"><?php echo $corp->getHidden($candidate->getCandCell()) ?></p>
							
							<p class="p-14-n"><?php echo $corp->getHidden($candidate->getCandEmail()) ?></p>
							<label class="l-14">Address</label>
							<?php 
							if($corp->getPackPrice()== 0)
							{
								?>
							<p class="p-14-n"><?php echo substr($corp->getHidden($candidate->getAddress()),0,32) ?></p>
							<?php
								}
								else{
									?>
							<p class="p-14-n"><?php echo substr($corp->getHidden($candidate->getAddress()),0,100) ?></p>
							<?php
								}
								?>
							<p class="p-14-n"><?php echo $corp->getHidden($candidate->getCity()) ?></p>
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
						<?php if($corp->getPackPrice() != 0)
				{
					if(empty($candidate->getPdfCV()))
					{
					?>						
						<div class="person-frame" style="background: #7878DA;display: flex;">
							<div>
								<img src="img/pdf2.svg">
							</div>
							<div class=""><label class="l-18-n text-white" for="pdf_cv" style="margin: 10px 10px">No CV uploaded</label></div>
							
						</div>						
					<?php
					}
					else
					{
						?>
						<a href="https://talent.viconetgroup.com/cv/<?php echo $candidate->getPdfCV() ?>" target="_blank" id="pdf_cv">
						<div class="person-frame" style="background: #7878DA;display: flex;">
							<div>
								<img src="img/pdf2.svg">
							</div>
							<div class=""><label class="l-18-n text-white" for="pdf_cv" style="margin: 10px 10px">Download CV</label></div>
							
						</div>
						</a>
						<?php
					}
							}
							?>					
						<hr>
						<form method="post" id="myForm">
							<input type="hidden" name="c_email" value="<?php echo $candidate->getCandEmail() ?>">
							<input type="hidden" name="cand_num" value="<?php echo $num ?>"><?php if($corp->checkCandidateAdded($candidate->getCandEmail())>0){
								?>
								<button class="bton btn2" type="button" disabled style="width:100%">shortlisted</button>
								<?php
								}
								else{
									?>
									<button class="bton btn2" type="button" id="shortlist_cand" style="width:100%">Add to shortlist</button>
									<?php
								}
								?>						

					</form>
					</div>
				</div>
			</div>
		<div class="col-lg-8">
				<div class="corp-edit">
						
				<div class="row">
						<div class="col-lg-12">
							<div class="d-flex">
								<div>
									<div class="rounddiv">
										<img src="img/about-icon.svg">
									</div>
								</div>
								<div class="d-block">
									<label class="l-18-n">About <?php echo ' '.$corp->getHidden($candidate->getCandName()).' '.$corp->getHidden($candidate->getCandSurname()); ?></label>
									<p class="p-14-n"><?php echo $candidate->getBio() ?></p>
								</div>
							</div>
							<hr>
						</div>
					<div class="col-lg-12">					
					<div class="d-flex">
						<div>
								<div class="rounddiv">
										<img src="img/roles.svg">
								</div>
							</div>
						<div class="d-block">
							<label class="l-18-n">CURRENT ROLE & RESPONSIBILITY</label>
							<?php 
						 	$candidate->getCurrentJob();
						?>
						<p class="p-14-n">Company Name : <?php echo $candidate->getCurCompName() ?> </p>
						<p class="p-14-n">Job Title : <?php echo $candidate->getCurJobTitle() ?> </p>
						<p class="p-14-n">Starting Date : <?php echo $candidate->getCurStartDate()?> </p>
						<div class="d-flex flex-row justify-content-between">
							<span ><p>Key Roles :</p></span>							
						</div>
						<div style="margin-top:-10px;">
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
							</div>
						</div>
					</div>
						<hr>
					</div>
					<div class="col-lg-12">
						<div class="d-flex">						
								<div class="rounddiv">
										<img src="img/p-w-e-b.svg">
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
							<div class="rounddiv">
										<img src="img/exp-blue.svg">
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
								<div class="rounddiv">
										<img src="img/edu-blue.svg">
								</div>
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
										<div><div class="bullet mt-1"></div></div>
											<p class="p-14-n"><strong>Institute : </strong><?php echo $rows['institution_name']?></p>										
									</div>
									<div class="d-flex">
										<div><div class="bullet mt-1"></div></div>
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
								<div class="rounddiv">
										<img src="img/key-course-blue.svg">
								</div>
							</div>
							<div class="d-block">
								<label class="l-18-n">KEY COURSES</label>
								<?php 
								$query = $candidate->getKeyCourses();
								for($x=0; $rows=$query->fetch();$x++){
								?>	
								<div class="d-flex">	
								<div><div class="bullet"></div></div>		
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
								<div class="rounddiv">
										<img src="img/skills-blue.svg">
								</div>
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
					<?php 
					if(!empty($candidate->getVideoCV()) && $corp->getPackPrice() != 0)
					{
						?>
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
						<video width="100%" controls>
					  <source src="https://talent.viconetgroup.com/video cv/<?php echo $candidate->getVideoCV() ?>">
					</video>
					</div>
					<?php
					}
					?>
				
				</div>
	
			</div>
			
			</div>
		</div>

	</div>
</div>

<!--Modal-->
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
<script type="text/javascript" src="js/shortlist.js"></script>
<script type="text/javascript" src="js/delete.js"></script>
</html>