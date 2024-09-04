<?php
include '../include/connect.php';
include '../include/functions.php';
$corp = new Corporate($db);
$company_email = $_GET['id'];
$package = $_GET['s'];
$status = "paid";
$corp->updateSubscription($package,$status,$company_email);
?>
<script type="text/javascript">window.location = "corporates"</script>
