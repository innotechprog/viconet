<?php
session_start();
include "include/connect.php";
include "include/functions.php";
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">

<title>Vico.net | Contact Us</title>
<meta content="Our platform connects you with data science, digital, engineering, information systems, technology and analytical group of professionals critical to the future of work and business solutions." name="">
<meta name="data science, digital, engineering, information systems, technology">

<?php
include "head1.php";
?>	
</head>
<body class="body-b">
?>
<?php
if(empty($_SESSION['id'])){
	include "header.php";
}
else{
	if($_GET['id']==md5('staff'))
	{
		include "userHeader.php";
	}
	else
	{
		include 'include/create-p-auth.php';
		include 'candidate-header.php';
	}
}

?>
<div class="talent-blue-header">
	<div class="prof-container">
		
		<div class="row">
			<div class="col-lg-4">
				<div class="white-container">
					<div class="profile-info">
						<label class="l-18">Contact Details</label>
						<hr>
						<label class="l-14">Phone</label>
						<p><a href="tel:+27 10 035 3442">+27 10 035 3442</a></p>
						<label class="l-14">Email</label>
						<p><a href="mailto:info@viconet.co.za">info@viconet.co.za</a></p>
						<label class="l-14">Address</label>
						<p>Unit C38, Block C, Lone Creek<br>
						21 Mac Mac Road & Howick Close<br>
						Waterfall Park<br>
						Midrand</p>
					</div>
				</div>
			</div>
			<div class="col-lg-8">
				<div class="corp-edit">
				<label class="l-18">Contact Form </label>  <label class="l-14-n"> for viconet users</label>
				<hr>
			<form method="post" id="myForm" >
				<div id="error_"></div>
				<div class="row">
					<div class="col-lg-6 form-group">
						<label for="name" class="input-label">Name</label>
						<input type="text" id="name"  name="name" class="cust-input " oninput="checkName()" placeholder="Enter Name">
						<div class="error-message"></div>
					</div>
					
					<div class="col-lg-6 form-group">
						<label for="surname" class="input-label">Surname</label>
						<input type="text" id="surname" name="surname" class="cust-input" oninput="checkSurname()" placeholder="Enter Surname">
						<div class="error-message"></div>
					</div>
					<div class="col-lg-6 form-group">
						<label for="userCell" class="input-label">Mobile Number</label>
						<input type="tel" id="userCell" name="userCellphone" oninput="checkCell()" onkeypress="return onlyNumberKey(event)" class="cell-style " style="max-width:100%!important">
						<div class="err-mes"></div>
					</div>
					
					<div class="col-lg-6 form-group">
						<label for="email" class="input-label">Email</label>
						<input type="email" id="email" name="email"  class="cust-input " oninput="checkEmail()"  placeholder="Enter Email">
						<div class="error-message"></div>
					</div>
					<div class="col-lg-12 form-group">
						<label for="subject" class="input-label">Subject</label>
						<input type="text" id="subject" name="subject" class="cust-input"oninput="checkSubject()" placeholder="Enter Subject">
						<div class="error-message"></div>
					</div>
					<div class="col-lg-12 form-group">
						<label for="message" class="input-label">Message/Comments</label>
						<textarea class="cust-input" cols="6" id="message" rows="4" style="height:unset;" name="message" oninput="checkMessage()" placeholder="Enter Message"></textarea>
						<div class="error-message"></div>
					</div>
					<div class="col-lg-12 form-group">
						<button class="bton btn2"style="float: right;width: 108px;" id="submit_contactForm" type="button">SUBMIT</button>
					</div>
					<div id="success_mes" class="success_mes"></div>
				</div>
			</form>
			</div>
			</div>
		</div>

	</div>
</div>

<?php
include "footer.php";
?>
</body>
<!-- Javascripts -->

<script type="text/javascript" src="js/toggle.js"></script>
 <script src="build/js/intlTelInput.js"></script>
 <script type="text/javascript">
    var input = document.querySelector("#userCell");
    window.intlTelInput(input, {
      // allowDropdown: false,
      autoHideDialCode: false,
      autoPlaceholder: "on",
      // dropdownContainer: document.body,
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
<script type="text/javascript" src="js/contact_formVal.min.js"></script>
<script type="text/javascript" src="js/form-submit.js"></script>

</html>