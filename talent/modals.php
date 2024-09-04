<!-- modal -->
<div id="checkOut_modal" class="modal">
	<div class="edit-modal">
		<div class="live-chat-header">
			<div class="d-flex flex-row justify-content-between">
				<span class="l-18">Project information</span>
				<span ><img src="img/close.svg" class="close"></span>
			</div>
		</div>
		<hr>
		<div class="edit-content">
			<form method="post" id="addProjForm">
				<div class="row">
					<div class="col-lg-12 form-group">
						<label class="input-label">Project Name</label>
						<input type="text" class="cust-input" name="proj_name" placeholder="Enter project name">
						<div class="error-message"></div>
					</div>	 
					<input type="hidden" class="cust-input" name="id" value="projectId">
					<div class="col-lg-12 form-group">
						<label class="input-label">Project Description</label>
						<input type="text" required class="cust-input" name="proj_desc" placeholder="Enter project description">
					</div>
								
					<div class="col-lg-12 form-group">
						<button type="button" class="bton btn2"style="width: 100%" name="add_project" id="add_project">SAVE</button>
					</div>
				</div>	
			</form>
		</div>
	</div>
</div>
<div id="meetInter" class="modal">
	<div class="edit-modal">
		<div class="live-chat-header">
			<div class="d-flex flex-row justify-content-between">
				<span class="l-18">Meet or interview candidates selected?</span>
				<span ><img src="img/close.svg" class="close"></span>
			</div>
		</div>
		<hr>
		<div class="edit-content">
			<form method="post" id="lastForm">
				<div class="row">
					<div class="col-lg-12">
						<input type="radio" name="eType" checked value="Meeting"><label style="margin-left:10px" class="">Meeting</label>
					</div>
					<div class="col-lg-12">
						<input type="radio" name="eType" value="Inteview"><label style="margin-left:10px">Interview</label>
					</div>						
					<div class="col-lg-12 form-group">
						<button method="button" type="button" class="bton btn2"style="width: 100%" id="inviteCand">CONFIRM</button>
					</div>
				</div>	
			</form>
		</div>
	</div>
</div>

<div id="modal11" class="modal">
	<div class="edit-modal">
		<div class="live-chat-header">
			<div class="d-flex flex-row justify-content-between">
				<span class="l-18">Upload</span>
				<span ><img src="img/close.svg" class="close"></span>
			</div>
		</div>
		<div class="edit-content">	
			<form method="post" id="myForm" enctype="multipart/form-data">
				<div class="upload-frame1">
					<label class="l-14">Upload CV in PDF</label>
					<div class="upload-frame">
						<label class="upload_cv"  for="short_cv"><img src="img/upload.svg"></label>
						<input type="file" id="short_cv" accept="application/pdf" name="long_cv" onchange="getFileData(this)">
					</div>
					<div class="d-flex flex-row justify-content-between">
					<span class="l-14 upload-filename" id="filename"></span>
					<span ><img src="img/delete.svg" class="delete-upload"></span>
				</div>
				</div>
				
				<div class="">
					<button class="bton btn2"style="width: 100%" name="add_cv">SAVE</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div id="consent1" class="modal consentModal" >
	<div class="edit-modal" style="max-height: unset;">
		<div class="live-chat-header">
			<div class="d-flex flex-row justify-content-between">
				<span></span>
				<span ><img src="img/close.svg" class="closeConsent" id="closeConsent"></span>
			</div>
		</div>
		<div class="edit-content" style="max-height: unset;">	
			<div style="margin: 0 auto;">
			<div class="mes-frame" style="margin-top:-20px">
				<div class="success-tick">
					<img src="img/undraw_accept_terms_re_lj38 2.svg">
				</div>
				
			</div>
			<label class="l-18">Consent notice</label>
			<p>We respect your privacy and acknowledge that this Candidate / Talent Profile contains personal details, which may belong to you, others and / or to your company.<br><br>
			By populating this Candidate / Talent Profile, you expressly give us consent to process and further process the Personal Information contained herein which processing will be done in accordance with POPIA.</p>
		</div>
		</div>
	</div> 
</div>
<!-- Add candidatesto project-->
<div id="addCandidates" class="modal">
	<div class="search-modal col-lg-12">
		<div class="live-chat-header">
			<div class="d-flex flex-row justify-content-between">
				<span class="l-18">Add candidates</span>
				<span ><img src="img/close.svg" class="close"></span>
			</div>
		</div>
		<hr>
<div class="modalSearch">
	<div style="width: 70%;"> 
	<form id="myForm3" method="post" enctype="multipart/form-data"> 
		<div class="talent-search">
			
			<div class="s_tal">
			<input type="text" name="search_field" id="inputBox" autocomplete="off" placeholder="Job Title, Qualifications, Skills, Location, Keywords..." class="s_input">			
			<input type="hidden" name="rec_id" value="<?php echo $rec_id ?>">
			</div>
			<img id="tal_search" class="search-icon" src="img/search-icon.svg" alt="search">
		</div>
	</form>
	</div>	
		<div class="" style="margin-top: -15px;">
			<form method="post" action="save_data">
			<input type="hidden" name="id" value="addToProj">
			<input type="hidden" name="receipt_id" value="<?php echo $rec_id ?>">
			<button type="submit" class="bton btn2 search-btn" id="tal_search">Add candidates <label class="comp-status mt-1" style="background: #FF8EBD" id="candAdded">0</label></button>
			</form>
		</div>

			
</div>
		<div class="search-content">
			<div id="search_return" class="mt-3">
			</div>
		</div>
	</div>
</div>
<!-- edit project modal -->
<div id="modal7" class="modal">
	<div class="edit-modal">

		<div class="live-chat-header">
			<div class="d-flex flex-row justify-content-between">
				<span class="l-18">Edit Project Information</span>
				<span ><img src="img/close.svg" class="close"></span>
			</div>
		</div>
		<hr>
		<div class="edit-content">
			<form method="post" id="myForm" action="save_data">
				<div id="error_"></div>
				<div class="row">
					<div class="col-lg-12 form-group">
						<label for="project_name" class="input-label">Project Name</label>
						<input type="text" id="project_name" value="<?php echo $projectName ?>" required  name="r_name" class="cust-input " placeholder="Enter Project Name">
						<div class="error-message"></div>
					</div>
					
					<div class="col-lg-12 form-group">
						<label for="company_name" class="input-label">Project Description</label>
						<textarea rows="4" name="r_desc" required id="about_cand" class="cust-input mendatory_input" style="height:unset;" maxlength="700" placeholder="Enter Project Description"><?php echo $projectDesc ?></textarea>
					</div>
						<input type="hidden" name="r_id" value="<?php echo $projectId ?>">
						<input type="hidden" name="id" value="edtp">								
					<div class="col-lg-12 form-group">
						<button class="bton btn2"style="float: right;width: 108px;margin-bottom:13px" id="update_project" type="submit">SAVE</button>
					</div>
					
				</div>
			</form>
			</div>
		</div>
	</div>

	