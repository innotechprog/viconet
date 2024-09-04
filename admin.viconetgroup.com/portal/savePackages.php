<?php
session_start();
?>
<?php 
include '../include/connect.php';
include 'assets/classes/auth.php';
include 'assets/classes/functions.php';
$webinar = new webinars($db);
$candidate = new Candidates($db);
$staff = new Staff($db);
$staff->setStaffData($_SESSION['staff_id']);
$package = new Packages($db);

$package_name = $_POST['p_name'];
$package_desc = $_POST['p_desc'];
$num_users = $_POST['num_users'];
$package_duration = $_POST['duration'];
$package_price = $_POST['price'];
$package->addPackages($package_name,$package_desc,$num_users,$package_duration,$package_price);
?>
<script type="text/javascript">window.location = "packages"</script>
