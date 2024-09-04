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
       <?php
        include "sidemenu.php";
        ?>
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
            <!--/ Page Header End -->
            <!--================================-->
            <!-- Page Inner Start -->
            <!--================================-->
            <div class="page-inner">
               <!--================================-->
               <!-- Main Wrapper Start -->
               <!--================================-->
               <div id="main-wrapper">
                  <!--================================-->
                  <!-- Breadcrumb Start -->
                  <!--================================-->
                  <div class="pageheader pd-t-25 pd-b-35">
                     <div class="pd-t-5 pd-b-5">
                        <h1 class="pd-0 mg-0 tx-20 text-overflow">Landing page</h1>
                     </div>
                     <div class="breadcrumb pd-0 mg-0">
                        <a class="breadcrumb-item" href="index.html"><i class="icon ion-ios-home-outline"></i> Home</a>
                        
                        <span class="breadcrumb-item active">Landing page</span>
                     </div>
                  </div>
                  <!--/ Breadcrumb End -->
                  <div class="row row-xs clearfix">
                  
                     	
                 	
                    	
                     <!--================================-->
                     <!-- showRemove Start -->
                     <!--================================-->
                     <div class="col-md-12 col-lg-12">
                        <form method="post" name="myForm" id="myForm" enctype="multipart/form-data">
                        <div class="card mg-b-20">
                           <div id="error-message"></div>
                           <div class="card-header">
                              <h4 class="card-header-title">
                                 Landing page content Update
                              </h4>
                              <div class="card-header-btn">
                                 <a  href="" data-toggle="collapse" class="btn card-collapse" data-target="#collapse8" aria-expanded="true"><i class="ion-ios-arrow-down"></i></a>
                                 <a href="" data-toggle="refresh" class="btn card-refresh"><i class="ion-android-refresh"></i></a>
                                 <a href="" data-toggle="expand" class="btn card-expand"><i class="ion-android-expand"></i></a>
                                 <a href="" data-toggle="remove" class="btn card-remove"><i class="ion-android-close"></i></a>
                              </div>
                           </div>
                           <div class="card-body collapse show" id="collapse8">
							    <label class="form-control-label act">Landing page image </label>
                              <input type="file" name="landing_pic" class="dropify" data-show-remove="false"  value="../img/<?php echo $landing->getImg() ?>" />
							
                           </div>
							<div class="col-lg-12">
                                       <div class="form-group mg-b-10-force">
                                          <label class="form-control-label active">Content header </label>
                                          <input class="form-control" type="text" name="content_title" value="<?php echo $landing->getTitle() ?>" placeholder="">
                                       </div>
							</div>
                     <div class="col-lg-12">
                           
                              <input class="form-control" type="hidden" name="file_n" value="<?php echo $landing->getImg() ?>" placeholder="">
                         
                     </div>
							
							<div class="col-lg-12">
                                       <div class="form-group mg-b-10-force">
                                          <label class="form-control-label active">Landing content 1 </label>
                                          <textarea rows="3" class="form-control" name="landing_content" placeholder="Type..."><?php echo $landing->getContent() ?></textarea>
                                       </div>
							</div>
							
						
                                   
                                 
                                    
							<div class="form-layout-footer bd pd-20 bd-t-0">
                                    <button type="button" id="add_content" class="btn btn-custom-primary">Save Changes</button>
                                    
                                 </div>
                        </div>
                     </form>
                     </div>
                     <!--/ showRemove End -->		
                     	
                     
                 
                    			
                  </div>
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
         <!--/ Page Content End  -->
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
      <!-- Footer Script -->
      <!--================================-->
<script type="text/javascript">
    $(document).ready(function(){
  //var i=1;
  $('#add_content').click(function(){
        $.ajax({
            url: "saveLanding.php", 
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
      <script src="assets/plugins/dropify/js/dropify.min.js"></script>
      <script src="assets/plugins/dropzone/dropzone.js"></script>
      <script src="assets/plugins/simpler-sidebar/jquery.simpler-sidebar.min.js"></script>
      <script src="assets/js/jquery.slimscroll.min.js"></script>
      <script src="assets/js/highlight.min.js"></script>
      <script src="assets/js/app.js"></script>
      <script src="assets/js/custom.js"></script>
      <script>
         $('.dropify').dropify({
         	messages: {
         		'default': 'Drag and drop a file here or click',
         		'replace': 'Drag and drop or click to replace',
         		'remove':  'Remove',
         		'error':   'Ooops, something wrong happended.'
         	}
         });
         
      </script>
   </body>
</html>