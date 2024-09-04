<?php
$count = 0;
$corp->getSubscription();
$rem_cand = ($corp->getPackNumCand()- $corp->numOfShortlistedCand());
?>
<?php
//$search="";
if(isset($_GET['page']))
{
	$pageNumber = $_GET['page'];
}
else{
	$pageNumber = 1;
}
//$location = $_POST['loc'];
	//echo $location;
$numPages = ceil($candidate->getTotalReturnedTalents($search) / 10);
	?>
<div style="display: flex;justify-content: space-between;">
<!--Do not remove--><label></label><!---->
<label class="p-18"><label id=""><?php echo 'Search Result ('. $candidate->getTotalReturnedTalents($search).')'; ?></label></label>
</div>
<div class="row candidatess">
<?php 
	$query = $candidate->globalSearchAll($search,$pageNumber,10);
	$numOfShortlistedCand =$corp->numOfShortlistedCand();
	foreach ($query as $c_email)
	{ 	
		$result="";
		$email = "";
		$email = $c_email;
		$candidate->setCandidate($email);
		$candidate->getCurrentJob();
		//echo $email.' '.$candidate->getCandName();
		$candidate->address();
		$roles = $candidate->getCombinedRoles($email);

	$skills = $candidate->getCombinedSkills($email);

		$courses = $candidate->getCombinedCourses($email);

		$experience =$candidate->getCombinedExperience($email);

		$qualification =$candidate->getCombinedQualification($email);

		$location = $candidate->getCombinedLocation($email);
		$names = $candidate->getCombinedNames($email);
		$names_ = $candidate->getCombinedNames_($email);
		$names__ = $candidate->getCombinedNames__($email);
		$workMethod = $candidate->getCombinedCV($email);
		$result = $result.$roles.','.$skills.','.$courses.','.$experience.','.$qualification.','.$location.','.$names.','.$names_.','.$names__;
		//echo $search.' '.$result.' <br>'.$candidate->globalSearch($search,$result);

		if($candidate->globalSearch($search,$result) == true)
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
								<button class="bton btn4 addcand text-white" title="De shortlist" style="background:#e4186d ;" value="deshortlist" id="<?php echo $candidate->getCandID() ?>">
										Shortlisted </button>
								<?php
								}
								else{
									?>
									<button class="bton btn4 addcand addcand1 text-white" style="background:#27276C;" value="shortlist" title="" data_id="<?php echo $count ?>" id="<?php echo $candidate->getCandID() ?>">
										Shortlist
									</button>
									<?php
								}
								?>	
								
							</div>
							<a href="view-profile?id=<?php echo $email ?>&num=<?php echo $count ?>" target="_blank" class="openChildTab">
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
										<div class="">						
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
										<div class="">
											 	<p class="p-12 oneline-limit"><?php echo $qualification;?></p>
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

?>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    $('.openChildTab').click(function(event){
        event.preventDefault();

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

function receiveDataFromChild(data) {
let cand_id = data;
$('#'+cand_id).html('shortlisted');
$('#'+cand_id).css("background-color","#e4186d");
$('#'+cand_id).css("color","white");
//$('.addcand').val('deshortlist');
$('#'+cand_id).val('deshortlist');
}
</script>

  	
</div>
  <div id="pagination-container" class="pagination-buttonss"></div>

	 <script type="text/javascript">
	 numRow = <?php echo $count ?>;

	// document.getElementById("numRows").innerHTML = 'Search Result ('+numRow+')';
 </script>

 <script type="text/javascript">
 $(function() {
 
$(".addcand").click(function(){
// get current value of basket
	var btnValue = $(this).attr("value");
	if(btnValue == "shortlist"){
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
document.getElementById(cand_id).disabled = false;
$('#'+cand_id).html('shortlisted');
$('#'+cand_id).css("background-color","#e4186d");
$('#'+cand_id).css("color","white");
//$('.addcand').val('deshortlist');
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


//Save the link in a variable called element
var element = $(this);
//Find the id of the link that was clicked
var cand_id = element.attr("id");
var cand_num = element.attr("data_id");
//var table = "candidate_tbl";
//var field = "c_id";
//Built a url to send

$('#'+cand_id).html('Shortlist');
$('#'+cand_id).css("background-color","#27276C");
$('#'+cand_id).css("color","white");
//$('').val('shortlist');
$('#'+cand_id).val('shortlist');

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
  <script>
    const totalPages = <?php echo $numPages; ?>;
    let currentPage = <?php echo isset($_GET['page']) ? max(1, min($numPages, (int)$_GET['page'])) : 1; ?>;

    function generatePagination() {
        const paginationContainer = document.getElementById('pagination-container');
        paginationContainer.innerHTML = '';

        const maxTabs = 3;
        const startPage = Math.max(1, currentPage - Math.floor(maxTabs / 2));
        const endPage = Math.min(totalPages, startPage + maxTabs - 1);

        // Start Tab
        const startTab = document.createElement('button');
        startTab.className = 'pagination-item page-btn mr-1';
        startTab.innerText = '<<';
        startTab.addEventListener('click', () => {
            currentPage = 1;
            generatePagination();
        });
        const startLink = document.createElement('a');
        startLink.href = 'talent-profile?page=1'; // Adjust the URL as needed
        startLink.appendChild(startTab);
        paginationContainer.appendChild(startLink);

        // Previous Tab
        const prevTab = document.createElement('button');
        prevTab.className = 'pagination-item page-btn mr-1';
        prevTab.innerText = '<';
        prevTab.addEventListener('click', () => {
            if (currentPage > 1) {
                currentPage--;
                generatePagination();
            }
        });
        const prevLink = document.createElement('a');
        prevLink.href = `talent-profile?page=${currentPage - 1}`; // Adjust the URL as needed
        prevLink.appendChild(prevTab);
        paginationContainer.appendChild(prevLink);

        // Pagination Tabs
        for (let i = startPage; i <= endPage; i++) {
            const paginationItem = document.createElement('button');
            paginationItem.className = 'pagination-item page-btn';
            paginationItem.innerText = i;

            if (i === currentPage) {
                paginationItem.classList.add('active');
            }

            paginationItem.addEventListener('click', () => {
                console.log(`Clicked on page ${i}`);
                currentPage = i;
                generatePagination();
            });

            const linkContainer = document.createElement('a');
            linkContainer.href = `talent-profile?page=${i}`; // Adjust the URL as needed
            linkContainer.className = 'mr-1';
            linkContainer.appendChild(paginationItem);
            paginationContainer.appendChild(linkContainer);
        }

        // Next Tab
        const nextTab = document.createElement('button');
        nextTab.className = 'pagination-item page-btn mr-1';
        nextTab.innerText = '>';
        nextTab.addEventListener('click', () => {
            if (currentPage < totalPages) {
                currentPage++;
                generatePagination();
            }
        });
        const nextLink = document.createElement('a');
        nextLink.href = `talent-profile?page=${currentPage + 1}`; // Adjust the URL as needed
        nextLink.appendChild(nextTab);
        paginationContainer.appendChild(nextLink);

        // End Tab
        const endTab = document.createElement('button');
        endTab.className = 'pagination-item page-btn';
        endTab.innerText = '>>';
        endTab.addEventListener('click', () => {
            currentPage = totalPages;
            generatePagination();
        });
        const endLink = document.createElement('a');
        endLink.href = `talent-profile?page=${totalPages}`; // Adjust the URL as needed
        endLink.appendChild(endTab);
        paginationContainer.appendChild(endLink);

        // Scroll to the active tab and center it
        const container = document.getElementById('pagination-container');
        const activeTab = paginationContainer.querySelector('.active');
        if (activeTab) {
            const centerOffset = container.clientWidth / 2 - activeTab.clientWidth / 2;
            container.scrollLeft = Math.max(0, activeTab.offsetLeft - centerOffset);
        }
    }

    generatePagination(); // Initial generation
</script>
