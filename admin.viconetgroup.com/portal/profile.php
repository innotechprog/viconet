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
   $webinar = new webinars($db);
   $candidate = new Candidates($db);
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
                        <h1 class="pd-0 mg-0 tx-20">MY PROFILE</h1>
                     </div>
                     <div class="breadcrumb pd-0 mg-0">
                        <a class="breadcrumb-item active" href="index.html"><i data-feather="user"></i> PROFILE</a>
                    
                        
                     </div>
                  </div>
                  <!--/ Breadcrumb End -->
                  <!--================================-->
                  <!-- Count Card Start -->
                  <!--================================-->
                                        <!--================================-->
                     <!-- Count Start -->
                     <!--================================-->
                      <form name="myForm" id="myForm" method="post" enctype="multipart/form-data">	
                         <div class="row row-xs clearfix">

                     <div class="col-sm-6 col-xl-3">
                        <div class="card mg-b-20">
                           <div class="card-body text-center">
                              <label class="profile-pic" for="insight_pic">
                                   
                                     <label class="user-initials" id="user_ini"> <?php echo substr(strtoupper($staff->getName()),0,1).substr(strtoupper($staff->getSurname()),0,1); ?></label>
                                   
                                  <img class="" id="display_image" src="assets/images/<?php echo $staff->getPP(); ?>">
                               
                              </label>
                     
                                   
                                    
                                    <input type="file" class="form-control" id="insight_pic" accept="image/*" onchange="loadFile(event)" name="insight_pic"/>
                               
                            </div>
                        </div>
                     </div>
                     <div class="col-sm-6 col-xl-9">
                        <div class="card mg-b-20">
                           
                              <div class="edit-frame">
                                 <div class="row">
                                    <div class="col-lg-12">
                                          <h4 style="margin-top:10px">Personal Information</h4>
                                       </div>
                                    <div class="col-lg-6">
                                        <label class="form-control-label" for="staff_surname">Surname</label>
                                           <input id="staff_surname" value="<?php echo $staff->getSurname() ?>" type="text" name="staff_surname" class="form-control" placeholder="Enter staff surname...">
                                     </div>
                                     <div class="col-lg-6">
                                       <label class="form-control-label" for="staff_name">First Name</label>
                                           <input id="staff_name" type="text" name="staff_name" value="<?php echo $staff->getName() ?>" class="form-control" placeholder="Enter staff first name...">
                                     </div>
                                       <div class="col-lg-5">
                                           <label class="form-control-label" for="staff_email">Email</label>
                                           <input id="staff_email" disabled type="Email" value="<?php echo $staff->getEmail() ?>" name="staff_email" class="form-control" >
                                       </div>
                                        <div class="col-lg-4">
                                           <label class="form-control-label" for="staff_cellphone">Cellphone</label>
                                           <input id="staff_cellphone" type="text" value="<?php echo $staff->getCell() ?>" name="staff_cellphone" class="form-control" >
                                       </div>
                                        <div class="col-lg-3">
                                           <label class="form-control-label" for="staff_position">Position</label>
                                           <input type="text" name="position" disabled value="<?php echo $staff->getPos() ?>" class="form-control">
                                       </div>
                                       <div class="col-lg-12">
                                          <h4 style="margin-top:10px">Address</h4>
                                       </div>
                                       <div class="col-lg-12">
                                          <input type="hidden" name="sid" value="<?php echo $staff->getID() ?>">
                                       </div>
                                       <div class="col-lg-12">
                                          <input type="hidden" name="pp" value="<?php echo $staff->getPP() ?>">
                                       </div>
                                        <div class="col-lg-12">
                                        <label class="form-control-label" for="staff_surname">Physical Address</label>
                                           <input id="staff_surname" value="<?php echo $staff->getSurname() ?>" type="text" name="" class="form-control" placeholder="Enter staff surname...">
                                     </div>
                                      <div class="col-lg-6">
                                        <label class="form-control-label" for="staff_surname">city</label>
                                           <input id="staff_surname" value="<?php echo $staff->getSurname() ?>" type="text" name="" class="form-control" placeholder="Enter staff surname...">
                                     </div>
                                      <div class="col-lg-6">
                                        <label class="form-control-label" for="staff_surname">Country</label>
                                           <input id="staff_surname" value="<?php echo $staff->getSurname() ?>" type="text" name="" class="form-control" placeholder="Enter staff surname...">
                                     </div>
                                 
                                 </div>
                              
                              <div class="modal-footer">
                             
                                 <button type="button" id="save_edit" class="btn btn-primary">Save</button>
                              </div>
                           
                        </div>
                     </div>
                   
                     <!--/ Count End -->
                  </div>
                  </div>
               <!--/ Main Wrapper End -->
                  </form>
                  <!--/ Count Card End -->
                 
               
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
      <script type="text/javascript">
      
         if(document.getElementById('display_image').getAttribute('src')==""){
             document.getElementById('display_image').style.display = "none";
         }
         else{
            document.getElementById('display_image').style.display = "block";
            document.getElementById('user_ini').style.display = "none";
         }
      
        function changePicture(){
            if(document.getElementById('insight_pic').value==""){
            document.getElementById('display_image').style.display = "none";
         }
         else{
            document.getElementById('display_image').style.display = "block";
            document.getElementById('user_ini').style.display = "none";
         }
      }
      document.getElementById('insight_pic').oninput =function(){
         changePicture();
          
        $.ajax({
            url: "savePP.php", 
            type: "POST",
            dataType: "JSON",             
            data: new FormData(myForm),
            contentType: false,       
            cache: false,             
            processData:false, 
            success: function(data){
              $("#myForm").html(data);               
            }
        });
    
      }
      $(document).ready(function(){
  //var i=1;
  $('#save_edit').click(function(){
     $.ajax({
            url: "savePP.php", 
            type: "POST",
            dataType: "JSON",             
            data: new FormData(myForm),
            contentType: false,       
            cache: false,             
            processData:false, 
            success: function(data){
              $("#myForm").html(data);               
            }
        });
  });
});
      </script>
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
       <script src="assets/js/view-image.js"></script>

   </body>
</html>