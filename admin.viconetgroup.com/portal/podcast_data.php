<?php
header('Content-Type: text/html');
include '../include/connect.php';
//include 'assets/classes/auth.php';
//include 'assets/classes/functions.php';
include 'assets/classes/audio_content_class.php';
//$candidate = new Candidates($db);
//$corp = new Corporates($db);
//$staff = new Staff($db);
$content = new Audio_content($db);
//$staff->setStaffData($_SESSION['staff_id']);
$value = urldecode($_GET['value']);

?>
<!--================================-->
<div class="row row-xs clearfix">
 <!--================================-->
 <!-- Count Start -->
 <!--================================-->	
 <div class="col-sm-6 col-xl-3">
    <div class="card mg-b-20">
       <div class="card-body">
          <div class="media d-inline-flex">
             <div>
                <span class="tx-uppercase tx-10 mg-b-10">Number of emails sent</span>					  
                <h2 class="tx-20 tx-sm-18 tx-md-24 mb-0 mt-2 mt-sm-0 tx-normal tx-rubik tx-dark"><span class="counter"><?php echo $content->getNumEmailSent($value)?></span></h2>
             </div>
          </div>
          
          <div class="progress ht-3 op-5">
             <div class="progress-bar bg-primary wd-90p" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
       </div>
    </div>
 </div>
 <div class="col-sm-6 col-xl-3">
    <div class="card mg-b-20">
       <div class="card-body">
          <div class="media d-inline-flex">
             <div>
                <span class="tx-uppercase tx-10 mg-b-10">Failed emails</span>					  
                <h2 class="tx-20 tx-sm-18 tx-md-24 mb-0 mt-2 mt-sm-0 tx-normal tx-rubik tx-dark"><span class="counter"><?php echo $content->getNumberOfFailedJobs($value) ?></span> </h2>
             </div>
          </div>
        
          <div class="progress ht-3 op-5">
             <div class="progress-bar bg-warning wd-95p" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
       </div>
    </div>
 </div>
 <div class="col-sm-6 col-xl-3">
    <div class="card mg-b-20">
       <div class="card-body">
          <div class="media d-inline-flex">
             <div>
                <span class="tx-uppercase tx-10 mg-b-10">Opened emails</span>                 
                <h2 class="tx-20 tx-sm-18 tx-md-24 mb-0 mt-2 mt-sm-0 tx-normal tx-rubik tx-dark"><span class="counter"><?php echo $content->countOpenedEmails($value) ?></span> </h2>
             </div>
          </div>
        
          <div class="progress ht-3 op-5">
             <div class="progress-bar bg-warning wd-95p" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
       </div>
    </div>
 </div>
 <div class="col-sm-6 col-xl-3">
    <div class="card mg-b-20">
       <div class="card-body">
          <div class="media d-inline-flex">
             <div>
                <span class="tx-uppercase tx-10 mg-b-10">Open rate</span>                
                <h2 class="tx-20 tx-sm-18 tx-md-24 mb-0 mt-2 mt-sm-0 tx-normal tx-rubik tx-dark"><span class="counter"><?php echo $content->getOpenedEmailRate($value) ?> </span>% </h2>
             </div>
          </div>
        
          <div class="progress ht-3 op-5">
             <div class="progress-bar bg-warning wd-95p" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
       </div>
    </div>
 </div>
 <!--
 <div class="col-sm-6 col-xl-3">
    <div class="card mg-b-20">
       <div class="card-body">
          <div class="media d-inline-flex">
             <div>
                <span class="tx-uppercase tx-10 mg-b-10">Unsubscriptions</span>               
                <h2 class="tx-20 tx-sm-18 tx-md-24 mb-0 mt-2 mt-sm-0 tx-normal tx-rubik tx-dark"><span class="counter"><?php //echo $staff->getNumStaff() ?></span> </h2>
             </div>
          </div>
         
          <div class="progress ht-3 op-5">
             <div class="progress-bar bg-danger wd-80p" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
       </div>
    </div>
 </div>-->

                     <!--/ Count End -->
</div>
<!--/ Count Card End -->