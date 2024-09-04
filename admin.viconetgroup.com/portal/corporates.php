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
  $corp = new Corporates($db);
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
                        <h1 class="pd-0 mg-0 tx-20">Companies</h1>
                     </div>
                     <div class="breadcrumb pd-0 mg-0">
                        <a class="breadcrumb-item" href="index"><i class="icon ion-ios-home-outline"></i> Home</a>
                        
                        <span class="breadcrumb-item active">Companies</span>
                     </div>
                  </div>
                  <!--/ Breadcrumb End -->
              
                  <div class="row row-xs clearfix">
                     <!--================================-->
                     
                     
                     <!--================================-->
                     <!-- Student Details Start -->
                     <!--================================-->
                     <div class="col-lg-3" style="margin-bottom: 10px">
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#m_modal_1" disabled=""> Add Company</button>
                   </div>

                     <div class="col-lg-12 col-xl-12">
                        <div class="card mg-b-20">
                           <div class="card-header">
                              <h4 class="card-header-title">
                                 Companies
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
                                          
                                          <th>User Names</th>
                                          <th>User Email</th>
                                          <th>Cellphone</th>                                         
                                         <th>Position</th>
                                         <th>Company Tel</th>
                                         <th title="Company Registration Number">Company Email</th>
                                         <th title="Company Name">Company Name</th>
                                         <th title="Company Name">Status</th>
                                         <th class="tx-right">Action</th>
                                         <th class="tx-right">Package</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php 
                                          $query = $corp->getCorporates();
                                          for($i = 0; $rows = $query->fetch();$i++)
                                          {                                           
                                             $sql = $corp->getCorporateUser($rows['company_email']);
                                             $row = $sql->fetch();
                                             ?>
                                       <tr>
                                          
                                          <td><?php echo $row['user_name'].' '.$row['user_surname']; ?></td>
                                          <td><?php echo $row['user_email'] ?></td>
                                          <td><?php echo $row['user_cellphone'] ?></td>
                                          <td><?php echo $row['user_position'] ?></td>
                                          <td><?php echo $rows['company_tel'] ?></td>   
                                         <td><?php echo $rows['company_email'] ?></td>
                                         <td><?php echo $rows['company_name'] ?></td>
                                         <td><?php echo $rows['status'] ?></td>
                                         <td class="tx-right">
                                             <div class="dropdown">
                                                <a href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon-options"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                   <li class="dropdown-item"><a class="dropdown-link tx-13 tx-gray-500" href="corp_action?s=<?php echo md5('a') ?>&id=<?php echo $rows['company_email'] ?>&e=<?php echo $row['user_email'] ?>&u=<?php echo $row['user_name'] ?>"><i class="icon-success mr-2"></i>Approve</a></li>
                                                   <li class="dropdown-item"><a class="dropdown-link tx-13 tx-gray-500" href="corp_action?s=<?php echo md5('a') ?>&id=<?php echo $rows['company_email'] ?>&e=<?php echo $row['user_email'] ?>&u=<?php echo $row['user_name'] ?>"><i class="icon-close mr-2"></i>Decline</a></li>                  
                                                </ul>
                                             </div>
                                          </td>
                                          <td class="tx-right">
                                             <div class="dropdown">
                                                <a href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon-options"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                   <li class="dropdown-item"><a class="dropdown-link tx-13 tx-gray-500" href="pack_action?s=<?php echo 'vicopac1' ?>&id=<?php echo $rows['company_email'] ?>"><i class="icon-success mr-2"></i>Minimum</a></li>
                                                   <li class="dropdown-item"><a class="dropdown-link tx-13 tx-gray-500" href="pack_action?s=<?php echo 'vicopac2' ?>&id=<?php echo $rows['company_email'] ?>"><i class="icon-close mr-2"></i>Premium</a></li>  
                                                   <li class="dropdown-item"><a class="dropdown-link tx-13 tx-gray-500" href="pack_action?s=<?php echo 'vicopac3' ?>&id=<?php echo $rows['company_email'] ?>"><i class="icon-close mr-2"></i>ultimate</a></li>                 
                                                </ul>
                                             </div>
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
      
      <!--/ Setting Sidebar End  -->      
       <div class="modal" id="m_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel_1" style="display: none;" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel_1">Add Corporate</h5>
                  <button type="button" id="modal_close" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true"><i class="ion-ios-close-empty"></i></span>
                  </button>
               </div>
               <form name="myForm" id="myForm" method="post" enctype="multipart/form-data">
               <div class="modal-body">
                  <div class="row">
                     <div class="col-lg-6">
                         <label class="form-control-label" for="staff_surname">Surname</label>
                            <input id="staff_surname" type="text" name="staff_surname" class="form-control" placeholder="Enter staff surname...">
                      </div>
                      <div class="col-lg-6">
                        <label class="form-control-label" for="staff_name">First Name</label>
                            <input id="staff_name" type="text" name="staff_name" class="form-control" placeholder="Enter staff first name...">
                      </div>
                        <div class="col-lg-12">
                            <label class="form-control-label" for="staff_email">Email</label>
                            <input id="staff_email" type="Email" name="staff_email" class="form-control" >
                        </div>
                         <div class="col-lg-12">
                            <label class="form-control-label" for="staff_cellphone">Cellphone</label>
                            <input id="staff_cellphone" type="text" name="staff_cellphone" class="form-control" >
                        </div>
                         <div class="col-lg-12">
                            <label class="form-control-label" for="staff_position">Position</label>
                            <select name="staff_position" id="staff_position" class="form-control">
                              <option value="">Select position</option>
                              <option value="super">Super Admin</option>
                              <option value="admin">Admin</option>
                            </select>
                        </div>
                  
                  </div>
               </div>
               <div class="modal-footer">
              
                  <button type="button" id="add_staff" class="btn btn-primary">Add</button>
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