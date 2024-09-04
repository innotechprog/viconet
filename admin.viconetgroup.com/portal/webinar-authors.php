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
        
         <div class="page-content">
            
          <?php
          include "header.php";
          ?>
            <div class="page-inner">
               <!-- Main Wrapper -->
               <div id="main-wrapper">
                 
                  <div class="pageheader pd-t-25 pd-b-35">
                     <div class="pd-t-5 pd-b-5">
                        <h1 class="pd-0 mg-0 tx-20">Authors</h1>
                     </div>
                     <div class="breadcrumb pd-0 mg-0">
                        <a class="breadcrumb-item" href="index"><i class="icon ion-ios-home-outline"></i> Home</a>
                        
                        <span class="breadcrumb-item active">webinar authors</span>
                     </div>
                  </div>
                  <!--/ Breadcrumb End -->
              
                  <div class="row row-xs clearfix">
                    
                     <div class="col-lg-3" style="margin-bottom: 10px">
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#m_modal_1"> Add Author</button>
                   </div>

                     <div class="col-lg-12 col-xl-12">
                        <div class="card mg-b-20">
                           <div class="card-header">
                              <h4 class="card-header-title">
                                 Authors
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
                                          <th>Company logo</th>
                                          <th>Author Names</th>
                                          <th>PDF File</th>
                                          <th>Video Recording</th>
                                          <th class="tx-right">Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php 
                                          $query = $webinar->authorData($_GET['id']);
                                          for($i = 0; $rows = $query->fetch();$i++)
                                          {
                                            ?>
                                       <tr class="record">
                                           <td style="width: 150px;"><img  style="width:100%" src="webinars/companies/<?php echo $rows['logo']?>"></td>
                                          <td><?php echo $rows['author_name']?></td>
                                          <td><a href="webinars/pdf/<?php echo $rows['pdf_file'] ?>" target="_blank">Download File</a></td>
                                          <td><div style="width: 100%"><?php echo $rows['youtube_link'] ?></div></td>                                          
                                         <td class="tx-right">
                                               
                                          <a class="table-action  mg-r-10 delbutton" href="#" id="<?php echo $rows['content_id'] ?>"><i class="fa fa-trash"></i></a>
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
     
       <div class="modal" id="m_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel_1" style="display: none;" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel_1">Add Author</h5>
                  <button type="button" id="modal_close" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true"><i class="ion-ios-close-empty"></i></span>
                  </button>
               </div>
               <form name="myForm" id="myForm" action="saveAuthor" method="post" enctype="multipart/form-data">
               <div class="modal-body">
                  <div class="row">
                    <div class="col-lg-12">
                            <label class="form-control-label"
                                   for="name">Surname and first name</label>
                            <input id="name" type="text" required name="author_name" class="form-control" placeholder="Author surname and name  ...">
                        </div>
                        <div class="col-lg-12">
                            <label class="form-control-label" for="title">Title</label>
                            <input id="title" required type="text" name="title" class="form-control" placeholder="Title">
                        </div>
                         <div class="col-lg-12">
                            <label class="form-control-label" for="title">Youtube link</label>
                            <input id="title" type="text" name="youtube_link" class="form-control" placeholder="Enter Youtube Link">
                        </div>
                        <input type="hidden" value="<?php echo $_GET['id'] ?>" name="webinar_id">
                       
                        <div class="col-lg-12">
                            <label class="form-control-label" for="upload_pdf">Upload PDF</label>
                            <input id="upload_pdf" type="file" name="author_pdf"   class="form-control" accept="application/pdf" >
                        </div>
                         <div class="col-lg-12">
                            <label class="form-control-label" for="upload_logo" >Upload Logo</label>
                            <input id="upload_logo" type="file" name="logo"   class="form-control" accept="image/*">
                        </div>
                     
                  </div>
               </div>
               <div class="modal-footer">
              
                 <button type="submit" class="btn btn-primary" id="add_author">Add Author</button>
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
  $('#add_author').click(function(){
        $.ajax({
            url: "saveAuthor.php", 
            type: "POST",
            dataType: "JSON",             
            data: new FormData(document.forms.myForm),
            contentType: false,       
            cache: false,             
            processData:false, 
            success: function(data) {
               alert* 
                //$("#response").html(data);
               // $('#myForm')[0].reset();
               // window.location.href = "index.php";
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
var table = "content";
var field = "content_id";
//Built a url to send
var info = 'id=' + del_id +'&ta='+table +'&fi=' + field;

if(confirm("Sure you want to delete this user? There is NO undo!"))
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