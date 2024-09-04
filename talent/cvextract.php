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
 <div class="preloader-container">
     <div class="c c1" style="--i:1;"></div>
     <div class="c c2" style="--i:2;"></div>
     <div class="c c3" style="--i:3;"></div>
     <div class="c c4" style="--i:4;"></div>
     <div class="c c5" style="--i:5;"></div> 
</div>
<div class="cont-center col-lg-6">			
		<div class="white-container" id="theform">
			<form name="myForm" id="myForm" action="cv_upload" method="post"enctype="multipart/form-data">
				<div class="text-center">
					<div>
						<img src="img/viconet-logo.svg" style="margin-bottom:20px;" width="200px">
					</div>
						<label class="l-18">Create a Talent Profile</label>
						 
					</div>
					<hr>
					<div class="row">
							<div class="col-lg-12 form-group">
							<label class="input-label">Choose CV File* (PDF Only)</label>
							<div class="file-btn">
								
						        <input type="file" name="cv" accept="application/pdf" onchange="getFileData(this)" id="file-input" >
						        <label for="file-input"class="btn-lbl">Choose File</label>
					      </div>
					      <label class="p_filename p-12-n" id="filename" ><?php echo $candidate->getPdfCV(); ?></label>
					      <?php if(empty($candidate->getPdfCV() )){
					      ?>
					      <div class="progress">
						    <div class="progress-bar" id="progressBar"></div>
						  </div>
						  <?php
					       } ?> 
					          	
					       <hr>
						</div>
						<div class="col-lg-12">
							<div class="row">
						<?php
						if(isset($_SESSION['goo']))
						{
							?>
						    <div class="col-lg-12 form-group">
                                <label for="phone" class="input-label">Mobile Number</label><label>*</label>
                                <input class="input-label cell-style mendatory_input" id="phone" name="userCellphone"  onkeypress="return onlyNumberKey(event)">
                                <div class="err-mes"></div>
                            </div>
                            <?php
                        }?>
						<div class="col-lg-12 form-group">
							<label for="dateOfBirth" class="input-label">Date Of Birth</label><label>*</label>
							
							<div class="d-flex">
								 <select id="year" onblur="checkInput(this)" name="year" class="cust-input mendatory_input">
							      <option value="">Year</option>
							    </select>
							    <select id="month" name="month" onblur="checkInput(this)" class="cust-input ml-2 mendatory_input">
							      <option value="">Month</option>
							      <option value="01">January</option>
							      <option value="02">February</option>
							      <option value="03">March</option>
							      <option value="04">April</option>
							      <option value="05">May</option>
							      <option value="06">June</option>
							      <option value="07">July</option>
							      <option value="08">August</option>
							      <option value="09">September</option>
							      <option value="10">October</option>
							      <option value="11">November</option>
							      <option value="12">December</option>
							    </select>
							    <select id="day" name="day" onblur="checkInput(this)" class="cust-input ml-2 mendatory_input">
							      <option value="">Day</option>
							    </select>
							</div>
							
						</div>
						<div class="col-lg-6 form-group">
							 <label for="gender" class="input-label">Gender</label><label>*</label>
							  <select id="gender" name="gender" onblur="checkInput(this)" onchange="onGenderChange()" class="cust-input mendatory_input">
							  	 <option value="">Select Gender</option>
							    <option value="Male">Male</option>
							    <option value="Female">Female</option>
							    <option value="Unspecified">Unspecified</option>
							  </select>
						</div>
						<div class="col-lg-6 form-group">
							<label for="gender" class="input-label">Race</label><label>*</label>
							<select id="race" name="race" onblur="checkInput(this)" class="cust-input mendatory_input" >
							<option value="">Select Race</option>
							  <option value="Asian">Asian</option>
							  <option value="African">African</option>
							  <option value="Indian">Indian</option>
							  <option value="White">White</option>
							  <option value="Coloured">Coloured</option>
							</select>
						</div>

						<div class="col-lg-12 form-group">
							<label for="search_location" class="input-label">Location Address</label><label>*</label>
												
							<input type="text" name="address" onblur="checkInput(this)" id="search_location" class="cust-input mendatory_input" placeholder="Enter Address" value="<?php echo $candidate->getAddress() ?>">	
						</div>
						<div class="col-lg-6 form-group">
							<label for="country" class="input-label">Country</label><label>*</label>
							<?php 
							$query = $candidate->getCountries();
							?>
							<select name="country" id="country" onblur="checkInput(this)" class="cust-input mendatory_input" onchange="fetchState(this.value)"> 
								<option value="<?php echo $candidate->getCountryId() ?>"><?php if(!empty($candidate->getCountry())){echo $candidate->getCountry(); }else{echo 'Select Country';} ?></option>
								<?php
								for ($i=0; $rows=$query->fetch() ; $i++) { 
									?>
								<option value="<?php echo $rows['id'] ?>" id="<?php echo $rows['name'] ?>"><?php echo $rows['name'] ?></option>
								<?php  
								}
								?>
							</select>							
						</div>
						<div class="col-lg-6 form-group">
						<?php
							$query = $candidate->getStates();
						?>	
						<label for="state" class="input-label">State/Province</label><label>*</label>
						<select name="state" id="state" onblur="checkInput(this)" class="cust-input required mendatory_input">
						<option value="<?php echo $candidate->getStateId() ?>" id="<?php echo $candidate->getState(); ?>"><?php echo $candidate->getState(); ?></option>
							<?php
							for ($i=0; $rows=$query->fetch() ; $i++) { 
								?>
								<option value="<?php echo $rows['id'] ?>" id="<?php echo $rows['name'] ?>"><?php echo $rows['name'] ?></option>
							<?php
							}
							?>
									
						</select>
					</div>
						
						
					</div>
				<div class="mt-3">					       
			       <button type="submit" class="bton btn2" id="submit_form" >Submit</button>
			       </div>
				</div>

			</div>
		</form>

			
		</div>
	</div>
</div>
</div>

<script>
	//Preloader
     function simulateLoading() {
      return new Promise(resolve => {
        setTimeout(resolve, 1000); // Simulating a 3-second loading time
      });
    }
	var preloader = document.querySelector('.preloader-container');
	var content = document.getElementById('theform');
    content.style.display = 'none'; // Show the div content

	// Show the preloader while loading the div content
    window.addEventListener('DOMContentLoaded', function() {

      simulateLoading().then(function() {
        preloader.style.display = 'none'; // Hide the preloader
        content.style.display = 'block'; // Show the div content
      });
    });
    // Show the preloader on form submission
var form = document.getElementById('myForm'); // Ensure this is the correct form ID

form.addEventListener('submit', function(event) {
  event.preventDefault(); // Prevent the default form submission
  preloader.style.display = 'flex'; // Show the preloader
  content.style.display = 'none'; // Hide the form content

  // Simulate loading after form submission
  simulateLoading().then(function() {
    form.submit(); // Submit the form after the simulated loading
  });
});
</script>

<script type="text/javascript" src="js/toggle.js"></script>
<script src="js/button_click.js"></script>
<script type="text/javascript" src="js/cvextract_validation.js"></script>
<script type="text/javascript" src="js/getAddr.js"></script>
<script type="text/javascript">
  function getFileData(myFile) {
    var file = myFile.files[0];
    var filename = file.name;
    var xhr = new XMLHttpRequest();
    var progressBar = document.getElementById('progressBar');
    // Validate file type
    if (file.type !== "application/pdf") {
      //alert("Please upload a valid PDF file.");
      myFile.value = ''; 
      document.getElementById('filename').classList.add('cv-err-mes');
      document.getElementById('filename').innerHTML= ' Please upload your CV in PDF format only.';// Clear the file input
       progressBar.style.width = 0 + '%';
      return;
    }
    document.getElementById('filename').classList.remove('cv-err-mes');
    document.getElementById('filename').innerHTML = filename;

    

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

  function getFileData1(myFile) {
    var file = myFile.files[0];
    var filename = file.name;

    // Validate file type
    if (file.type !== "application/pdf") {
      alert("Please upload a valid PDF file.");
      myFile.value = ''; // Clear the file input
      return;
    }

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

<script type="text/javascript" src="js/populate_caddress.js"></script>
 <script src="js/javascript-func.js"></script>
 <?php
if(isset($_SESSION['goo']))
{
	?>
 <script src="js/cell-val.js"></script>
  <script src="build/js/intlTelInput.js"></script>
<script>
    var input = document.querySelector("#phone");
    window.intlTelInput(input, {
      // allowDropdown: false,
      autoHideDialCode: false,
      autoPlaceholder: "on",
      // dropdownContainer: document.body,]
      // excludeCountries: ["us"],
      formatOnDisplay: false,
      // geoIpLookup: function(callback) {
      //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
      //     var countryCode = (resp && resp.country) ? resp.country : "";
      //     callback(countryCode);
      //   });
      // },
      //hiddenInput: "full_number",
       initialCountry: "ZA",
      // localizedCountries: { 'de': 'Deutschland' },
       nationalMode: false,
      // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
       placeholderNumberType: "MOBILE",
      // preferredCountries: ['cn', 'jp'],
       //separateDialCode: true,
      utilsScript: "build/js/utils.js",
    });
  </script>
<script>
    function onlyNumberKey(evt) {
          
        // Only ASCII character in that range allowed
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }
</script>
<?php } ?>
<script>
    window.onload = function() {
      var currentYear = new Date().getFullYear();
      var minYear = currentYear - 18;

      var yearSelect = document.getElementById("year");
      for (var i = minYear; i >= 1905; i--) {
        var option = document.createElement("option");
        option.text = i;
        option.value = i;
        yearSelect.add(option);
      }

      var daySelect = document.getElementById("day");
      for (var i = 1; i < 32; i++) {
        var option1 = document.createElement("option");
        option1.text = i;
        if(i < 10)
        {
        	i2 = '0'+i;
        }
         option1.value = i;
        daySelect.add(option1);
      }
       $('#day').val(day);
      $('#year').val(year);
    };
  </script>
   <script>
 	var gender = "<?php echo $candidate->getGender() ?>";
    var race = "<?php echo $candidate->getRace() ?>";
    var year = "<?php echo $candidate->getYear() ?>";
    var month = "<?php echo $candidate->getMonth() ?>";
    var day = "<?php echo $candidate->getDay() ?>";
 
    $('#day').val(day);
    $('#year').val(year);   
    $('#gender').val(gender);
    $('#race').val(race);
    $('#month').val(month);

  </script>

</body>
</html>
