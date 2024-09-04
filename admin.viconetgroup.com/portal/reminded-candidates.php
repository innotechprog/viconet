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
   $exportId = md5("uploadedCV");
   
   
   $labels = [];
   $data = [];
   $fromDate = "";
   $toDate = "2022";
   $emailNum = "";
   $rowCount ;

   if (isset($_POST['submitData'])) {
    $fromDate = $_POST['fromDate'] ?? null;
    $toDate = $_POST['toDate'] ?? null;

    $emailNum = $_POST['emailNum'];
    $filteredData = $candidate->getFilteredReminderData($emailNum,$fromDate,$toDate);
    $rowCount = $candidate->countFilteredReminderData($emailNum,$fromDate,$toDate);

    $query = $candidate->getFilteredReminderData($emailNum,$fromDate,$toDate);
    $results = $query->fetchAll();

    
    if (count($results) > 0) {
        // Fetch data from the database
        foreach ($results as $row) {
            $labels[] = $row["num_reminder"];
            $data[] = $candidate->getUploaded($row['num_reminder'],$fromDate,$toDate);
        }
    } else {
       // echo "0 results";
    }

   // echo json_encode($filteredData);
}
else{
    $fromDate = $_POST['fromDate'] ?? null ;
    $toDate = $_POST['toDate'] ?? null;

    $emailNum = "all";
    $filteredData = $candidate->getFilteredReminderData($emailNum,$fromDate,$toDate);
    
    $query = $candidate->getFilteredReminderData($emailNum,$fromDate,$toDate);
    $results = $query->fetchAll();

   
    if (count($results) > 0) {
        // Fetch data from the database
        foreach ($results as $row) {
            $labels[] = $row["num_reminder"];
            $data[] = $candidate->getUploaded($row['num_reminder'],$fromDate,$toDate);
        }
    } else {
       // echo "0 results";
    }
    //echo json_encode($filteredData);
}
//echo $fromDate;
    ?>

       <?php
        echo "<script>";
        echo "var labels = " . json_encode($labels) . ";";
        echo "var data = " . json_encode($data) . ";";
        echo "</script>";
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
                     
                        <h1 class="pd-0 mg-0 tx-20">CV UPLOADS AFTER EMAIL REMINDERS</h1>
                  </div>
                  <div class="breadcrumb pd-0 mg-0">
                     <a class="breadcrumb-item" href="index"><i class="icon ion-ios-home-outline"></i> Home</a>
                     <span class="breadcrumb-item active">Reminded Candidate</span>
                  </div>
               </div>
               <div class="row">
               	<div class="col-lg-6">
               		<div class="w-100">
				        <canvas id="myChart"></canvas>
				    </div>
               	</div>
               	<div class="col-lg-6">
                     <div class="form-container mb-4">
                        <h3 class="text-white text-center">Filter your results</h3><hr>
               		<form method="post">
               			<div class="row">
               				<div class="col-lg-6">
               				<div class="form-group">
               					<label>Email number</label>
               					<select name="emailNum" class="form-control">
               						<option value="all">All emails</option>
               						<option value="1">Email 1</option>
               						<option value="2">Email 2</option>
               						<option value="3">Email 3</option>
               					</select>
               				</div>
               			</div>
               			   <div class="col-lg-6">
        <div class="form-group">
            <label>From Date</label>
            <input type="date" id="fromDate" name="fromDate" class="form-control">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label>To Date</label>
            <input type="date" id="toDate" name="toDate" class="form-control">
        </div>
    </div>
    <div class="col-lg-12">
        <div class="form-group">
            <button type="submit" name="submitData" id="filterButton" class="btn btn-primary">Filter Data</button>
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
               <!--/ Breadcrumb End -->
               <div class="row row-xs clearfix">
                  <!--================================-->
                  <!--================================-->
                  <!-- Student Details Start -->
                  <!--================================-->
                  
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
                                          <th>Email Number</th>
                                          <th>Number of talent uploaded</th>
                                          <th>Number of talent did not upload</th>
                                          <th>Total Emails Sent</th>
                                          
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                       $query = $filteredData;
                                       for ($i = 0; $rows = $query->fetch(); $i++) { ?>
                                          <tr class="record">                                
                                             <td><?php echo $rows['num_reminder'] ?></td>
                                             <td>
                                                <a href="reminded-candidates-det?id=<?php echo $rows['num_reminder'] ?>&sd=<?php echo $fromDate ?>&ed=<?php echo $toDate ?>&ty=uploaded" class="btn btn-primary">Show talent <?php echo '('.$candidate->getUploaded($rows['num_reminder'],$fromDate,$toDate).')' ?></a></td>
                                             <td><a href="reminded-candidates-det?id=<?php echo $rows['num_reminder'] ?>&sd=<?php echo $fromDate ?>&ed=<?php echo $toDate ?>&ty=notuploaded" class="btn btn-warning">Show talent <?php echo '('.$candidate->getNotUploaded($rows['num_reminder'],$fromDate,$toDate).')' ?></a></td>
                                             <td>
                                                <a href="reminded-candidates-det?id=<?php echo $rows['num_reminder'] ?>&sd=<?php echo $fromDate ?>&ed=<?php echo $toDate ?>&ty=all" class="btn btn-success">Show talent <?php echo '('.$candidate->countFilteredReminderData($rows['num_reminder'],$fromDate,$toDate).')' ?></a></td>                                            
                                             
                                             
                                          </tr>
                                       <?php
                                       }
                                       ?>
                                    </tbody>
                                 </table>
                                 <hr>
                                 <a href="export-data?id=<?php echo $exportId ?>&sd=<?php echo $fromDate ?>&ed=<?php echo $toDate ?>&em=<?php echo $emailNum ?>" class="btn btn-primary tx-right">Export</a>
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
   <script src="assets/js/app.js"></script>
   <script src="assets/js/dynamical_change_fields.js"></script>


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