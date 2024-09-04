<?php
session_start();
//include "include/unset_sess.php";
include "login_cred.php";
include "include/website_class.php";
$web = new Website($db); //Website class
$type = md5('cand');
require_once 'vendor/vendor-goo/autoload.php';

$clientId = '748757386943-mpirvpftkeop6qvds0i81dsjjhlqms99.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'https://'.$web->getWebLinkExt().'talent.viconetgroup.com/callback.php';
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

?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="robots" content="index, follow">
    <title>Vico.net | Talent Login</title>
<meta content="Our platform connects you with data science, digital, engineering, information systems, technology and analytical group of professionals critical to the future of work and business solutions." name="">
<meta name="data science, digital, engineering, information systems, technology">
    <link rel="shortcut icon" type="image/png" href="img/favicon.svg">
     <link rel="stylesheet" href="http://getbootstrap.com.vn/examples/equal-height-columns/equal-height-columns.css"/>
    
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css?9812">
    <link rel="stylesheet" type="text/css" href="css/style2.css?7935">
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
					<div class="row align-items-start d-lg-flex   d-none pb-lg-5">
						<div class="col align-self-center">
							<img onclick="history.back()" src="img/lazyload-ph.png" data-src="img/back.svg" class="img-fluid mx-auto d-block img-style ms-lg-0 me-lg-0 me-md-1 ms-md-1 lazyload" alt="back" width="44" height="42">
						</div>
						<div class="col text-lg-end head-nav-logo align-self-center">
							<img src="img/lazyload-ph.png" data-src="img/logo.svg" class="img-fluid mx-auto d-block ms-lg-0 me-lg-0 ms-md-0 me-md-0 lazyload" alt="logo" width="179" height="66">
						</div>
					</div>
				</div>
				<div class="ps-lg-4 pe-lg-4 scrollable pb-lg-5">
					<h5 class="h1-style mb-md-5 mt-md-4 mt-sm-4 mb-4 mt-0 mb-lg-0">
						Talent Login
					</h5>
					<div class="mt-lg-5">
						<div class="row">
							<a href="<?php echo $client->createAuthUrl(); ?>" style="text-decoration: none;">
								<div class="mb-lg-3 col-lg-12">
								<div class="btn-social">
									<img src="img/lazyload-ph.png" data-src="img/Google__G__Logo.svg" class="img-fluid mx-auto d-block img-google-g-lo-style me-lg-2 ms-lg-0 ms-0 mb-0 mt-0 me-2 lazyload" alt="Google__G__Logo" width="19" height="24">
									<label class="form-label text-p mb-lg-0 me-0 mb-0">
										Login with google
									</label>
								</div>
							</div>
						</a>
							<div class="col text-lg-center mt-lg-2 mb-lg-4 text-md-center mb-md-3 mt-md-3 text-sm-center mt-sm-3 mb-sm-3 text-center mt-3">
								<label class="form-label">
									Or<br>
								</label>
							</div>
						</div>
					</div>
					<div class="mt-lg-4">
						<form method="post" autocomplete="off">
						<div><?php echo $disp ?></div>
						<div class="row">
							<div class="offset-0 col-12 col-sm-6 offset-lg-0 col-lg-12">
								<div class="form-group mb-3">
									<label for="userEmail" class="form-label text-p">
										Email
									</label>
									<input class="form-control text-fl cust-input"  autocomplete="false" name="user_email" id="user_email" oninput="checkEmail()" type="email" data-error-validation-msg="Not a valid email address">
									<div class="error-message"></div>
								</div>
							</div>
							<div class="offset-0 col-12 col-sm-6 offset-lg-0 col-lg-12">
								<div class="form-group mb-3">
									<label class="form-label text-p">
										Password
									</label>
									<input class="form-control text-fl"  name="user_password" type="password">
								</div>
							</div>
							<div class="offset-lg-0 col-lg-12">
								<p class="p-style">
									<a class="a-link" href="forgot-password?t=<?php echo $type?>">Forgot password</a><br>
								</p>
							</div>
							<div class="col">
								<button type="submit" name="login" id="login_btn" class="btn btn-d w-100 btn-lg mb-md-3 btn-12">Login</button>
								<p class="p-style mt-lg-3">
									Don't have an account? <a class="a-link" href="create">Create Profile</a>
								</p>
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
<script src="./js/lazysizes.min.js" defer></script>
<script type="text/javascript" src="js/login-validation.js"></script>
<script src="js/button_click.js"></script>
<!-- Additional JS END -->


</body>
</html>
