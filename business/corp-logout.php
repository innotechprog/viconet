<?php 
session_start();
include "include/connect.php";
include "include/functions.php";
$seemail = $_SESSION['corpid'];
$corp= new Corporate($db);
$corp->setUsersData($seemail);
$sess = $corp->getUserSess();
unset($_SESSION[$sess]);
unset($_SESSION['corpid']);
//session_destroy();
if (isset($_COOKIE['cookie_cid'])) {
    unset($_COOKIE['cookie_cid']);  
    setcookie('cookie_cid', null, -1, '/'); 
    header('location:index');
} 

?>
<script type="text/javascript">window.location = "index"</script>
