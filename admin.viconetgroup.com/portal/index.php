<?php
session_start();
?>
<!DOCTYPE html>
<html lang="zxx">
   <head>
    <?php 
    include "head.php";
   include '../include/connect.php';
   include 'assets/classes/auth.php';
    include 'assets/classes/functions.php';
   include 'assets/classes/job_posting_class.php';
   $jobPosting = new JobPosting($db);
   $candidate = new Candidates($db);
   $corp = new Corporates($db);
  $staff = new Staff($db);
  $staff->setStaffData($_SESSION['staff_id']);
  $landing = new LandingPage($db);
    ?>

   </head>
   <body>
      <!--================================-->
      <!-- Page Container Start -->
      <!--================================-->
      <div class="page-container">
         <!--================================-->
         <!-- Page Sidebar Start -->

         <!--================================-->
        
            <!--================================-->
            <?php
         include "sidemenu.php";
         ?>
            <!--================================-->
            <!-- Sidebar Footer Start -->
           
         <!--/ Page Sidebar End -->
         <!--================================-->
         <!-- Page Content Start -->
         <!--================================-->
         <div class="page-content">
            <!--================================-->
            <!-- Page Header Start -->
            <!--================================-->
          <?php 
          include "header.php";
          ?>
            <!-- Page Inner Start -->
            <!--================================-->
            <div class="page-inner">
               <!-- Main Wrapper -->
               <div id="main-wrapper">
                  <!--================================-->
                  <!-- Breadcrumb Start -->
                  <!--================================-->
                  <div class="pageheader pd-t-25 pd-b-35">
                     <div class="pd-t-5 pd-b-5">
                        <h1 class="pd-0 mg-0 tx-20">Dashboard</h1>
                     </div>
                     <div class="breadcrumb pd-0 mg-0">
                        <a class="breadcrumb-item active" href="index.html"><i class="icon ion-ios-home-outline"></i> Dashboard</a>
                    
                        
                     </div>
                  </div>
                  <!--/ Breadcrumb End -->
                  <!--================================-->
                  <!-- Count Card Start -->
                  <!--================================-->
                  <h1 class="pd-0 mg-0 tx-20">Platform Talent</h1>
                  <br>
                    <div class="row row-xs clearfix">

                     <!--================================-->
                     <!-- Count Start -->
                     <!--================================-->	
                     <!--<div class="col-sm-6 col-xl-3">
                        <div class="card mg-b-20">
                           <div class="card-body">
                              <div class="media d-inline-flex">
                                 <div>
                                    <span class="tx-uppercase tx-10 mg-b-10">Companies</span>					  
                                    <h2 class="tx-20 tx-sm-18 tx-md-24 mb-0 mt-2 mt-sm-0 tx-normal tx-rubik tx-dark"><span class="counter"><?php //echo $corp->getNumCorporates()?></span></h2>
                                 </div>
                              </div>
                              
                              <div class="progress ht-3 op-5">
                                 <div class="progress-bar bg-primary wd-90p" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                           </div>
                        </div>
                     </div>-->
                     <div class="col-sm-6 col-xl-3">
                        <div class="card mg-b-20">
                           <div class="card-body">
                              <div class="media d-inline-flex">
                                 <div>
                                    <span class="tx-uppercase tx-10 mg-b-10">Total Talent on the Platform</span>					  
                                    <h2 class="tx-20 tx-sm-18 tx-md-24 mb-0 mt-2 mt-sm-0 tx-normal tx-rubik tx-dark"><span class="counter"><?php echo $candidate->getNumCandi() ?></span> </h2>
                                 </div>
                              </div>
                            
                              <div class="progress ht-3 op-5">
                                 <div class="progress-bar bg-warning wd-95p" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <a href="candidates" class="btn btn-primary mt-2">Show more...</a>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-6 col-xl-3">
                        <div class="card mg-b-20">
                           <div class="card-body">
                              <div class="media d-inline-flex">
                                 <div>
                                    <span class="tx-uppercase tx-10 mg-b-10">Pending Email Verification</span>                
                                    <h2 class="tx-20 tx-sm-18 tx-md-24 mb-0 mt-2 mt-sm-0 tx-normal tx-rubik tx-dark"><span class="counter"><?php echo $candidate->countNumCand("pending") ?></span> </h2>
                                 </div>
                              </div>
                            
                              <div class="progress ht-3 op-5">
                                 <div class="progress-bar bg-warning wd-95p" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <a href="candidates?st=<?php echo md5('Pending');?>" class="btn btn-primary mt-2">Show more...</a>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-6 col-xl-3">
                        <div class="card mg-b-20">
                           <div class="card-body">
                              <div class="media d-inline-flex">
                                 <div>
                                    <span class="tx-uppercase tx-10 mg-b-10">Email Verified, Profile Incomplete</span>                
                                    <h2 class="tx-20 tx-sm-18 tx-md-24 mb-0 mt-2 mt-sm-0 tx-normal tx-rubik tx-dark"><span class="counter"><?php echo $candidate->countNumCand("process") ?></span> </h2>
                                 </div>
                              </div>
                            
                              <div class="progress ht-3 op-5">
                                 <div class="progress-bar bg-warning wd-95p" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <a href="candidates?st=<?php echo md5('process');?>" class="btn btn-primary mt-2">Show more...</a>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-6 col-xl-3">
                        <div class="card mg-b-20">
                           <div class="card-body">
                              <div class="media d-inline-flex">
                                 <div>
                                    <span class="tx-uppercase tx-10 mg-b-10">Google Verified, Profile Incomplete</span>                
                                    <h2 class="tx-20 tx-sm-18 tx-md-24 mb-0 mt-2 mt-sm-0 tx-normal tx-rubik tx-dark"><span class="counter"><?php echo $candidate->countNumCand("google-process") ?></span> </h2>
                                 </div>

                              </div>
                            
                              <div class="progress ht-3 op-5">
                                 <div class="progress-bar bg-warning wd-95p" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <a href="candidates?st=<?php echo md5('google-process');?>" class="btn btn-primary mt-2">Show more...</a>
                           </div>
                        </div>
                     </div>
                     <!--<div class="col-sm-6 col-xl-3">
                        <div class="card mg-b-20">
                           <div class="card-body">
                              <div class="media d-inline-flex">
                                 <div>
                                    <span class="tx-uppercase tx-10 mg-b-10">Total Completed profile</span>                
                                    <h2 class="tx-20 tx-sm-18 tx-md-24 mb-0 mt-2 mt-sm-0 tx-normal tx-rubik tx-dark"><span class="counter"><?php //echo $candidate->countNumCand("verified") ?></span> </h2>
                                 </div>
                              </div>
                            
                              <div class="progress ht-3 op-5">
                                 <div class="progress-bar bg-warning wd-95p" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <a href="candidates?st=<?php //echo md5('verified');?>" class="btn btn-primary mt-2">Show more...</a>
                           </div>
                        </div>
                     </div>-->
                     <div class="col-sm-6 col-xl-3">
                        <div class="card mg-b-20">
                           <div class="card-body">
                              <div class="media d-inline-flex">
                                 <div>
                                    <span class="tx-uppercase tx-10 mg-b-10">Total Imported Talent</span>                
                                    <h2 class="tx-20 tx-sm-18 tx-md-24 mb-0 mt-2 mt-sm-0 tx-normal tx-rubik tx-dark"><span class="counter"><?php echo $candidate->countNumCandPerAddedBy('Import') ?></span> </h2>
                                 </div>
                              </div>
                              
                              <div class="progress ht-3 op-5">
                                 <div class="progress-bar bg-teal wd-85p" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                     
                   <div class="col-sm-6 col-xl-3">
                        <div class="card mg-b-20">
                           <div class="card-body">
                              <div class="media d-inline-flex">
                                 <div>
                                    <span class="tx-uppercase tx-10 mg-b-10">Talent registered through the app form</span>                
                                    <h2 class="tx-20 tx-sm-18 tx-md-24 mb-0 mt-2 mt-sm-0 tx-normal tx-rubik tx-dark"><span class="counter"><?php echo $candidate->countNumCandPerAddedBy('System') ?></span> </h2>
                                 </div>
                              </div>                              
                              <div class="progress ht-3 op-5">
                                 <div class="progress-bar bg-teal wd-85p" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="col-sm-6 col-xl-3">
                        <div class="card mg-b-20">
                           <div class="card-body">
                              <div class="media d-inline-flex">
                                 <div>
                                    <span class="tx-uppercase tx-10 mg-b-10">Talent registered through google sign up</span>                
                                    <h2 class="tx-20 tx-sm-18 tx-md-24 mb-0 mt-2 mt-sm-0 tx-normal tx-rubik tx-dark"><span class="counter"><?php echo $candidate->countNumCandPerAddedBy('google-signup') ?></span> </h2>
                                 </div>
                              </div>
                              
                              <div class="progress ht-3 op-5">
                                 <div class="progress-bar bg-teal wd-85p" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-6 col-xl-3">
                        <div class="card mg-b-20">
                           <div class="card-body">
                              <div class="media d-inline-flex">
                                 <div>
                                    <span class="tx-uppercase tx-10 mg-b-10">Job Posting Registrations</span>               
                                    <h2 class="tx-20 tx-sm-18 tx-md-24 mb-0 mt-2 mt-sm-0 tx-normal tx-rubik tx-dark"><span class="counter"><?php echo $jobPosting->totalTalentRegJP('','') ?></span> </h2>
                                 </div>
                              </div>
                             
                              <div class="progress ht-3 op-5">
                                 <div class="progress-bar bg-danger wd-80p" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <a href="job-posting?st=<?php echo md5('process');?>" class="btn btn-primary mt-2">Show more...</a>
                           </div>
                        </div>
                     </div>
                     
                     <div class="col-sm-6 col-xl-3">
                        <div class="card mg-b-20">
                           <div class="card-body">
                              <div class="media d-inline-flex">
                                 <div>
                                    <span class="tx-uppercase tx-10 mg-b-10">Deleted Profiles</span>		  
                                    <h2 class="tx-20 tx-sm-18 tx-md-24 mb-0 mt-2 mt-sm-0 tx-normal tx-rubik tx-dark"><span class="counter"><?php echo 0 ?></span> </h2>
                                 </div>
                              </div>
                             
                              <div class="progress ht-3 op-5">
                                 <div class="progress-bar bg-danger wd-80p" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!--<div class="col-sm-6 col-xl-3">
                        <div class="card mg-b-20">
                           <div class="card-body">
                              <div class="media d-inline-flex">
                                 <div>
                                    <span class="tx-uppercase tx-10 mg-b-10">Staff</span>               
                                    <h2 class="tx-20 tx-sm-18 tx-md-24 mb-0 mt-2 mt-sm-0 tx-normal tx-rubik tx-dark"><span class="counter"><?php //echo $staff->getNumStaff() ?></span> </h2>
                                 </div>
                              </div>
                             
                              <div class="progress ht-3 op-5">
                                 <div class="progress-bar bg-danger wd-80p" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                           </div>
                        </div>
                     </div>-->
                      
                     <!--<div class="col-sm-6 col-xl-3">
                        <div class="card mg-b-20">
                           <div class="card-body">
                              <div class="media d-inline-flex">
                                 <div>
                                    <span class="tx-uppercase tx-10 mg-b-10">Total Talent without cv</span>               
                                    <h2 class="tx-20 tx-sm-18 tx-md-24 mb-0 mt-2 mt-sm-0 tx-normal tx-rubik tx-dark"><span class="counter"><?php //echo $candidate->countTalentWithoutCV() ?></span> </h2>
                                 </div>
                              </div>                             
                              <div class="progress ht-3 op-5">
                                 <div class="progress-bar bg-danger wd-80p" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-6 col-xl-3">
                        <div class="card mg-b-20">
                           <div class="card-body">
                              <div class="media d-inline-flex">
                                 <div>
                                    <span class="tx-uppercase tx-10 mg-b-10">Total Talent with cv</span>               
                                    <h2 class="tx-20 tx-sm-18 tx-md-24 mb-0 mt-2 mt-sm-0 tx-normal tx-rubik tx-dark"><span class="counter"><?php //echo $candidate->countTalentWithCV() ?></span> </h2>
                                 </div>
                              </div>


                             
                              <div class="progress ht-3 op-5">
                                 <div class="progress-bar bg-danger wd-80p" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                           </div>
                        </div>
                     </div>
-->

                     

                                         <!--/ Count End -->
                  </div>
                 

 <hr>
                  <h1 class="pd-0 mg-0 tx-20">Completed Profiles</h1>
                  <br>
                    <div class="row row-xs clearfix">
                     <div class="col-sm-6 col-xl-3">
                        <div class="card mg-b-20">
                           <div class="card-body">
                              <div class="media d-inline-flex">
                                 <div>
                                    <span class="tx-uppercase tx-10 mg-b-10">Total Completed Profile</span>                
                                    <h2 class="tx-20 tx-sm-18 tx-md-24 mb-0 mt-2 mt-sm-0 tx-normal tx-rubik tx-dark"><span class="counter"><?php echo $candidate->countNumCandPerAddedBy('System')+$candidate->countNumCandPerAddedBy('google-signup') + $candidate->countNumActiveCandPerAddedBy('Import') ?></span> </h2>
                                 </div>
                              </div>
                              
                              <div class="progress ht-3 op-5">
                                 <div class="progress-bar bg-teal wd-85p" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="col-sm-6 col-xl-3">
                        <div class="card mg-b-20">
                           <div class="card-body">
                              <div class="media d-inline-flex">
                                 <div>
                                    <span class="tx-uppercase tx-10 mg-b-10">Complete Profiles without CVs</span>               
                                    <h2 class="tx-20 tx-sm-18 tx-md-24 mb-0 mt-2 mt-sm-0 tx-normal tx-rubik tx-dark"><span class="counter"><?php echo $candidate->countTalentWithoutCVNI() ?></span> </h2>
                                 </div>
                              </div>                             
                              <div class="progress ht-3 op-5">
                                 <div class="progress-bar bg-danger wd-80p" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-6 col-xl-3">
                        <div class="card mg-b-20">
                           <div class="card-body">
                              <div class="media d-inline-flex">
                                 <div>
                                    <span class="tx-uppercase tx-10 mg-b-10">Complete Profiles with CVs</span>               
                                    <h2 class="tx-20 tx-sm-18 tx-md-24 mb-0 mt-2 mt-sm-0 tx-normal tx-rubik tx-dark"><span class="counter"><?php echo $candidate->countTalentWithCVNI() ?></span> </h2>
                                 </div>
                              </div>


                             
                              <div class="progress ht-3 op-5">
                                 <div class="progress-bar bg-danger wd-80p" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-6 col-xl-3">
                        <div class="card mg-b-20">
                           <div class="card-body">
                              <div class="media d-inline-flex">
                                 <div>
                                    <span class="tx-uppercase tx-10 mg-b-10">Consented Imported Talent</span>                
                                    <h2 class="tx-20 tx-sm-18 tx-md-24 mb-0 mt-2 mt-sm-0 tx-normal tx-rubik tx-dark"><span class="counter"><?php echo $candidate->countNumActiveCandPerAddedBy('Import') ?></span> </h2>
                                 </div>
                              </div>                              
                              <div class="progress ht-3 op-5">
                                 <div class="progress-bar bg-teal wd-85p" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                     
                  </div>
 <hr>
                  <h1 class="pd-0 mg-0 tx-20">Imported Profiles</h1>
                  <br>
                    <div class="row row-xs clearfix">
                     <div class="col-sm-6 col-xl-3">
                        <div class="card mg-b-20">
                           <div class="card-body">
                              <div class="media d-inline-flex">
                                 <div>
                                    <span class="tx-uppercase tx-10 mg-b-10">Total Imported Talent</span>                
                                    <h2 class="tx-20 tx-sm-18 tx-md-24 mb-0 mt-2 mt-sm-0 tx-normal tx-rubik tx-dark"><span class="counter"><?php echo $candidate->countNumCandPerAddedBy('Import') ?></span> </h2>
                                 </div>
                              </div>
                              
                              <div class="progress ht-3 op-5">
                                 <div class="progress-bar bg-teal wd-85p" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-6 col-xl-3">
                        <div class="card mg-b-20">
                           <div class="card-body">
                              <div class="media d-inline-flex">
                                 <div>
                                    <span class="tx-uppercase tx-10 mg-b-10">Consented Imported Talent</span>                
                                    <h2 class="tx-20 tx-sm-18 tx-md-24 mb-0 mt-2 mt-sm-0 tx-normal tx-rubik tx-dark"><span class="counter"><?php echo $candidate->countNumActiveCandPerAddedBy('Import') ?></span> </h2>
                                 </div>
                              </div>                              
                              <div class="progress ht-3 op-5">
                                 <div class="progress-bar bg-teal wd-85p" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                       <div class="col-sm-6 col-xl-3">
                        <a href="candidates?type=19290604eee3233f77c10a970658725f">
                        <div class="card mg-b-20">
                           <div class="card-body">
                              <div class="media d-inline-flex">
                                 <div>
                                    <span class="tx-uppercase tx-10 mg-b-10">Pending Consent Imported Talent</span>                
                                    <h2 class="tx-20 tx-sm-18 tx-md-24 mb-0 mt-2 mt-sm-0 tx-normal tx-rubik tx-dark"><span class="counter"><?php echo $candidate->countNumPendingCandPerAddedBy('Import') ?></span> </h2>
                                 </div>
                              </div>
                              
                              <div class="progress ht-3 op-5">
                                 <div class="progress-bar bg-danger wd-85p" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                           </div>
                        </div>
                     </a>
                     </div>
                     
                  </div>
                  <hr>
                  <h1 class="pd-0 mg-0 tx-20">Mailing Lists</h1>
                  <br>
                    <div class="row row-xs clearfix">
                  
                     <div class="col-sm-6 col-xl-3">
                        <div class="card mg-b-20">
                           <div class="card-body">
                              <div class="media d-inline-flex">
                                 <div>
                                    <span class="tx-uppercase tx-10 mg-b-10">Podcast Unsubscriptions</span>               
                                    <h2 class="tx-20 tx-sm-18 tx-md-24 mb-0 mt-2 mt-sm-0 tx-normal tx-rubik tx-dark"><span class="counter"><?php echo $staff->getNumStaff() ?></span> </h2>
                                 </div>
                              </div>
                             
                              <div class="progress ht-3 op-5">
                                 <div class="progress-bar bg-danger wd-80p" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-6 col-xl-3">
                        <div class="card mg-b-20">
                           <div class="card-body">
                              <div class="media d-inline-flex">
                                 <div>
                                    <span class="tx-uppercase tx-10 mg-b-10">Talent uploaded cv after reminder</span>               
                                    <h2 class="tx-20 tx-sm-18 tx-md-24 mb-0 mt-2 mt-sm-0 tx-normal tx-rubik tx-dark"><span class="counter"><?php echo $candidate->numTalUploadedCVafterRem() ?></span> </h2>
                                 </div>
                              </div>                 
                             
                              <div class="progress ht-3 op-5">
                                 <div class="progress-bar bg-danger wd-80p" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <a href="reminded-candidates?st=<?php echo md5('process');?>" class="btn btn-primary mt-2">Show more...</a>
                           </div>
                        </div>
                     </div>


                  </div>


                  <!--/ Count Card End -->
                 
               </div>
               <!--/ Main Wrapper End -->
            </div>
            <!--/ Page Inner End -->
            <!--================================-->
            <!-- Page Footer Start -->	
            <!--================================-->
            <footer class="page-footer">
               <div class="pd-t-4 pd-b-0 pd-x-20">
                  <div class="tx-10 tx-uppercase">
                     <p class="pd-y-10 mb-0">Copyright&copy; 2022 | All rights reserved. | Created By <a href="#" target="_blank">Jthoka & Co</a></p>
                  </div>
               </div>
            </footer>
            <!--/ Page Footer End -->		
         </div>
         <!--/ Page Content End -->
      </div>
      <!--/ Page Container End -->
      <!--================================-->
      <!-- Scroll To Top Start-->
      <!--================================-->	
      <a href="" data-click="scroll-top" class="btn-scroll-top fade"><i class="fa fa-arrow-up"></i></a>
      <!--/ Scroll To Top End -->
      <!--================================-->
      <!-- Setting Sidebar Start -->
      <!--================================-->	  
         
      <!--================================-->
     
      <!--================================-->
      <!-- Footer Script -->
      <!--================================-->
      <script src="assets/plugins/jquery/jquery.min.js"></script>
      <script src="assets/plugins/jquery-ui/jquery-ui.js"></script>
      <script src="assets/plugins/popper/popper.js"></script>
      <script src="assets/plugins/feather-icon/feather.min.js"></script>
      <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
      <script src="assets/plugins/pace/pace.min.js"></script>
      <script src="assets/plugins/toastr/toastr.min.js"></script>
      <script src="assets/plugins/countup/counterup.min.js"></script>		
      <script src="assets/plugins/waypoints/waypoints.min.js"></script>	  
      <script src="assets/plugins/apex-chart/apexcharts.min.js"></script>
      <script src="assets/plugins/simpler-sidebar/jquery.simpler-sidebar.min.js"></script>	  
      <script src="assets/js/dashboard/projects-dashboard-init.js"></script>		  
      <script src="assets/js/jquery.slimscroll.min.js"></script>
      <script src="assets/js/highlight.min.js"></script>
      <script src="assets/js/app.js"></script>
      <script src="assets/js/custom.js"></script>
   </body>
</html>