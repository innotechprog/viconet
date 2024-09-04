<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
	<meta name="robots" content="index, follow">
	<title>Vico.net | Create Profile</title>
<meta content="Our platform connects you with data science, digital, engineering, information systems, technology and analytical group of professionals critical to the future of work and business solutions." name="">
<meta name="data science, digital, engineering, information systems, technology">
    <link rel="shortcut icon" type="image/png" href="favicon.png">
    
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css?9812">
	<link rel="stylesheet" type="text/css" href="style.css?7935">
	<link rel="stylesheet" type="text/css" href="./css/ionicons.min.css">
	<link href='https://fonts.googleapis.com/css?family=Quicksand:300,400,500,600,700,40&display=swap&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   

<style>
.scrollable{
  overflow-y: auto;
  max-height: 90vh;
}
</style>
    
<!-- Analytics -->
 
<!-- Analytics END -->
    
</head>
<body>

<!-- Preloader -->
<div id="page-loading-blocs-notifaction" class="page-preloader"></div>
<!-- Preloader END -->
<?php
require_once 'vendor/autoload.php';

$clientId = '748757386943-mpirvpftkeop6qvds0i81dsjjhlqms99.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'https://talent.viconetgroup.com';
$client = new Google_Client();
$client->setClientId($clientId);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$scopes = [
    'https://www.googleapis.com/auth/userinfo.email', // Access to the user's email address
    'https://www.googleapis.com/auth/userinfo.profile', // Access to basic profile information
    // Add any additional scopes you need here
];
$client->setScopes($scopes);
//include "callback.php";
?>

<!-- Main container -->
<div class="page-container">
    
<!-- Bloc Group -->

<!-- Bloc Group -->
<div class="bloc-group container-div-intro">

<!-- login -->
<div class="bloc l-bloc none bloc-tile-2" id="login">
	<div class="container bloc-no-padding-lg">
		<div class="row">
			<div class="col-12 align-self-center text-lg-start pt-0 ps-lg-0 offset-md-0 order-md-0">
				<div class="row d-lg-none d-xl-none d-flex">
					<div class="col align-self-center">
						<img src="img/lazyload-ph.png" data-src="img/back.svg" class="img-fluid mx-auto d-block ms-lg-0 me-lg-0 me-md-1 ms-md-1 ms-sm-0 me-sm-0 me-0 ms-0 lazyload" alt="back" width="44" height="42">
					</div>
					<div class="col text-lg-end head-nav-logo align-self-center">
						<img src="img/lazyload-ph.png" data-src="img/logo.svg" class="img-fluid mx-auto d-block ms-lg-0 me-lg-0 ms-md-0 me-md-0 me-sm-0 ms-sm-0 me-0 ms-0 lazyload" alt="logo" width="179" height="66">
					</div>
				</div>
				<div class="candi-signup-ima text-sm-start pt-lg-4 pb-lg-4 ps-lg-5 pe-lg-5">
					<h1 class="float-lg-none ms-lg-0 tc-196 mb-lg-4 h4-style mb-0 float-sm-none">
						Get connected and access possible career or business opportunities.
					</h1>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- login END -->

<!-- form -->
<div class="bloc l-bloc none bloc-tile-2" id="form">
	<div class="container bloc-no-padding-lg">
		<div class="row">
			<div class="col-12 ps-lg-5 mt-4 mt-lg-0 mt-md-3 offset-md-0 mt-sm-0 order-md-1">
				<div class="d-lg-block   d-none head-nav-logo">
					<div class="row align-items-start d-lg-flex   d-none ps-lg-4 pe-lg-4">
						<div class="col align-self-center">
							<a href="#"><img src="img/lazyload-ph.png" data-src="img/back.svg" class="img-fluid mx-auto d-block img-style ms-lg-0 me-lg-0 me-md-1 ms-md-1 lazyload" alt="back" width="44" height="42"></a>
						</div>
						<div class="col text-lg-end head-nav-logo align-self-center">
							<img src="img/lazyload-ph.png" data-src="img/logo.svg" class="img-fluid mx-auto d-block ms-lg-0 me-lg-0 ms-md-0 me-md-0 lazyload" alt="logo" width="179" height="66">
						</div>
					</div>
				</div>
				<div class="ps-lg-4 pe-lg-4 scrollable pb-lg-5">
					<h5 class="h1-style mb-md-5 mt-md-4 mt-sm-4 mb-4 mt-0 mb-lg-4 mt-lg-5">
						Create A Talent Profile
					</h5>
					<div class="mt-lg-5">
						<div class="row">
							<a href="<?php echo $client->createAuthUrl(); ?>">
								<div class="mb-lg-3 col-lg-12">
								<div class="btn-social">
									<img src="img/lazyload-ph.png" data-src="img/Google__G__Logo.svg" class="img-fluid mx-auto d-block img-google-g-lo-style me-lg-2 ms-lg-0 ms-0 mb-0 mt-0 me-2 lazyload" alt="Google__G__Logo" width="19" height="24">
									<label class="form-label text-p mb-lg-0 me-0 mb-0">
										Login with google
									</label>
								</div>
							</div>
						</a>
							<div class="col text-lg-center mt-lg-2 mb-lg-4 text-md-center mb-md-3 mt-md-3 text-sm-center mt-sm-3 mb-sm-3 text-center mt-3 mb-3">
								<label class="form-label">
									Or<br>
								</label>
							</div>
						</div>
					</div>
					<div class="mt-lg-0">
						<form name="myForm" id="myForm" method="post"enctype="multipart/form-data">
							<div class="row">
							<div class="offset-0 col-12 col-sm-6 offset-lg-0 col-lg-6">
								<div class="form-group mb-3">
									<label class="form-label text-p">
										Full Name
									</label>
									<input class="form-control text-fl cust-input" name="userName" id="userName" oninput="checkName()">
									<div class="error-message"></div>
								</div>
							</div>
							<div class="offset-0 col-12 col-sm-6 offset-lg-0 col-lg-6">
								<div class="form-group mb-3">
									<label for="userSurname" class="form-label text-p">
										Surname
									</label>
									<input class="form-control text-fl cust-input" id="userSurname" name="userSurname" oninput="checkSurname()">
									<div class="error-message"></div>
								</div>
							</div>
							<div class="offset-0 col-12 col-sm-6 offset-lg-0 col-lg-6">
								<div class="form-group mb-3">
									<label class="form-label text-p">
										Email Address
									</label>
									<input class="form-control text-fl cust-input" type="email" data-error-validation-msg="Not a valid email address" name="userEmail" id="userEmail" oninput="checkEmail()">
									<div class="error-message"></div>
								</div>
							</div>
							<div class="offset-0 col-12 col-sm-6 offset-lg-0 col-lg-6">
								<div class="form-group mb-3">
									<label for="phone" class="form-label text-p">
										Mobile Number&nbsp;
									</label>
									<input class="form-control text-fl cell-style" id="phone" name="userCellphone"  onkeypress="return onlyNumberKey(event)">
									<div class="err-mes"></div>
								</div>
							</div>
							<div class="offset-0 col-12 col-sm-6 offset-lg-0 col-lg-6">
								<div class="form-group mb-3">
									<label for="userPassword" class="form-label text-p">
										Password
									</label>
									<input class="form-control text-fl cust-input" type="password" id="userPassword" name="userPassword" oninput="checkPassword()">
									<div id="error_m" class="error-message">
										<h5>Password must contain the following:</h5>
										  <p id="letter" class="invalid">A <b>lowercase</b>  letter</p>
										  <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
										  <p id="number" class="invalid">A <b>number</b></p>
										  <p id="chars" class="invalid">A <b>special character</b></p>
										  <p id="length" class="invalid">Minimum <b>8 characters</b></p>
									</div>
								</div>
							</div>
							<div class="offset-0 col-12 col-sm-6 offset-lg-0 col-lg-6">
								<div class="form-group mb-3">
									<label for="userConfPassword" class="form-label text-p">
										Confirm Password
									</label>
									<input class="form-control text-fl cust-input" type="password" id="userConfPassword" name="userConfPassword" oninput="checkConfirmPassword()">
									<div class="error-message"></div>
								</div>
							</div>
							<div class="offset-lg-0 col-lg-12">
								<div class="form-check p-style checkbox-input">
									<input class="form-check-input mb-lg-4 mb-md-3 cust-checkbox" id="consent" name="consent" type="checkbox"><label class="form-check-label checkbox-lbl">I accept <a href="#" class="a-link" data-bs-toggle="modal" data-bs-target="#modal-17155">POPIA consent notice </a>
									</label>
									<div class="error-message"></div>
								</div>
								<div class="p-style form-check">
									<input class="form-check-input mb-lg-4 mb-md-3 mb-sm-3 mb-4" type="checkbox" id="userT_and_c" name="userT_and_c">
									<label class="form-check-label">
										I accept <a href="#" class="a-link">terms and condition</a>
									</label>
									<div class="error-message"></div>
								</div>
							</div>
							<div class="col">
								<button class="btn btn-d w-100 btn-lg mb-md-2 mb-sm-2 btn-12 mb-lg-0" data-bs-toggle="modal" type="button" id="add_candidate">Login</button>
								<p class="p-style mt-lg-3 mt-3 mb-lg-5">
									Already have an account? <a class="a-link " href="index.html">Log in</a>
								</p>
								<div id="modal-17155" class="modal fade" tabindex="-1" role="dialog">
									<div class="modal-dialog  modal-dialog-centered" role="document">
										<div class="card-f modal-content">
											<div class="modal-header">
												<label class="form-label h5-style mb-lg-0">
													Consent Notice
												</label><a href="#" class="btn btn-lg close-btn btn-wire" data-bs-dismiss="modal" aria-label="Close"><span class="ion ion-close-round icon-sm"></span></a>
											</div>
											<div class="modal-body">
												<img src="img/lazyload-ph.png" data-src="img/undraw_accept_terms_re_lj38%202.svg" class="img-fluid mx-auto d-block mb-lg-3 lazyload" alt="undraw_accept_terms_re_lj38%202" width="198" height="141">
												<p class="p-style">
													We respect your privacy and acknowledge that this Candidate / Talent Profile contains personal details, which may belong to you, others and / or to your company.<br><br>By populating this Candidate / Talent Profile, you expressly give us consent to process and further process the Personal Information contained herein which processing will be done in accordance with POPIA.<br>
												</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- form END -->
</div>
<!-- Bloc Group END -->

<!-- ScrollToTop Button -->
<button aria-label="Scroll to top button" class="bloc-button btn btn-d scrollToTop" onclick="scrollToTarget('1',this)"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 32 32"><path class="scroll-to-top-btn-icon" d="M30,22.656l-14-13-14,13"/></svg></button>
<!-- ScrollToTop Button END-->


</div>
<!-- Main container END -->
    


<!-- Additional JS -->
<script src="./js/bootstrap.bundle.min.js?6274"></script>
<script src="./js/blocs.min.js?4267"></script>
<script src="./js/lazysizes.min.js" defer></script><!-- Additional JS END -->
<script type="text/javascript" src="js/form-validation.js"></script>
<script type="text/javascript" src="js/form-submit.js"></script>
<script src="build/js/intlTelInput.js"></script>
 <script src="js/button_click.js"></script>
  <link rel="stylesheet" href="build/css/intlTelInput.css">
  <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyDfOtu_xwlPW-3mMckhMw5O0oKiBC3ZH64"></script>
  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-YB53H0S841"></script>
<script>
    var input = document.querySelector("#phone");
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
<script>
    function onlyNumberKey(evt) {
          
        // Only ASCII character in that range allowed
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }
</script>

</body>
</html>
