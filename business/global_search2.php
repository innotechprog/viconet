<?php
session_start();
include "include/connect.php";
include "include/functions.php";
include 'include/corp_auth.php';
$count = 0;
include "include/website_class.php";
$web = new Website($db); //Website class
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
	$rec_id = $_POST['rec_id'];
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
	$query = $candidate->globalSearchAll2($search);
	$numOfShortlistedCand =$corp->numOfShortlistedCand();
	foreach ($query as $c_email)
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
		$email = "";
		$email = $c_email;
		$candidate->setCandidate($email);
		$candidate->getCurrentJob();
		$candidate->address();
		$roles = $candidate->getCombinedRoles($email);
		$skills = $candidate->getCombinedSkills($email);
		$courses = $candidate->getCombinedCourses($email);
		$experience =$candidate->getCombinedExperience($email);
		$qualification =$candidate->getCombinedQualification($email);
		$location = $candidate->getCombinedLocation($email);
		/*$names = $candidate->getCombinedNames($email);
		$names_ = $candidate->getCombinedNames_($email);
		$names__ = $candidate->getCombinedNames__($email);
		//$workMethod = $candidate->getCombinedCV($email);
		$result = $result.$roles.','.$skills.','.$courses.','.$experience.','.$qualification.','.$location.','.$names.','.$names_.','.$names__;
		if($candidate->globalSearch($search,$result)== true)
		{*/
			$count = $count + 1;
			?>			
			<div class="col-lg-6 box">
				
					<div class="person-frame2">
						<div class="rw1">
							<div class="d-flex justify-content-between">
								<label class="candnum"><?php echo '#'.$count ?></label>
								<?php if($corp->checkCandAddInProj($candidate->getCandEmail(),$rec_id)>0){
									?>
								<button class="bton btn4 addcand text-white" title="De shortlist"  style="background:#e4186d;" value="deshortlist" id="<?php echo $candidate->getCandID() ?>">
										Shortlisted
									</button>
								<?php
								}
								else{
									?>
									<button class="bton btn4 addcand addcand1 text-white" value="shortlist" style="background:#27276C;" title="" data_id="<?php echo $count ?>" id="<?php echo $candidate->getCandID() ?>">
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
									<img src="https://<?php echo $web->getWebLinkExt() ?>talent.viconetgroup.com/img/<?php echo $candidate->getPP() ?>">
									<?php
									}
									?>
								</div>	
								<div class="prof-det pers-det">
									<label class="l-14 text-black"><?php echo $corp->getHidden($candidate->getCandName()).' '.$corp->getHidden($candidate->getCandSurname()); ?></label>
									<p class="p-12"style="margin-top: -7px;">Current role: <?php if(!empty($candidate->getCurJobTitle())){ echo $candidate->getCurJobTitle();}else{ echo "None";} ?></p>
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
									<div class="ml-2"><label class="l-12">Skills</label>
										<div style="margin-left:13px;margin-right: 13px;">
											<div class="oneline-limit" >
												<?php $skill = explode(',', $skills);
												foreach ($skill as $value) {
													?>
												 	<label class="p-12 skillfrm"><?php echo $value;?></label>
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
										 	<label class="p-12 oneline-limit"><?php echo $roles;?></label>								 	
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
 	let numCandSelected=0;
$(".addcand").click(function(){
// get current value of basket
	var btnValue = $(this).attr("value");
	if(btnValue == "shortlist"){
	numCandSelected = parseInt(document.getElementById("candAdded").textContent) + 1;
$('#candAdded').html(numCandSelected);
//Save the link in a variable called element
var element = $(this);
//Find the id of the link that was clicked
var cand_id = element.attr("id");
var cand_num = element.attr("data_id");
//var table = "candidate_tbl";
//var field = "c_id";
//Built a url to send
var info = 'cand_id2=' + cand_id +'&cand_num='+cand_num;
document.getElementById(cand_id).disabled = false;
$('#'+cand_id).css("background-color","#e4186d");
$('#'+cand_id).html('Shortlisted');
$('#'+cand_id).val('deshortlist');

$(cand_id).click(false);
$.ajax({
type: "GET", 
url: "shortlist.php",
data: info,
success: function(){
}
});
}
else if(btnValue =="deshortlist"){
numCandSelected = parseInt(document.getElementById("candAdded").textContent) - 1;
$('#candAdded').html(numCandSelected);

//Save the link in a variable called element
var element = $(this);
//Find the id of the link that was clicked
var cand_id = element.attr("id");
var cand_num = element.attr("data_id");
//var table = "candidate_tbl";
//var field = "c_id";
//Built a url to send

$('#'+cand_id).html('Shortlist');
$('#'+cand_id).val('shortlist');
$('#'+cand_id).css("background-color","#27276C");
$('#'+cand_id).css("color","white");
//element.value('shortlist');

var del_id = cand_id;
var table = "basket";
var field = "id";
var candi = 'candi';
var info = 'id=' + del_id +'&candiDate='+candi;
   $.ajax({
     type: "GET",
     url: "delete.php",
     data: info,
     success: function(){

     }
 });
}


});
});
  </script>