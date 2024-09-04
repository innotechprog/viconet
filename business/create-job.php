<?php
session_start();
include "include/connect.php";
include "include/functions.php";
include "include/corp_auth.php";
include "include/jobs_class.php";
$jobs = new Jobs($db);
?>
<!DOCTYPE html>
<html lang="en">	
<?php
include "head.php";  
?>
<body class="body-b">
<?php
include "userHeader.php";
$x = 1;
$i=1;
?>
<div class="talent-blue-header add-h">
	<div class="prof-container">
		<label class="l-24 text-white mb-4">Create a job</label>
		<div class="row">
			<div class="col-lg-12">
			<div class="white-container">
				<form method="post" action="save_job" enctype="multipart/form-data">
					<div class="row">
						<div class="col-lg-8">
						<div class="row">
						<div class="col-lg-6 form-group">
							<label class="input-label">Company name</label><label>*</label>
							<input type="text" name="compName" required  class="cust-input" placeholder="Enter Company Name">
						</div>
						<div class="col-lg-6 form-group">
							<label class="input-label">Company Email</label><label>*</label></label>
							<input type="email" name="compEmail" required  class="cust-input" placeholder="Enter Company Email">
						</div>
						
						<div class="col-lg-6 form-group">
							<label class="input-label">Company Telephone</label><label>*</label>
							<input type="text" name="compTel" required  class="cust-input" placeholder="Enter Company Telephone">
						</div>	
						<div class="col-lg-6 form-group">
							<label class="input-label" title="">Industry</label><label>*</label>
							<select name="industry" id="options" onchange="toggleInput('options')" required class="cust-input">
								<option value="">Select Industry</option>
								<?php 
								$query = $corp->getAllIndustries();
								for ($i=0; $rows = $query->fetch() ; $i++) { ?>
									<option value="<?php echo $rows['industry'] ?>"><?php echo $rows['industry'] ?></option>
									<?php
								}
								?>
								<option value="other">Other</option>							
							</select>
							<div id="otherInput" style="display: none;">
							    <label for="other" class="input-label">Please specify:</label>
							    <input type="text" id="other" class="cust-input" name="otherIndustry">
							  </div>
						</div>
						</div>	
						</div>
						<div class="col-lg-4 text-center"> 
						<label class="input-label">Company Logo</label>	
						<div>							
								<label class="complogoup" for="p_pic"><label class="logotext" for="p_pic" style="color:#000" id="user_ini">Upload Logo</label><img class="" id="display_image" src="<?php if(empty($jobs->getCompLogo())){}
									else{echo 'img/'.$jobs->getCompLogo();
									}?>">
								</label>			            
			                <input type="hidden" name="idss" value="updateLogo" class="cust-input ">
                              <input type="hidden" name="sid" value="<?php echo $corp->getCompReg() ?>">
                              
			                <input type="file" class="form-control" id="p_pic" accept="image/*" onchange="loadFile(event)" name="logo"/>
			            </div>
		              
					</div>
				</div>
					<hr>
					<div class="row">
						<div class="col-lg-4 form-group">
							<label class="input-label">Job Title</label><label>*</label>
							<input type="text" required  name="jobTitle" class="cust-input" placeholder="Enter job title">
						</div>
						<div class="col-lg-4 form-group">
							<label class="input-label">Position Type</label><label>*</label>
							<select name="postType" required class="cust-input">
								<option value="">Select Post Type</option>
								<option value="permanent">Permanent</option>
								<option value="Temporary Worker">Temporary Worker</option>
								<option value="Fixed Term Contract">Fixed Term Contract</option>
								<option value=" Independent Contract">Independent Contract</option>
								<option value="Part Time Worker">Part Time Worker</option>
								<option value="Consultant">Consultant </option>
								<option value="Other">Other</option>
							</select>
						</div>
						<div class="col-lg-4 form-group">
							<label class="input-label">Manager Job Title</label><label>*</label>
							<input type="text" required name="reportTo" class="cust-input" placeholder="Position Reporting To">
						</div>
						<div class="col-lg-12 form-group mt-4">
					<label class="input-label">Job Purpose</label><label>*</label>
					<textarea name="jobIntro" required  class="cust-input"  style="height:100px" placeholder="Enter Job Purpose"></textarea>
				</div>
					<div class="col-lg-12 form-group">
					<label class="input-label">Key Role Responsibilities</label><label>*</label>
					<textarea name="jobDesc" class="cust-input" style="height:100px" placeholder="Enter job description"></textarea>
				</div>
				<div class="col-lg-12 form-group">
					<table id="dynamic_tbl">
						<thead>
							<tr>
								<th width="100%" class="input-label">Required Skills</th>
								<th class="" title="Remove">Remove</th>
							</tr>
						</thead>
						<tbody>
							<tr id="row<?php echo $i ?>">
								<td><input type="text" required name="requirement[]" id="" class="cust-input" placeholder="Enter required skill"></td>
								<td><div name="remove" id="<?php echo $i ?>" class=" btn_remove" ><img src="img/Subtract.svg" class="dele-btn"></div></td>
							</tr>
						</tbody>
					</table>
					<br>
					<button id="add" type="button" class="addbton btn2"><img title="Add More Fields" img src="img/addw.svg" style="color:#fff">Add more</button>
				</div>
						<div class="col-lg-4 form-group">
							<label class="input-label"> Required Qualifications</label><label>*</label>
							<select name="qualification" required class="cust-input">
								<option value="">Select Qualification</option>
								<option value="Higher certificate">Higher certificate</option>
								<option value="National diploma">National diploma</option>
								<option value="Advanced diploma">Advanced diploma</option>
								<option value="Bachelors degree">Bachelors degree </option>
								<option value="Honours degree">Honours degree</option>
								<option value="Masters degree">Masters degree</option>
								<option value="Doctoral degree">Doctoral degree</option>
							</select>
						</div>
						<div class="col-lg-4 form-group">
							<label class="input-label">Minimum job experience</label><label>*</label>
							<select name="exp" required class="cust-input">
								<option value="">Select Minimum job experience</option>
								<option value="0-2 years">0-2 years</option>
								<option value="3-5 years">3-5 years</option>
								<option value="6-8 years">6-8 years</option>
								<option value="9-10 years">9-10 years</option>
								<option value="11-15 years">11-15 years</option>
								<option value="16-20 years">16-20 years</option>
								<option value="21+">21+</option>			
							</select>
						</div>
				
					<div class="col-lg-4 form-group">
							<label class="input-label">Position Level</label><label>*</label>
							<select name="postLevel" required class="cust-input">
								<option value="">Select Position Level</option>
								<option value="Trainee">Trainee</option>
								<option value="Graduate">Graduate</option>
								<option value="Professional">Professional</option>
								<option value="Supervisory">Supervisory</option>
								<option value="Specialist">Specialist</option>
								<option value="Management">Management</option>
								<option value="Senior Management">Senior Management</option>
								<option value="Executive">Executive</option>
								<option value="Board">Board</option>
								<option value="Staff">Staff</option>		
							</select>
						</div>
					
						<div class="col-lg-4 form-group">
							<label class="input-label">Position Location</label><label>*</label>
							<input type="text" name="compAddress" id="search_location" required class="cust-input" placeholder="Enter Position location">
						</div>
						
						<div class="col-lg-4 form-group">
							<label class="input-label">Work Method</label><label>*</label>
							<select name="wMethod" required class="cust-input">
								<option value="">Select Work Method</option>
								<option value="office">Office Based</option>
								<option value="remote">Remote</option>
								<option value="hybrid">Hybrid</option>
							</select>
						</div>
						<div class="col-lg-4 form-group">
							<label class="input-label">Start Date (Optional)</label>
							<input type="date" name="startDate" class="cust-input " >
						</div>
						<div class="col-lg-4 form-group">
							<label class="input-label">Application Closing Date</label><label>*</label>
							<input type="date" required  name="closingDate" class="cust-input " >
						</div>
						
						
				<div class="col-lg-4 form-group">
					<label class="input-label">Annual Cost To Company (Optional)</label>
					<input name="salary" type="number" class="cust-input" placeholder="Enter annual cost to company">
				</div>
				<div class="col-lg-4 form-group">
				<label class="input-label">Currency (Optional)</label>
				<select name="currency" class="cust-input">
					<option value="">Select Currency</option>
					<?php
					 $query = $jobs->getAllCurrency();
					for($i = 0; $rows=$query->fetch();$i++){
						$jobs->setCurrency($rows['code']);
					?>
					<option value="<?php echo $jobs->getCurrencyCode();?>"><?php echo $jobs->getCurrencyCode(); ?></option>
					<?php
					}
					?>		
				</select>
			</div>
			<div class="col-lg-6 form-group">
				<label class="input-label">Feedback period for unsuccessful applicants</label><label>*</label>
				<select name="period" required class="cust-input" required id="wMethod">
					<option value="">Select Period</option>
					<option value="1 week">1 Week</option>
					<option value="2 weeks">2 Weeks</option>
					<option value="3 weeks">3 Weeks</option>
					<option value="1 month">1 Month</option>
					<option value="2 months">2 Months</option>
					<option value="3 months">3 Months</option>
					<option value="6 months">6 Months</option>
					<option value="1 year">1 Year</option>
				</select>
			</div>
			<div class="col-lg-6 form-group">
				<label class="input-label">Application Link</label>
				<input type="text" name="appLink" class="cust-input" placeholder="Enter Application Link">
			</div>			
			<div class="col-lg-12">
					<p class="p-12">Please note this job will not be published until you save & publish it.</p>
				</div>
				<div class="col-lg-12">
					<div class="d-flex">
						<button class="bton btn2 mr-2 ml-auto" name="saveJob">Save</button>
						<button class="bton btn1 mr-0 " name="publish">Save & publish</button>
					</div>
				</div>
					</div>
				</form>
			</div>
		</div>
		

</body>
<!-- Javascripts -->
<script type="text/javascript">
	function getFileData(myFile){
   var file = myFile.files[0];  
   var filename = file.name;
   document.getElementById('filename').innerHTML = filename;
 }
</script>
<script type="text/javascript">
$(document).ready(function(){
var i="<?php echo $i+1 ?>";
$('#add').click(function(){

	$('#dynamic_tbl').append('<tr id="row'+i+'"><td><input type="text" name="requirement[]" placeholder="Enter required skill" required class="cust-input name_list" style="margin-top:5px;" /></td><td><div name="remove" id="'+i+'" class=" btn_remove" ><img src="img/Subtract.svg" class="dele-btn"></div></td></tr>');
	i++;

});
});
$(document).ready(function(){
var x="<?php echo $x+1 ?>";
$('#add1').click(function(){

	$('#dynamic_tbl1').append('<tr id="row'+x+'"><td><input type="text" name="responsibility[]" placeholder="Enter key role responsibility" required class="cust-input name_list" style="margin-top:5px;" /></td><td><div name="remove" id="'+x+'" class=" btn_remove" ><img src="img/Subtract.svg" class="dele-btn"></div></td></tr>');
	x++;

});	
});
$(document).on('click', '.btn_remove', function(){
		var button_id = $(this).attr("id"); 
		$('#row'+button_id+'').remove();
	});
</script>
<script type="text/javascript" src="js/toggle.js"></script>
<script type="text/javascript" src="js/button_click.js"></script>
<script type="text/javascript" src="js/delete.js"></script>
<script type="text/javascript" src="js/google_map.js"></script>
<script type="text/javascript" src="js/edit-boxes.js"></script>
<script src="js/view-image3.js"></script>
<script type="text/javascript" src="js/toggle-select-other.js"></script>
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
	function fetchState(id) {
		$('#state').html = "";
		$('#state').html('<option>Select City</option>');
		$.ajax({
			type:'post',
			url:'fetchStates.php',
			data:{country_id:id},
			success: function(data){
				$('#state').html(data);
			}
		});
	}
</script>

</html>