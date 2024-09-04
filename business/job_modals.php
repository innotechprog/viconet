<!-- Create job modal-->
<div id="modal1" class="modal">
	<div class="edit-modal">
		<div class="live-chat-header">
			<div class="d-flex flex-row justify-content-between">
				<span class="l-18">Create job</span>
				<span ><img src="img/close.svg" class="close"></span>
			</div>
		</div>
		<form method="post" enctype="multipart/form-data">
		<div class="edit-content">
			<hr>
			<div class="row">
				<div class="col-lg-6 form-group">
					<label class="input-label">Job Title</label>
					<input type="text" name="jobTitle" class="cust-input " value="<?php echo $candidate->getCandName() ?>" >
				</div>
				<div class="col-lg-6 form-group">
					<label class="input-label">Post Type</label>
					<select name="postType" class="cust-input">
						<option value="">Select Post Type</option>
						<option value="permanent">Permanent</option>
						<option value="Temporary">Select Post Type</option>
						<option value="Contract">Select Post Type</option>
					</select>
				</div>
				<div class="col-lg-6 form-group">
					<label class="input-label">Start Date</label>
					<input type="date" name="d_of_b" value="<?php echo $candidate->getCandDOB() ?>" class="cust-input " >
				</div>
				<div class="col-lg-12 form-group">
					<label class="input-label">Work method</label>
					
				</div>
				
					<input type="hidden" name="profile_pic" value="<?php echo $candidate->getPP() ?>" class="cust-input " >
				
				
				<div class="col-lg-12 form-group">
					<label class="input-label">Address</label>
					<input type="text" name="address" id="search_location" class="cust-input " value="<?php echo $candidate->getAddress(); ?>">
				</div>
				
				
				<div class="col-lg-6 form-group">
					<label for="country" class="input-label">Country</label>
					<?php 
					$query = $candidate->getCountries();
					?>
					<select name="country" id="country" class="cust-input mendatory_input" onchange="fetchState(this.value)"> 
						<option value="<?php echo $candidate->getCountryId() ?>"><?php echo $candidate->getCountry() ?></option>
						<?php
						for ($i=0; $rows=$query->fetch() ; $i++) { 
							?>
						<option value="<?php echo $rows['id'] ?>"><?php echo $rows['name'] ?></option>
						<?php  
						}
						?>
					</select>							
				</div>
				
				<div class="col-lg-6 form-group">
					<label for="state" class="input-label">State/Province</label>
					<select name="state" id="state" class="cust-input mendatory_input">
						<option value="<?php echo $candidate->getStateId() ?>"><?php echo $candidate->getState(); ?></option>		
					</select>
				</div>
				<div class="col-lg-12 form-group">
					<button class="bton btn2"style="width: 100%" name="save_profile">SAVE</button>
				</div>

			</div>
		</div>
	</form>
	</div>
</div>
<!--End create job modal-->

