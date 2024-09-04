<?php
session_start();

$title = "";
$date="";
$content="";
$authors = "";
$img="";
$id=""; 
$count = 0;
?>
<!DOCTYPE html>
<html lang="zxx">
   <head>
<?php
include "head.php";
include '../include/connect.php';
include 'assets/classes/auth.php';
require_once 'assets/classes/functions.php';
$webinar = new webinars($db);
$candidate = new Candidates($db);
$staff = new Staff($db);
$insight = new Insight($db);
$staff->setStaffData($_SESSION['staff_id']);
$landing = new LandingPage($db);
//ASSIGNING VALUES
if(isset($_GET['id']))
{
$insight->setInsight($_GET['id']);
$title = $insight->getTitle();
$date=$insight->getDate();
$content=$insight->getContent();
$authors = $insight->getAuthor();
$img = "../img/".$insight->getImage();
$id = $_GET['id'];
}


if(isset($_POST['p_link'])){
$podcast_link = $_POST['p_link']; // Podcast youtube link
}
else{
$podcast_link = ""; // Podcast youtube link
}

if(isset($_POST['guest_name'])){
$podcast_guest = $_POST['guest_name']; //Guest name
}
else{
	$podcast_guest = ""; //Guest name
}

include "assets/classes/save_podcast_image.php";
$filename = $_SESSION['filename'];// making file name global

if(isset($_POST['p_name'])){
$podcast_name = $_POST['p_name']; //Name or podcast number
}
else{
$podcast_name = ""; //Name or podcast number
}

if(isset($_POST['send_podcast'])){

	include "broadcast.php";
   unset($_SESSION['filename']);
}
else if(isset($_POST['podcast_preview'])){

}
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
         
         <div class="page-content">
          <?php
          include "header.php";
          ?>
            <!--/ Page Header End -->   
            <!--================================-->
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
                        <h1 class="pd-0 mg-0 tx-20">Create Buzz Podcast Broadcast</h1>
                        <?php if($count != 0)
                        {
                        	echo '<div class="alert alert-success alert-dismissible" role="alert">'.$count.' Emails successfully sent out</div>';
                        } 
                        ?>
                     </div>
                     <div class="breadcrumb pd-0 mg-0">
                        <a class="breadcrumb-item" href="podcast-report"><i class="icon ion-ios-home-outline"></i>podcast</a>
                        
                        <span class="breadcrumb-item active">Create Buzz Podcast Broadcast</span>
                     </div>
                  </div>
                  <!--/ Breadcrumb End -->
              
                  <div class="row row-xs clearfix">
                     <!--================================-->
                     
                     
                     <!--================================-->
                     <!-- Student Details Start -->
                     <!--================================-->
                    
                    
                     <div class="col-lg-12">
                        <div class="card mg-b-20">
                           <div class="card-header">
                              <h4 class="card-header-title">
                                Create Buzz Podcast Broadcast
                              </h4>
                              <div class="card-header-btn">
                                 <a  href="" data-toggle="collapse" class="btn card-collapse" data-target="#studentDetails" aria-expanded="true"><i class="ion-ios-arrow-down"></i></a>
                                 <a href="" data-toggle="refresh" class="btn card-refresh"><i class="ion-android-refresh"></i></a>
                                 <a href="" data-toggle="expand" class="btn card-expand"><i class="ion-android-expand"></i></a>
                                 <a href="" data-toggle="remove" class="btn card-remove"><i class="ion-android-close"></i></a>
                              </div>
                           </div>
                              <div class="col-lg-12">
                                 <form action="create_podcast" method="post" name="myForm" id="myForm" enctype="multipart/form-data">
                               <div class="row">
                        		<div class="col-lg-6">
                              	<label class="form-control-label" for="p_name">Podcast Image</label>
                                 <div >
                                    <img class="display-image" id="display_image1" src="<?php echo $img ?>">                      
                                    <input type="file" class="form-control" id="insight_pic1" accept="image/*"  onchange="loadFile1(event)" name="podcast_pic"/>
                                 </div>
                             
                            </div>
                            <div class="col-lg-6">
                         <label class="form-control-label" for="p_name">Podcast Name</label>
                            <input id="p_name" value="<?php echo $podcast_name ?>" type="text" name="p_name" class="form-control" placeholder="Enter podcast name">
                         </div>
                         <div class="col-lg-6">
                           <label class="form-control-label" for="p_link">Podcast link</label>
                               <input id="p_link" value="<?php echo $podcast_link; ?>" type="text" name="p_link" class="form-control" placeholder="Enter podcast link">
                         </div>                     
                           <div class="col-lg-12">
                               <label class="form-control-label" for="guest_name">Guest Information</label>
                               <input id="guest_name" type="text" placeholder="Enter guest information" value="<?php echo $podcast_guest ?>" name="guest_name" class="form-control" >
                           </div>
                           <div class="col-lg-6">
                           <button type="submit" name="send_podcast" class="btn btn-primary" style="width: 100%; margin-bottom: 10px;margin-top: 10px;">Send Broadcast</button>
                           </div>
    						<div class="col-lg-6">
    						<button type="" name="podcast_preview" class="btn btn-secondary" style="width: 100%; margin-bottom: 10px;margin-top: 10px;">Preview Broadcast</button>
    						</div>                               
                             </div>
                            </div>
                          </div>
                                                   
                          </div>
                     
                         <div class="col-lg-12">           
                            <div id="preview">
                            <h4>Podcast Preview</h4>
                              <?php
                              include "podcast_email_view.php";
                              ?>
                              </div>
                      	</div>
                      </form>                        
                        
                    
                          
                     <!--/ Student Details End -->
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
                   <p class="pd-y-10 mb-0">Copyright&copy; 2022 | All rights reserved. | Created By <a href="#" target="_blank">TTCH Technologies</a></p>
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
      <!-- Modal -->
         
      <!--================================-->	  
  
      <!-- Footer Script -->
      <!--================================-->
      <script type="text/javascript">
      $(document).ready(function(){
  //var i=1;
  $('#add_staff').click(function(){
    //i++;
    $.ajax({
      url:"saveStaff.php",
      method:"POST",
      data:$('#myForm').serialize(),
      success:function(data)
      {
     //alert("added");
        $('#myForm')[0].reset();
        //$('#error_mes').html(data);
         document.getElementById('modal_close').click;
      }
    });
  });
});</script>
     <script src="assets/plugins/jquery/jquery.min.js"></script>
      <script src="assets/plugins/jquery-ui/jquery-ui.js"></script>
      <script src="assets/plugins/popper/popper.js"></script>
      <script src="assets/plugins/feather-icon/feather.min.js"></script>
      <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
      <script src="assets/plugins/pace/pace.min.js"></script>
       <script src="assets/plugins/modal/bootbox.js"></script>
      <script src="assets/plugins/modal/ui-modals.js"></script>
       <script src="assets/summernote/summernote.min.js"></script>
      <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
      <script src="assets/plugins/datatables/responsive/dataTables.responsive.js"></script>
      <script src="assets/plugins/datatables/extensions/dataTables.jqueryui.min.js"></script>
      <script src="assets/plugins/dropify/js/dropify.min.js"></script>
      <script src="assets/plugins/simpler-sidebar/jquery.simpler-sidebar.min.js"></script>
      <script src="assets/js/jquery.slimscroll.min.js"></script>
      <script src="assets/js/ckhandler.js"></script>
      <script src="assets/js/highlight.min.js"></script>
      <script src="assets/js/app.js"></script>
      <script src="assets/js/custom.js"></script>
      <script src="assets/js/view-image.js"></script>
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
        <script type="text/javascript">
      $('#scrollableTable').DataTable({
            responsive: true,
            language: {
              searchPlaceholder: 'Search...',
              sSearch: ''
            },
            "order": [[ 1, "desc" ]],
            "scrollY":        "250px",
            "scrollCollapse": true,
            "paging":         false
           });

      </script>
        </body>
</html> 