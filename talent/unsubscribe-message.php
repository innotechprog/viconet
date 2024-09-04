<?php
session_start();
include "head.php";
include "include/connect.php";
include "include/functions.php";
$candidate = new Candidates($db);
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
	<meta name="robots" content="index, follow">
    <link rel="shortcut icon" type="image/png" href="favicon.png">    
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css?7197">
       <link href="css/style2.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/ionicons.min.css">
	<link href='https://fonts.googleapis.com/css?family=Quicksand:300,400,500,600,700,40&display=swap&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <title>Subscriptions</title>    
<!-- Analytics -->
 
<!-- Analytics END -->
    
</head>
<body>

<!-- Preloader -->
<div id="page-loading-blocs-notifaction" class="page-preloader"></div>
<!-- Preloader END -->


<!-- Main container -->
<div class="page-container">
    
<!-- container-f -->
<div class="bloc bg-bg d-bloc full-width-bloc bloc-fill-screen" id="container-f">
	<div class="container">
		<div class="row">
			<div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 text-start col-lg-4 offset-lg-4">
				<div class="card-f">
					<div class="row">
						<div class="col align-self-center">
							<img src="img/lazyload-ph.png" data-src="img/logo.svg" class="img-fluid mx-auto d-block mb-lg-3 lazyload" alt="logo" width="179" height="66">
							<?php if(!isset($_GET['sucm'])){
								$enemail = $_GET['em'];
								$_SESSION['id']=$enemail;
								$access = $_GET['access'];
								$subscrType = $_GET['ty'];
								$gateway = md5("subscr");
							 ?>
							<div class="row">
								<div class="col-lg-12">
									<label class="l-16"><strong>Unsubscribe from receiving <?php echo $candidate->checkSubscrType($subscrType); ?> notifications</strong></label>
									<form action="updateSubscription" method="post">
										<input type="hidden" name="gtway" value="<?php echo $gateway ?>">
										<input type="hidden" name="id" value="<?php echo $subscrType; ?>">
										<input type="hidden" name="enemail" value="<?php echo $enemail; ?>">
										<div class="form-check">							
									      <input class="form-check-input rbtn" type="radio" name="subscrMessage" id="radioOption1" value="Irrelevant emails">
									      <label class="form-check-label text-black" for="radioOption1">Irrelevant emails</label>
									    </div>
									    <div class="form-check">							
									      <input class="form-check-input rbtn" type="radio" name="subscrMessage" value="Do not like the content shared">
									      <label class="form-check-label text-black" for="radioOption1">Do not like the content shared</label>
									    </div>
									    <div class="form-check">							
									      <input class="form-check-input rbtn" type="radio" id="otherOption" name="subscrMessage" value="Other">
									      <label class="form-check-label text-black" for="otherOption">Other</label>
									    </div>
									     <div id="otherText" class="hidden form-group">
									      <label for="otherText">Please specify:</label>
									      <textarea name="otherText" placeholder="Please enter your reason" id="otherTextArea" class="cust-input" rows="3"></textarea>
									    </div>
									    <hr>
									    <button type="submit" class="btn btn-d btn-lg mb-md-2 mb-sm-2 btn-12 float-lg-none mt-lg-0 w-100">Unsubscribe</button>
									</div>
									</form>
								</div>
							</div>
						<?php }
						else{
							?><div class="row">
								<div class="col">
									<img  src="img/lazyload-ph.png" data-src="img/animation_lkb7ocgd_small.gif" class="img-fluid mx-auto  d-block img-succe-style lazyload" alt="animation_lkb7ocgd_small" width="92" height="92">
									<center><label class="l-16 mx-auto"><strong>Successfully removed from subscription</strong></label></center><br>
											
									<a href="index" class="btn btn-d btn-lg mb-md-2 mb-sm-2 btn-12 float-lg-none mt-lg-0 w-100">Home</a>
								</div>
							</div>
							<?php } ?>
					</div>
				</div>
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
<script src="./js/bootstrap.bundle.min.js?7548"></script>
<script src="./js/blocs.min.js?5719"></script>
<script src="./js/toggle-select-other.js"></script>
<script src="./js/lazysizes.min.js" defer></script><!-- Additional JS END -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>





