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
      $package = new Packages($db);
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
               <!-- Main Wrapper -->
               <div id="main-wrapper">
                  <!--================================-->
                  <!-- Breadcrumb Start -->
                  <!--================================-->
                  <div class="pageheader pd-t-25 pd-b-35">
                     <div class="pd-t-5 pd-b-5">
                        <h1 class="pd-0 mg-0 tx-20">Subscription packages</h1>
                     </div>
                     <div class="breadcrumb pd-0 mg-0">
                        <a class="breadcrumb-item" href="index"><i class="icon ion-ios-home-outline"></i> Home</a>
                        
                        <span class="breadcrumb-item active">Packages</span>
                     </div>
                  </div>
                  <!--/ Breadcrumb End -->
              
                  <div class="row row-xs clearfix">
                     <!--================================-->
                     
                     
                     <!--================================-->
                     <!-- Student Details Start -->
                     <!--================================-->
                     <div class="col-lg-3" style="margin-bottom: 10px">
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#m_modal_1">Add package</button>
                   </div>

                     <div class="col-lg-12 col-xl-12">
                        <div class="card mg-b-20">
                           <div class="card-header">
                              <h4 class="card-header-title">
                                 Packages
                              </h4>
                              <div class="card-header-btn">
                                 <a  href="" data-toggle="collapse" class="btn card-collapse" data-target="#studentDetails" aria-expanded="true"><i class="ion-ios-arrow-down"></i></a>
                                 <a href="" data-toggle="refresh" class="btn card-refresh"><i class="ion-android-refresh"></i></a>
                                 <a href="" data-toggle="expand" class="btn card-expand"><i class="ion-android-expand"></i></a>
                                 <a href="" data-toggle="remove" class="btn card-remove"><i class="ion-android-close"></i></a>
                              </div>
                           </div>

                           <div class="card-body pd-0 collapse show" id="studentDetails">
                              <div class="card-body collapse show" id="collapse7">
                              <table id="scrollableTable" class="table hover responsive display nowrap">
                                    <thead class="tx-10 tx-uppercase">
                                       <tr>
                                          
                                          <th>Name</th>
                                          <th style="width:40%">Description</th>
                                          <th>Number of users</th>
                                         <th>Duration</th>
                                         <th>Price</th>
                                         <th class="tx-right">Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php 
                                          $query = $package->getAllPackages();
                                          for($i = 0; $rows = $query->fetch();$i++)
                                          {
                                             $id=$rows['package_id'];
                                            ?>
                                       <tr class="record">
                                          
                                          <td><?php echo $rows['package_name'] ?></td>
                                          <td style="width:40%"><?php //echo $rows['package_desc'] ?></td>
                                          <td><?php echo $rows['num_users'] ?></td>                                          
                                         <td><?php echo $rows['package_duration'] ?></td>
                                         <td><?php echo $rows['package_price'] ?></td>
                                         <td class="tx-right">
                                           <a href="#" data-id="<?php echo $rows['package_id'] ?>" class="edit-modal" data-toggle="modal" data-target= "#edit_package"><i class="fa fa-pencil"></i></a>
                                          <a class="table-action  mg-r-10 delbutton" href="#" id="<?php echo $id ?>"><i class="fa fa-trash"></i></a>                                            
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
      <!-- Setting Sidebar Start -->
      <!--================================-->	  
            
       <div class="modal" id="m_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel_1" style="display: none;" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel_1">Add Package </h5>
                  <button type="button" id="modal_close" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true"><i class="ion-ios-close-empty"></i></span>
                  </button>
               </div>
               <form name="myForm" id="myForm" method="post" action="savePackages" enctype="multipart/form-data">
               <div class="modal-body">
                  <div class="row">
                     <div class="col-lg-12">
                         <label class="form-control-label" for="p_name">Package name</label>
                            <input id="p_name" type="text" name="p_name" class="form-control" placeholder="Enter package name">
                         </div>
                         <div class="col-lg-12">
                           <label class="form-control-label" for="p_desc">Package description</label>
                               <input id="p_desk" type="text" name="p_desc" class="form-control" placeholder="Enter staff first name">
                         </div>
                           <div class="col-lg-12">
                               <label class="form-control-label" for="num_users">Number of users</label>
                               <input id="num_users" type="text" placeholder="Enter number of users" name="num_users" class="form-control" >
                           </div>
                            <div class="col-lg-6">
                               <label class="form-control-label" for="duration">Duration</label>
                               <input id="duration" type="text" placeholder="Enter package duration" name="duration" class="form-control" >
                           </div>
                            <div class="col-lg-6">
                               <label class="form-control-label" for="price">Price</label>
                               <input id="price" type="text" name="price" placeholder="Enter package price" class="form-control" >
                           </div>                         
                  
                  </div>
               </div>
               <div class="modal-footer">
              
                  <button type="submit" id="add_staff" class="btn btn-primary">Add</button>
               </div>
            </form>
            </div>
         </div>
      </div>
      <!-- edit modal -->
      <div class="modal" id="edit_package" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel_1" style="display: none;" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel_1">Edit package</h5>
                  <button type="button" id="modal_close" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true"><i class="ion-ios-close-empty"></i></span>
                  </button>
                  
               </div>
               <form name="myForm1" id="myForm1" action="saveEditPackage" method="post" enctype="multipart/form-data">
                  <div id="error_message2"></div>
               <div class="modal-body">
                 
                     <div id="output" class="">
                  </div>
               </div>
               <div class="modal-footer">
                   <button type="submit" class="btn btn-primary" name="edit_webinar" id="edit_webinarBtn">Save</button>
                  
               </div>
            </form>
            </div>
         </div>
      </div>
      <!--================================-->
      <!-- Footer Script -->
      <!--================================-->
      <script type="text/javascript">
      $(document).ready(function(){
  //var i=1;
  $('#add_staff').click(function(){
    //i++;
    $.ajax({
      url:"savePackage.php",
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
<script type="text/javascript">
$(document).ready(function(){
 $('.edit-modal').click(function(){
   var ids = $(this).data('id');
$.ajax({
      url:"editPackages.php",
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
var table = "packages";
var field = "package_id";
//Built a url to send
var info = 'id=' + del_id +'&ta='+table +'&fi=' + field;

if(confirm("Sure you want to delete this candidate? There is NO undo!"))
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