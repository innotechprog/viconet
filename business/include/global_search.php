<?php
session_start();
include "include/connect.php";
include "include/functions.php";
include 'include/corp_auth.php';
$count = 0;
$corp->getSubscription();
$rem_cand = ($corp->getPackNumCand()- $corp->numOfShortlistedCand());
?>
<div style="display: flex;justify-content: space-between;">
<!--Do not remove--><label></label><!---->
<label class="p-18"><label id="numRows"></label></label>
</div>
<div class="row candidatess">
<?php

if(isset($_POST['search_field'])){
	$method = "";	
	$search="";
	if(isset($_POST['wmethod'])){
	foreach ($_POST['wmethod'] as $key => $value) {
		$method = $method.','.$value;
	}
	$search = $_POST['search_field'].$method;
}
else{
	$search = $_POST['search_field'];
}}
//$location = $_POST['loc'];
if(empty($search)) 
{
echo "<div class='col-lg-12'><label style='font-size:34px'>No result found </label></div>";	
}
else if($search == "div" || $search == "p") 
{
echo "<div class='col-lg-12'><label style='font-size:34px'>No result found2 </label></div>";	
}
else if(!empty($search))
{
	//echo $location;
	?>

<?php 
	$query = $candidate->getAllCandidates();
	$numOfShortlistedCand =$corp->numOfShortlistedCand();
	for($i = 0; $rows = $query->fetch();$i++)
	{ 	
		$roles = "";
		$skills = "";
		$courses ="";
		$result = "";
		$experience="";
		$qualification="";
		$location="";
		$names = "";
		//
		$email = md5($rows['c_email']);
		$candidate->setCandidate($email);
		$candidate->getCurrentJob();
		$candidate->address();
		$roles = $candidate->getCombinedRoles($email);
		$skills = $candidate->getCombinedSkills($email);
		$courses = $candidate->getCombinedCourses($email);
		$experience =$candidate->getCombinedExperience($email);
		$qualification =$candidate->getCombinedQualification($email);
		$location = $candidate->getCombinedLocation($email);
		$names = $candidate->getCombinedNames($email);
		$names_ = $candidate->getCombinedNames_($email);
		//$workMethod = $candidate->getCombinedCV($email);
		$result = $result.$roles.','.$skills.','.$courses.','.$experience.','.$qualification.','.$location.','.$names.','.$names_;
		if($candidate->globalSearch($search,$result)== true)
		{
			$count = $count + 1;
			?>			
			<div class="col-lg-6 box">
				
					<div class="person-frame2">
						<div class="rw1">
							<div class="d-flex justify-content-between">
								<label class="candnum"><?php echo '#'.$count ?></label>
								<?php if($corp->checkCandidateAdded($candidate->getCandEmail())>0){
								?>
								<button class="addcanddis" title="Already shortlisted" id="<?php echo $candidate->getCandID() ?>" disabled>
										Shortlisted
									</button>
								<?php
								}
								else{
									?>
									<button class="bton btn4 addcand" title="Click to shortlist" data_id="<?php echo $count ?>" id="<?php echo $candidate->getCandID() ?>">
										Shortlist
									</button>
									<?php
								}
								?>	
								
							</div>
							<a href="view-profile?id=<?php echo $email ?>&num=<?php echo $count ?>" target="_blank">
							<div class="toprow">							
								<div class="prof-img">
									<?php 
									if(empty($candidate->getPP()) || $corp->getPackPrice() == 0)
									{
									?>
									<img src="img/user.svg">
									<?php
									}
									else{
									?>						
									<img src="img/<?php echo $candidate->getPP() ?>">
									<?php
									}
									?>
								</div>	
								<div class="prof-det pers-det">
									<label class="l-14 text-black"><?php echo $corp->getHidden($candidate->getCandName()).' '.$corp->getHidden($candidate->getCandSurname()); ?></label>
									<p class="p-12"style="margin-top: -7px;"><?php echo $candidate->getCurJobTitle() ?></p>
									<div class="d-flex flex-row justify-content-between">
										<p class="p-12"style="margin-top: -15px;"><?php echo $candidate->getCountry() ?></p>
										<div style="margin-top: -17px;">
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
										</div>
									</div>
								</div>
							</div>
							<div class="abtcand">
								<div class="blog-flex">
									<div>
										<label class="roundfrm"><img src="img/skills-blue.svg"></label>
									</div>
									<div class="ml-2"><label class="l-12">SKills</label>
										<div style="margin-left:13px;margin-right: 13px;">
											<div class="row" >
												<?php $skill = explode(',', $skills);
												foreach ($skill as $value) {
													?>
												 	<p class="p-12 skillfrm"><?php echo $value;?></p>
												 	<?php 
												 } ?>
											</div>
										</div>
									</div>	
								</div>
								<hr>
								<div class="blog-flex">
									<div>
										<label class="roundfrm"><img src="img/roles.svg"></label>
									</div>
									<div class="ml-2"><label class="l-12">Roles</label>
										<div class="blog-flex roleslim">						
										 	<p class="p-12"><?php echo $roles;?>							 		
										 	</p>								 	
										</div>
									</div>	
								</div>
								<hr>
								<div class="blog-flex">
									<div>
										<label class="roundfrm"><img src="img/edu-blue.svg"></label>
									</div>
									<div class="ml-2"><label class="l-12">Qualifications</label>
										<div class="blog-flex mb-3">
											 	<p class="p-12"><?php echo $qualification;?></p>
										</div>
									</div>	
								</div>
							</div>
							</a>
						</div>						
					</div>
					
			<?php
		}
		
	}
	if($count == 0){
		echo "<div class='col-lg-12'><label style='font-size:34px'>No result found </label></div>";
	}
}
?>
  	
</div>
 <div id="pagin">
 </div>
<script type="text/javascript">
	//paginationButtons.render();
</script>

	 <script type="text/javascript">
	 numRow = <?php echo $count ?>;

	 document.getElementById("numRows").innerHTML = 'Search Result ('+numRow+')';
 </script>

 <script type="text/javascript">
 $(function() {
$(".addcand").click(function(){
// get current value of basket
let numCandSelected = parseInt(document.getElementById("num_candidates").textContent) + 1;
$('#num_candidates').html(numCandSelected);
//Save the link in a variable called element
var element = $(this);
//Find the id of the link that was clicked
var cand_id = element.attr("id");
var cand_num = element.attr("data_id");
//var table = "candidate_tbl";
//var field = "c_id";
//Built a url to send
var info = 'cand_id=' + cand_id +'&cand_num='+cand_num;
document.getElementById(cand_id).disabled = true;
$('#'+cand_id).html('shortlisted');

$(cand_id).click(false);
$.ajax({
type: "GET",
url: "shortlist.php",
data: info,
success: function(){
}
});

});
});
  </script>
<script>
	
</script>