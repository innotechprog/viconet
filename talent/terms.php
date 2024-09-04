<?php
session_start();
include "include/connect.php";
include "include/functions.php";
include "include/create-profile-auth.php";
$candidate->address();
$candidate->getCvData();
?>
<!DOCTYPE html>
<html>
<?php  
include "head.php";
include "new-form-head.php";
?>
<body class="body-b">

<div class="talent-blue-header">
	<div class="prof-container">
		<div class="cont-center col-lg-6">			
		<div class="white-container" id="theform">
			<form name="myForm" id="myForm" action="profileopt" method="post"enctype="multipart/form-data">
				<div class="text-center">
					<div>
						<img src="img/viconet-logo.svg" style="margin-bottom:20px;" width="200px">
					</div>
						<label class="l-18">Popia Consent and T&Cs</label>
					</div>
					<hr>
					<div class="row">
						<div class="offset-lg-0 col-lg-12">
                            <div class="form-check p-style checkbox-input">
                                <input class="form-check-input mb-lg-4 mb-md-3 cust-checkbox" id="consent" name="consent" type="checkbox"><label class="form-check-label checkbox-lbl">I accept <a href="#" class="a-link" data-bs-toggle="modal" data-bs-target="#modal-17155">POPIA consent notice </a></label>
                                <div class="error-message"></div>
                            </div>
                        </div>
                            <div class="offset-lg-0 col-lg-12">
                                <div class="form-check p-style checkbox-input">
                                    <input class="form-check-input mb-lg-4 mb-md-3 mb-sm-3" type="checkbox" id="userT_and_c" name="userT_and_c"><label class="form-check-label checkbox-lbl">I accept <a href="legal documents/CANDIDATE TERMS.pdf" class="a-link" target="blank">terms and condition</a></label> 
                                    <div class="error-message"></div>
                                </div>
                            </div>
                            <div id="modal-17155" class="modal fade" tabindex="-1" role="dialog">
                                    <div class="modal-dialog  modal-dialog-centered" role="document">
                                        <div class="card-f modal-content">
                                            <div class="modal-header">
                                                <label class="form-label h5-style mb-lg-0">Consent Notice
                                                </label><a href="#" class="btn btn-lg close-btn btn-wire" data-bs-dismiss="modal" aria-label="Close"><span ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                                            </svg></span></a>
                                            </div>
                                            <div class="modal-body">
                                                <img src="img/lazyload-ph.png" data-src="img/undraw_accept_terms_re_lj38%202.svg" class="img-fluid mx-auto d-block mb-lg-3 lazyload" alt="undraw_accept_terms_re_lj38%202" width="198" height="141">
                                                <p class="p-style">We respect your privacy and acknowledge that this Candidate / Talent Profile contains personal details, which may belong to you, others and / or to your company.<br><br>By populating this Candidate / Talent Profile, you expressly give us consent to process and further process the Personal Information contained herein which processing will be done in accordance with POPIA.<br>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
					<hr>
				<div class="row">
					<div class="col-lg-12 form-group">
						<div style="overflow:auto;">
							<div style="float:right; margin-left:20px">
								<button type="submit" class="bton btn2" id="next" >Next</button>
							</div>
						</div>						
					</div>
				</div>
			</form>
			</div>
		</div>
	</div>
</div>

</body>
<!-- Javascripts -->
<script src="./js/bootstrap.bundle.min.js?6274"></script>
<script src="./js/blocs.min.js?4267"></script>
<script src="./js/lazysizes.min.js" defer></script><!-- Additional JS END -->
<script type="text/javascript" src="js/terms-validation.js"></script>