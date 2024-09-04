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
   include 'saveWebinar.php';
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
               <!-- Main Wrapper -->
               <div id="main-wrapper">
                  <!--================================-->
                  <!-- Breadcrumb Start -->
                  <!--================================-->
                  <div class="pageheader pd-t-25 pd-b-35">
                     <div class="pd-t-5 pd-b-5">
                        <h1 class="pd-0 mg-0 tx-20">Webinars</h1>
                     </div>
                     <div class="breadcrumb pd-0 mg-0">
                        <a class="breadcrumb-item" href="index.html"><i class="icon ion-ios-home-outline"></i> Home</a>
                        
                        <span class="breadcrumb-item active">Webinars</span>
                     </div>
                  </div>
                  <!--/ Breadcrumb End -->
              
                  <div class="row row-xs clearfix">
                     <!--================================-->
                     
                     
                     <!--================================-->
                     <!-- Student Details Start -->
                     <!--================================-->
                     <div class="col-lg-3" style="margin-bottom: 10px">
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#m_modal_1"> Add Webinar</button>
                   </div>
                     <div class="col-lg-12 col-xl-12">
                        <div class="card mg-b-20">
                           <div class="card-header">
                              <h4 class="card-header-title">
                                 Webinars
                              </h4>
                              <div class="card-header-btn">
                                 <a  href="" data-toggle="collapse" class="btn card-collapse" data-target="#studentDetails" aria-expanded="true"><i class="ion-ios-arrow-down"></i></a>
                                 <a href="" data-toggle="refresh" class="btn card-refresh"><i class="ion-android-refresh"></i></a>
                                 <a href="" data-toggle="expand" class="btn card-expand"><i class="ion-android-expand"></i></a>
                                 <a href="" data-toggle="remove" class="btn card-remove"><i class="ion-android-close"></i></a>
                              </div>
                           </div>
                         
                               <div class="card-body collapse show" id="collapse7">
                              <table id="scrollableTable" class="table hover responsive display nowrap">
                                 <thead>
                                    <tr>
                                        <th>Image</th>
                                         <th>Webinar Cover</th>
                                       <th>Title</th>
                                       <th>Date</th>
                                       <th>Content</th>
                                       <th class="tx-right">Action</th>
                                    
                                    </tr>
                                 </thead>
                                 <tbody>
                                      <?php
                                      $webQuery = $webinar->webinarsData();
                                      for($i= 0; $rows= $webQuery->fetch();$i++)
                                      {
                                      ?> 
                                    <tr class="record">
                                        <td style="width: 150px;"><img  style="width:100%" src="webinars/images/<?php echo $rows['webinar_img']?>"></td>
                                         <td style="width: 150px;"><img  style="width:100%" src="webinars/images/<?php echo $rows['webinar_cover']?>"></td>
                                       <td><?php echo $rows['webinar_title'] ?></td>
                                       <td><?php echo $rows['webinar_date'] ?></td>
                                     
                                       <td> <a href="webinar-authors?id=<?php echo $rows['webinar_id'] ?>" class="btn btn-primary">Add Content</a></td>
                                      <td class="tx-right">
                                            
                                              <a href="#" data-id="<?php echo $rows['webinar_id'] ?>" class="edit-modal" data-toggle="modal" data-target= "#edit_webinar"><i class="fa fa-pencil"></i></a>
                                          <a class="table-action  mg-r-10 delbutton" href="#" id="<?php echo $rows['webinar_id'] ?>"><i class="fa fa-trash"></i></a>
                                          </td>
                                    </tr>
                                    <?php 
                                    }
                                    ?>
                                  
                                 </tbody>
                                
                              </table>
                           </div>
                        </div>
                     </div>
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
        <div class="modal" id="m_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel_1" style="display: none;" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel_1">Add Webinar</h5>
                  <button type="button" id="modal_close" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true"><i class="ion-ios-close-empty"></i></span>
                  </button>
                  
               </div>
               <form name="myForm" id="myForm" method="post" enctype="multipart/form-data">
                  <div id="error_message"></div>
               <div class="modal-body">
                  <div class="row">
                     <div class="col-lg-12">
                            <label class="form-control-label"
                                   for="webinar_title">Webinar Title</label>
                            <input id="webinar_title" required type="text" name="webinar_title" class="form-control" placeholder="Enter webinar tittle...">
                        </div>
                       
                        <div class="col-lg-12">
                            <label class="form-control-label" for="webinar_date">Webinar Date</label>
                            <input id="webinar_date" required type="date" name="webinar_date" class="form-control" >
                        </div>
                        <div class="col-lg-12">
                            <label class="form-control-label" for="wbg">Webinar Logo</label>
                            <input id="wbg" required type="file" name="wbg" class="form-control"  accept="image/*">
                        </div>
                        <div class="col-lg-12">
                            <label class="form-control-label" for="wbc">Webinar Cover</label>
                            <input id="wbc" required type="file" name="wbc" class="form-control"  accept="image/*">
                        </div>
                             
                  </div>
               </div>
               <div class="modal-footer">
                   <button type="submit" class="btn btn-primary" id="add_webinar" name="add_webinar">Add Webinar</button>
                  
               </div>
            </form>
            </div>
         </div>
      </div>

      <div class="modal" id="edit_webinar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel_1" style="display: none;" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel_1">Edit Webinar</h5>
                  <button type="button" id="modal_close" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true"><i class="ion-ios-close-empty"></i></span>
                  </button>
                  
               </div>
               <form name="myForm1" id="myForm1" action="saveWebinarEdit" method="post" enctype="multipart/form-data">
                  <div id="error_message2"></div>
               <div class="modal-body">
                  <div class="row">
                     <div id="output" class="col-lg-12"></div>
                  </div>
               </div>
               <div class="modal-footer">
                   <button type="submit" class="btn btn-primary" name="edit_webinar" id="edit_webinarBtn">Save</button>
                  
               </div>
            </form>
            </div>
         </div>
      </div>
    <script type="text/javascript">
  
      $(document).ready(function(){
  //var i=1;
  $('#add_webinar').click(function(){
    //i++;
    $.ajax({
      url:"saveWebinar.php",
      method:"POST",
      data:$('#myForm').serialize(),
      success:function(data)
      {
     //alert("added");
        $('#myForm')[0].reset();
        $('#error_message').html(data);
         document.getElementById('modal_close').click;
      }
    });
  });
});
   </script>

<script type="text/javascript">
$(document).ready(function(){
 $('.edit-modal').click(function(){
   var ids = $(this).data('id');
$.ajax({
      url:"edit_webinar.php",
      method:"POST",
      data:{id:ids},
      success:function(data)
      {
     $('#output').html(data);
      }
    });
});
}); 
</script>
<script type="text/javascript">
$(function() {
$(".delbutton").click(function(){
//Save the link in a variable called element
var element = $(this);
//Find the id of the link that was clicked
var del_id = element.attr("id");
var table = "webinars";
var field = "webinar_id";
//Built a url to send
var info = 'id=' + del_id +'&ta='+table +'&fi=' + field;

if(confirm("Sure you want to delete this webinar? There is NO undo!"))
{
   $.ajax({
     type: "GET",
     url: "delete.php",
     data: info,
     success: function(){

     }
 });
   $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast").animate({ opacity: "hide" }, "slow");

}

return false;

});

   });
</script>
     <script src="assets/plugins/jquery/jquery.min.js"></script>
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
      <script src="assets/js/custom.js"></script>
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