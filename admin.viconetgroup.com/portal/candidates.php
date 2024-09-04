<?php
session_start();
$_SESSION['adid'] = md5('admin');
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
   $proc = md5("process");
   $ver = md5("verify");
   $imported = md5("imported");
   $exportId = md5("allTalent");
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
                     <?php
                     if (isset($_GET['type'])) {
                        if ($_GET['type'] == $imported) {
                     ?>
                           <h1 class="pd-0 mg-0 tx-20">Imported Candidates Pending Consent</h1>
                        <?php
                        }
                     } else {
                        ?>
                        <h1 class="pd-0 mg-0 tx-20">Candidates</h1>
                     <?php
                     }
                     ?>
                  </div>
                  <div class="breadcrumb pd-0 mg-0">
                     <a class="breadcrumb-item" href="index"><i class="icon ion-ios-home-outline"></i> Home</a>
                     <span class="breadcrumb-item active">Candidates</span>
                  </div>
               </div>
               <!--/ Breadcrumb End -->
               <div class="row row-xs clearfix">
                  <!--================================-->
                  <!--================================-->
                  <!-- Student Details Start -->
                  <!--================================-->
                  <div class="col-lg-12 d-flex justify-content-between" style="margin-bottom: 10px">
                     <div>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#m_modal_1">Import Data</button>
                        <a href="candidates?type=<?php echo $imported ?>" class="btn btn-secondary">Imported Candidates</a>
                     </div>
                     <!-- <div>
                           <a href="auto_send?st=<?php echo $proc ?>" class="btn btn-secondary">Profile reminder</a>
                           <a href="auto_send?st=<?php echo $ver ?>" class="btn btn-secondary">Verify reminder</a>
                        </div>-->
                  </div>
                  <div class="col-lg-12 col-xl-12">
                     <div class="card mg-b-20">
                        <div class="card-header">
                           <h4 class="card-header-title">
                              Candidates
                           </h4>
                           <div class="card-header-btn">
                              <a href="" data-toggle="collapse" class="btn card-collapse" data-target="#studentDetails" aria-expanded="true"><i class="ion-ios-arrow-down"></i></a>
                              <a href="" data-toggle="refresh" class="btn card-refresh"><i class="ion-android-refresh"></i></a>
                              <a href="" data-toggle="expand" class="btn card-expand"><i class="ion-android-expand"></i></a>
                              <a href="" data-toggle="remove" class="btn card-remove"><i class="ion-android-close"></i></a>
                           </div>
                        </div>
                        <div class="card-body pd-0 collapse show" id="studentDetails">
                           <div class="card-body collapse show" id="collapse7">
                              <form method="post" action="send_invites">
                                 <table id="scrollableTable" class="table hover responsive display nowrap">
                                    <thead class="tx-10 tx-uppercase">
                                       <tr>
                                          <?php
                                          if (isset($_GET['type'])) {
                                             if ($_GET['type'] == $imported) {
                                          ?>
                                                <th><input type="checkbox" class="checkbox1" id="selectAll" onclick="selectAll(this)"></th>
                                          <?php
                                             }
                                          }
                                          ?>
                                          <th>Name</th>
                                          <th>Email</th>
                                          <th>Date Of Birth</th>
                                          <th>Cellphone</th>
                                          <th>View Profile</th>
                                          <th class="tx-right">Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                       $query =$candidate->candidatePageControl();
                                       for ($i = 0; $rows = $query->fetch(); $i++) {
                                          $email = md5($rows['c_email']);
                                       ?>
                                          <tr class="record">
                                             <?php
                                             if (isset($_GET['type'])) {
                                                if ($_GET['type'] == $imported) {
                                             ?>
                                                   <td><input type="checkbox" class="checkbox1 selectBox" name="selectCand[]" value="<?php echo $rows['c_email'] ?>"></td>
                                             <?php
                                                }
                                             }
                                             ?>
                                             <td><?php echo $rows['c_surname'] . ' ' . $rows['c_name']; ?></td>
                                             <td><?php echo $rows['c_email'] ?></td>
                                             <td><?php echo $rows['c_DOB'] ?></td>
                                             <td><?php echo $rows['c_cellphone'] ?></td>
                                             <td><a href="../c_p?id=<?php echo $email ?>" class="btn btn-primary" target="_blank">View Profile</a></td>
                                             <td class="tx-right">
                                                <a class="table-action  mg-r-10 delbutton" href="#" id="<?php echo $rows['c_email'] ?>"><i class="fa fa-trash"></i></a>
                                             </td>
                                          </tr>
                                       <?php
                                       }
                                       ?>
                                    </tbody>
                                 </table>
                                 <hr>
                                 <button class="btn btn-primary tx-right">Invite</button>
                                 <a href="export-data?id=<?php echo $exportId ?>" class="btn btn-warning tx-right">export</a>
                              </form>
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
               <h5 class="modal-title" id="exampleModalLabel_1">Import Candidates</h5>
               <button type="button" id="modal_close" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true"><i class="ion-ios-close-empty"></i></span>
               </button>
            </div>
            <form name="myForm" id="myForm" method="post" action="import" enctype="multipart/form-data">
               <div class="modal-body">
                  <div class="row">
                     <div class="col-lg-6">
                        <label class="form-control-label" for="importFile">Upload document(xls,csv)</label>
                        <input id="importFile" type="file" name="file" class="form-control" placeholder="Choose file">
                     </div>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="submit" id="" name="import" class="btn btn-primary">Import</button>
               </div>
            </form>
         </div>
      </div>
   </div>
   <!--================================-->
   <!-- Footer Script -->
   <!--================================-->
   <script type="text/javascript">
      $(document).ready(function() {
         //var i=1;
         $('#add_staff').click(function() {
            //i++;
            $.ajax({
               url: "saveStaff.php",
               method: "POST",
               data: $('#myForm').serialize(),
               success: function(data) {
                  //alert("added");
                  $('#myForm')[0].reset();
                  //$('#error_mes').html(data);
                  document.getElementById('modal_close').click;
               }
            });
         });
      });
   </script>
   <script type="text/javascript">
      $(function() {
         $(".delbutton").click(function() {
            //Save the link in a variable called element
            var element = $(this);
            //Find the id of the link that was clicked
            var del_id = element.attr("id");
            var table = "candidate_tbl";
            var field = "c_id";
            var type = "candi";
            //Built a url to send
            var info = 'id=' + del_id + '&ta=' + table + '&fi=' + field + '&ty=' + type;

            if (confirm("Sure you want to delete this candidate? There is NO undo!")) {
               $.ajax({
                  type: "GET",
                  url: "delete.php",
                  data: info,
                  success: function() {}
               });
               $(this).parents(".record").animate({
                  backgroundColor: "#fbc7c7"
               }, "fast").animate({
                  opacity: "hide"
               }, "slow");
            }
            return false;
         });
      });

      function selectAll(obj) {
         let id = '#' + obj.id;
         //alert(obj);
         alert(id);
         $(id).change(function() {
            let select = "." + ("selectBox");
            $(select).prop("checked", $(this).prop("checked"))
         });
      };
   </script>

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


   <script type="text/javascript">
      $('#scrollableTable').DataTable({
         responsive: true,
         language: {
            searchPlaceholder: 'Search...',
            sSearch: ''
         },
         "order": [
            [1, "desc"]
         ],
         "scrollY": "250px",
         "scrollCollapse": true,
         "paging": false
      });
   </script>
</body>

</html>