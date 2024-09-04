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
   include 'assets/classes/audio_content_class.php';
   $webinar = new webinars($db);
   $candidate = new Candidates($db);
   $corp = new Corporates($db);
  $staff = new Staff($db);
  $content = new Audio_content($db);
  $staff->setStaffData($_SESSION['staff_id']);
    ?>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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
                        <h1 class="pd-0 mg-0 tx-20">Broadcasting</h1>
                     </div>
                     <div class="breadcrumb pd-0 mg-0">
                        <a class="breadcrumb-item active" href="index.html"><i class="icon ion-ios-home-outline"></i> Broadcasting</a>                       
                     </div>
                  </div>
                  <div class="row row-xs">
                  	<div class="col-lg-3">
	                  <div class="form-group">
	                  	 <select class="form-control" id="dataSelector">
                           <?php 
                           $query = $content->getPodcasts();
                           for($i = 0; $rows = $query->fetch();$i++)
                           {
                              ?>
                              <option value="<?php echo $rows['email_type'] ?>"><?php echo $rows['email_type'] ?></option>
                              <?php
                           }
                           ?>
	                  	 </select>
	                  </div>
	              	</div>
                  <div class="col-lg-3">
                     <div class="form-group">
                         <a href="create_podcast.php" class="btn btn-primary" >Add podcast</a>
                     </div>
                  </div>
	              </div>
                  <!--/ Breadcrumb End -->
                  <!--================================-->
                 <div id="dataContainer">
                       
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
      <div class="modal" id="m_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel_1" style="display: none;" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel_1">Add podcast </h5>
                  <button type="button" id="modal_close" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true"><i class="ion-ios-close-empty"></i></span>
                  </button>
               </div>
               <form name="myForm" id="myForm" method="post" action="broadcast" enctype="multipart/form-data">
               <div class="modal-body">
                  <div class="row">
                     <div class="col-lg-12">
                         <label class="form-control-label" for="p_name">Podcast Name</label>
                            <input id="p_name" type="text" name="p_name" class="form-control" placeholder="Enter podcast name">
                         </div>
                         <div class="col-lg-12">
                           <label class="form-control-label" for="p_link">Podcast link</label>
                               <input id="p_link" type="text" name="p_link" class="form-control" placeholder="Enter podcast link">
                         </div>
                           <div class="col-lg-12">
                               <label class="form-control-label" for="guest_name">Name of the Guest</label>
                               <input id="guest_name" type="text" placeholder="Enter name of the guest and or titles" name="guest_name" class="form-control" >
                           </div>
                            <div class="col-lg-12">
                               <label class="form-control-label" for="image">Upload image</label>
                               <input id="image" type="file" placeholder="Upload image" name="p_image" class="form-control" >
                           </div>
                  </div>
               </div>
               <div class="modal-footer">              
                  <button type="submit" id="add_podcast" class="btn btn-primary">Post</button>
               </div>
            </form>
            </div>
         </div>
      </div>
      <!--================================-->
     
      <!--================================-->
      <!-- Footer Script -->
      <!--================================--> 
      <script src="assets/plugins/jquery-ui/jquery-ui.js"></script>
      <script src="assets/plugins/popper/popper.js"></script>
      <script src="assets/plugins/feather-icon/feather.min.js"></script>
      <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
      <script src="assets/plugins/pace/pace.min.js"></script>
       <script src="assets/plugins/modal/bootbox.js"></script>
      <script src="assets/plugins/modal/ui-modals.js"></script>
      <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
      <script src="assets/plugins/datatables/responsive/dataTables.responsive.js"></script>
      <script src="assets/plugins/datatables/extensions/dataTables.jqueryui.min.js"></script>
      <script src="assets/plugins/simpler-sidebar/jquery.simpler-sidebar.min.js"></script>
      <script src="assets/js/jquery.slimscroll.min.js"></script>
      <script src="assets/js/highlight.min.js"></script>
    <script src="assets/js/app.js"></script>
      <script>
        // Add an event listener for the change event on the select element
      $(document).ready(function() {
    // Event handler for the change event on the #dataSelector element
    $('#dataSelector').on('change', function() {
        // Get the selected value
        var selectedValue = $(this).val();
        var encoded = encodeURIComponent(selectedValue);
        // Load content based on the selected value
        $('#dataContainer').load('podcast_data.php?value=' + encoded);
    });

    // Trigger the change event when the window loads
    $('#dataSelector').trigger('change');
});

    </script>
   </body>
</html>