<?php
session_start();
   include '../include/connect.php';
   include 'assets/classes/auth.php';
$id = $_POST['id'];

$query = $db->prepare("SELECT * from packages where package_id = '$id'");
$query->execute();
while($rows=$query->fetch())
{
   echo   '  <div class="row"><div class="col-lg-12">
                <label class="form-control-label" for="p_name">Package name</label>
                   <input id="p_name" type="text" name="p_name" value="'.$rows['package_name'].'" class="form-control" placeholder="Enter package name">
                </div>
                <div class="col-lg-12">
                  <label class="form-control-label" for="p_desc">Package description</label>
                      <input id="p_desk" type="text" name="p_desc" value="'.$rows['package_desc'].'" class="form-control" placeholder="Enter staff first name">
                </div>
                <input id="" type="hidden" name="p_id" value="'.$rows['package_id'].'">
                  <div class="col-lg-12">
                      <label class="form-control-label" for="num_users">Number of users</label>
                      <input id="num_users" type="text" value="'.$rows['num_users'].'" placeholder="Enter number of users" name="num_users" class="form-control" >
                  </div>
                   <div class="col-lg-6">
                      <label class="form-control-label" for="duration">Duration</label>
                      <input id="duration" type="text" value="'.$rows['package_duration'].'" placeholder="Enter package duration" name="duration" class="form-control" >
                  </div>
                   <div class="col-lg-6">
                      <label class="form-control-label" for="price">Price</label>
                      <input id="price" type="text" name="price" value="'.$rows['package_price'].'" placeholder="Enter package price" class="form-control" >
                  </div>       
               </div>
         </div>';
   } 

?>