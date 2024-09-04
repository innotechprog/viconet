<?php
session_start();
include "login_cred.php";
$type = md5('corp');
?>
<!doctype html>
<html>
<head>
 <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="robots" content="index, follow">
    <title>Vico.net | Business Login</title>
<meta content="Our platform connects you with data science, digital, engineering, information systems, technology and analytical group of professionals critical to the future of work and business solutions." name="">
<meta name="data science, digital, engineering, information systems, technology">
    <link rel="shortcut icon" type="image/png" href="img/favicon.svg">
    
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css?9812">
    <link rel="stylesheet" type="text/css" href="css/style2.css?7935">
    <link rel="stylesheet" type="text/css" href="./css/ionicons.min.css">
    <link href='https://fonts.googleapis.com/css?family=Quicksand:300,400,500,600,700,40&display=swap&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
				<div class="text-sm-start pt-lg-4 pb-lg-4 ps-lg-5 pe-lg-5 busine-signup-ima">
					<h1 class="float-lg-none ms-lg-0 tc-196 mb-lg-4 h4-style mb-0 float-sm-none">
						Connecting you to a pool of specialised and growing database of the best talent the Vico.net community has to offer.
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
					<div class="row align-items-start d-lg-flex   d-none pb-lg-5 ps-lg-4 pe-lg-4">
						<div class="col align-self-center">
							<img onclick="history.back()" src="img/lazyload-ph.png" data-src="img/back.svg" class="img-fluid mx-auto d-block img-style ms-lg-0 me-lg-0 me-md-1 ms-md-1 lazyload" alt="back" width="44" height="42">
						</div>
						<div class="col text-lg-end head-nav-logo align-self-center">
							<img src="img/lazyload-ph.png" data-src="img/logo.svg" class="img-fluid mx-auto d-block ms-lg-0 me-lg-0 ms-md-0 me-md-0 lazyload" alt="logo" width="179" height="66">
						</div>
					</div>
				</div>
				<div class="ps-lg-4 pe-lg-4">
					<h5 class="h1-style mb-md-5 mt-md-4 mt-sm-4 mb-4 mt-0 mb-lg-0">
						Business Login
					</h5>
					
					<div class="mt-lg-4">
						<form method="post" action="">
							<div><?php echo $disp ?></div>
						<div class="row">
							<div class="offset-0 col-12 col-sm-6 offset-lg-0 col-lg-12">
								<div class="form-group mb-3">
									<label class="form-label text-p">
										Email
									</label>
		 							<input name="user_email" id="user_email" oninput="checkEmail()" class="form-control text-fl cust-input" type="email" data-error-validation-msg="Not a valid email address">
									<div class="error-message"></div>
								</div> 
							</div>
							<div class="offset-0 col-12 col-sm-6 offset-lg-0 col-lg-12">
								<div class="form-group mb-3">
									<label class="form-label text-p">
										Password
									</label>
									<input class="form-control text-fl" name="user_password" type="password">
								</div>
							</div>
							<div class="offset-lg-0 col-lg-12">
								<p class="p-style">
									<a class="a-link" href="forgot-password?t=<?php echo $type?>">Forgot password</a><br>
								</p>
							</div>
							<div class="col">
								<button name="corp_login" id="login_btn" class="btn btn-d w-100 btn-lg mb-md-3 btn-12">Login</button>
								<p class="p-style mt-lg-3">
									Don't have an account? <a class="a-link" href="sign-up">Sign Up</a>
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
<script src="./js/bootstrap.bundle.min.js?2680"></script>
<script src="./js/blocs.min.js?2120"></script>
<script src="./js/lazysizes.min.js" defer></script>
<script type="text/javascript" src="js/corp-loginval.js"></script>
<script src="js/button_click.js"></script><!-- Additional JS END -->


</body>
</html>
