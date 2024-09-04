<?php 
session_start();
include "include/connect.php";
include "include/functions.php";
$seemail = $_SESSION['id'];
$candidate= new Candidates($db);
$candidate->setCandidate($seemail);
$sess = $candidate->getSession();
unset($_SESSION[$sess]);
unset($_SESSION['id']);
session_destroy();
?>
<script>window.location ="index"</script>
