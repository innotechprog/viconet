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
   include 'assets/classes/job_posting_class.php';
   $jobPosting = new JobPosting($db);
   $candidate = new Candidates($db);
   $staff = new Staff($db);
   $staff->setStaffData($_SESSION['staff_id']);
   $landing = new LandingPage($db);
   $exportId = md5("uploadedCV");
   $query = $candidate->groupTalUploadedCVafterRem();
    $results = $query->fetchAll();

     $labels = [];
    $data = [];

    if (count($results) > 0) {
        // Fetch data from the database
        foreach ($results as $row) {
            $labels[] = $row["num_reminder"];
            $data[] = $row["num_reminds"];
        }
    } else {
        echo "0 results";
    }
   ?>
       <?php
        echo "<script>";
        echo "var labels = " . json_encode($labels) . ";";
        echo "var data = " . json_encode($data) . ";";
        echo "</script>";
    $totalTalentRegJP = 0;
    if (isset($_POST['submitData'])) {
    $fromDate = $_POST['fromDate'] ?? null;
    $toDate = $_POST['toDate'] ?? null;
    //$emailNum = $_POST['emailNum'];
    $totalTalentRegJP = $jobPosting->totalTalentRegJP($fromDate,$toDate);
   }
   else{
      $fromDate = $_POST['fromDate'] ?? null;
    $toDate = $_POST['toDate'] ?? null;
    //$emailNum = $_POST['emailNum'];
    $totalTalentRegJP = $jobPosting->totalTalentRegJP($fromDate,$toDate);
   }
    ?>


   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                     
                        <h1 class="pd-0 mg-0 tx-20 text-uppercase">Talent registered through job posting</h1>
                  </div>
                  <div class="breadcrumb pd-0 mg-0">
                     <a class="breadcrumb-item" href="index"><i class="icon ion-ios-home-outline"></i> Home</a>
                     <span class="breadcrumb-item active"> Candidate</span>
                  </div>
               </div>
               <!--/ Breadcrumb End -->
               <div class="row"> 

<div class="col-lg-8">            
   <div class="d-flex justify-content-between align-items-center">
     <div class="">
      <label>Total Talent: </label>
     </div>
     <div class="">
      <a href="" class="btn btn-primary"> <?php echo '('.$totalTalentRegJP.')'; ?></a>
     </div>
   </div>
   <hr>
   <div class="d-flex justify-content-between align-items-center">
     <div class="">
      <label>Email pending verification: </label>
     </div>
     <div class="">
      <a href="" class="btn btn-primary"> <?php echo '('.$jobPosting->countNumCandJP('Pending',$fromDate,$toDate).')' ?></a>
     </div>
   </div>
   <hr>
   <div class="d-flex justify-content-between align-items-center">
     <div class="">
      <label>Email verified but profile incomplete: </label>
     </div>
     <div class="">
      <a href="" class="btn btn-primary"> <?php echo '('.$jobPosting->countNumCandJP('process',$fromDate,$toDate).')' ?></a>
     </div>
   </div>
   <hr>
   <div class="d-flex justify-content-between align-items-center">
     <div class="">
      <label>Google email verified but profile incomplete: </label>
     </div>
     <div class="">
      <a href="" class="btn btn-primary"> <?php echo '('.$jobPosting->countNumCandJP('google-process',$fromDate,$toDate).')' ?></a>
     </div>
   </div>
   <hr>
   <div class="d-flex justify-content-between align-items-center">
     <div class="">
      <label>Completed profiles: </label>
     </div>
     <div class="">
      <a href="" class="btn btn-primary"> <?php echo '('.$jobPosting->countNumCandJP('verified',$fromDate,$toDate).')' ?></a>
     </div>
   </div>
   <hr>
   <div class="d-flex justify-content-between align-items-center">
     <div class="">
      <label>Talent without CV: </label>
     </div>
     <div class="">
      <a href="" class="btn btn-primary"> <?php echo '('.$jobPosting->countTalentWithoutCVJP($fromDate,$toDate).')'; ?></a>
     </div>
   </div>
   <hr>
   <div class="d-flex justify-content-between align-items-center">
     <div class="">
      <label>Talent with CV: </label>
     </div>
     <div class="">
      <a href="" class="btn btn-primary"> <?php echo '('.$jobPosting->countTalentWithCVJP($fromDate,$toDate).')'; ?></a>
     </div>
   </div>
</div>
<div class="col-lg-4">            
<div class="form-container mb-4">
                        <h3 class="text-white text-center">Filter your results</h3><hr>
                     <form method="post">
                        <div class="row">
                           
                           <div class="col-lg-12">
        <div class="form-group">
            <label>From Date</label>
            <input type="date" id="fromDate" name="fromDate" class="form-control">
        </div>
    </div>
    <div class="col-lg-12">
        <div class="form-group">
            <label>To Date</label>
            <input type="date" id="toDate" name="toDate" class="form-control">
        </div>
    </div>
    <div class="col-lg-12">
        <div class="form-group">
            <button type="submit" name="submitData" id="filterButton" class="btn btn-primary w-100">Filter Data</button>
        </div>
        <div class="form-group">
            <span id="error" class="error">To Date cannot be less than From Date or more than today's date</span>
        </div>
    </div>
                        

                        </div>
                     </form>
                  </div>
</div>
</div>
            </div>
            <!--/ Main Wrapper End -->
         </div>
         <!--/ Page Inner End -->
         <!--================================-->
         <!-- Page Footer Start -->
         <!--================================-->
          <?php
         	include "footer.php";
         ?>
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
   <script src="assets/js/create-graph.js"></script>


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