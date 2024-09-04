<?php
include "include/connect.php";
include "head.php";
?>
<!doctype html>
<html>
<head>
      <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="robots" content="index, follow">
    <title>Vico.net | Forgot Password</title>
<meta content="Our platform connects you with data science, digital, engineering, information systems, technology and analytical group of professionals critical to the future of work and business solutions." name="">
<meta name="data science, digital, engineering, information systems, technology">
    <link rel="shortcut icon" type="image/png" href="img/favicon.svg">
    
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css?9812">
    <link rel="stylesheet" type="text/css" href="css/style2.css?7935">
    <link rel="stylesheet" type="text/css" href="./css/ionicons.min.css">
    <link href='https://fonts.googleapis.com/css?family=Quicksand:300,400,500,600,700,40&display=swap&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



    
<!-- Analytics -->
 
<!-- Analytics END -->
    
</head>
<body>

<!-- Preloader -->
<div id="page-loading-blocs-notifaction" class="page-preloader"></div>
<!-- Preloader END -->
<?php 
$email=$_GET['em'];
$encry = $_GET['salt'];
$type = $_GET['ty'];

$query=$db->prepare("select * from pass_encry where email='$email' ");
$query->execute();
$row = $query->fetch();

?>

<!-- Main container -->
<div class="page-container">
    
<!-- container-f -->
<div class="bloc bg-bg d-bloc full-width-bloc bloc-fill-screen" id="container-f">
	<div class="container">
		<div class="row">
			<div class="" id="pass_input">
			<div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 text-start col-lg-5 offset-lg-4">
				<div class="card-f">
					<div class="row">
						
						<div class="col align-self-center">
							<img src="img/lazyload-ph.png" data-src="img/logo.svg" class="img-fluid float-lg-end lazyload" alt="logo" width="179" height="66">
						</div>
					</div>
					<div class="row">
						<div class="col mt-lg-3">
							
			
			<h5 class="h1-style mb-md-5 mt-md-4 mt-sm-4 mb-4 mt-0 mb-lg-0">
								Forgot Your Password?
							</h5>
							<p class="p-style mt-lg-4 mb-md-4 mt-sm-3 mt-4 mb-4">
								Enter the email address that you used to sign up with the Viconet and we'll send you a secure link to reset your password.
							</p>	
			<?php 
				if($row['encry'] == $encry)
				{
					?>
			<form  method="post" id="myForm" name="myForm">
				<div class="row">
					<div class="col-lg-12 form-group">
						<label for="userPassword"class="input-label">Password</label>
						<input type="Password" id="userPassword" name="userPassword" onfocus="checkPassword()" class="cust-input " placeholder="Enter Password">
						<div id="error_m" class="error-message">
							<h5>Password must contain the following:</h5>
							  <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
							  <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
							  <p id="number" class="invalid">A <b>number</b></p>
							  <p id="chars" class="invalid">A <b>special character</b></p>
							  <p id="length" class="invalid">Minimum <b>8 characters</b></p>
						</div>

					</div>

					<div class="col-lg-12 form-group">
						<label for="userConfPassword" class="input-label">Confirm Password</label>
						<input type="password" id="userConfPassword" name="userConfPassword" oninput="checkConfirmPassword()" class="cust-input " placeholder="Confirm Password">
						<div class="error-message"></div>
					</div>
					<input type="hidden" name="email" value="<?php echo $email ?>">
					<input type="hidden" name="type" value="<?php echo $type ?>">
					<div class="col-lg-12 form-group">
						<button type="button" class="bton btn2"style="width: 100%" name="resetBtn" id="resetBtn">RESET</button>
					</div>
					<div class="col-lg-12 form-group">
						
                
					</div>
					<hr>
					
					
				</div>
			</form>
			<?php
			}
			else{
				echo '<div class="alert alert-danger alert-dismissible" role="alert">
	          LInk has expired.
	        </div>';
			}
			?>
		</div>
			</div>
			</div>
		</div>
	</div>
		
<div class="" id="reset_mes">
		<div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 text-start col-lg-4 offset-lg-4">
				<div class="card-f">
					<div class="row">
						<div class="col align-self-center">
							<img src="img/lazyload-ph.png" data-src="img/logo.svg" class="img-fluid mx-auto d-block mb-lg-3 lazyload" alt="logo" width="179" height="66">
							<div class="row">
								<div class="col">
									<img  src="img/lazyload-ph.png" data-src="img/animation_lkb7ocgd_small.gif" class="img-fluid mx-auto  d-block img-succe-style lazyload" alt="animation_lkb7ocgd_small" width="92" height="92">
									<p style="white-space:inherit;" class="p-style  mb-md-4 mb-4 text-lg-center mt-lg-0 mt-md-0 float-md-none text-md-center text-sm-center mt-sm-0 text-center mt-0 ">
										<strong >Your password has been reset</strong>
									</p>
								</div>
							</div><a href="index" class="btn btn-d btn-lg mb-md-2 mb-sm-2 btn-12 float-lg-none mt-lg-0 w-100">Login</a>
						</div>
					</div>
				
</div>
		
					
</div>
<!-- container-f END -->

<!-- ScrollToTop Button -->
<button aria-label="Scroll to top button" class="bloc-button btn btn-d scrollToTop" onclick="scrollToTarget('1',this)"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 32 32"><path class="scroll-to-top-btn-icon" d="M30,22.656l-14-13-14,13"/></svg></button>
<!-- ScrollToTop Button END-->


</div>
<!-- Main container END -->
    


<!-- Additional JS -->
<script src="./js/bootstrap.bundle.min.js?6274"></script>
<script src="./js/blocs.min.js?4267"></script>
<script src="./js/lazysizes.min.js" defer></script>
<script type="text/javascript" src="js/form-submit.js"></script>
<script type="text/javascript" src="js/pass-reset-val.js"></script>
<!-- Additional JS END -->


</body>
</html>
 