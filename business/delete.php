<?php
session_start();
include "include/connect.php";
include "include/functions.php";
include 'include/corp_auth.php';

if (isset($_GET['pid'])) {
	if ($_GET['pid']=="projects") {
		$id= $_GET['id'];
		$table = $_GET['ta'];
		$field = $_GET['fi'];
		$query=$db->prepare("DELETE FROM $table WHERE $field ='$id'");
		$query->execute();

		$email = md5($corp->getCompEmail());
		$query=$db->prepare("DELETE FROM basket WHERE $field ='$id' and company_reg ='$email'");
		$query->execute();
	}
}
else if(isset($_GET['candiDate'])){
	$comp_reg = md5($corp->getCompReg());
	$userEmail = md5($corp->getUserEmail());
	$status = md5("consid");
	$fakeId = md5("receId");
	$id= $_GET['id'];
	$c_email = md5($candidate->getCandEmailByID($id));
	$query = $db->prepare("DELETE FROM basket WHERE company_reg='$comp_reg' and added_by = '$userEmail' and status ='$status' and c_email='$c_email'");
	$query->execute();
}
else if(isset($_GET['jid'])){
$id= $_GET['id'];
$table = $_GET['ta'];
$field = $_GET['fi'];
$query=$db->prepare("DELETE FROM $table WHERE $field ='$id'");
$query->execute();
$query=$db->prepare("DELETE FROM jobs_companies WHERE id =(select company_id from jobs where job_id = '$id')");
$query->execute();
$query=$db->prepare("DELETE FROM job_responsibility WHERE job_id ='$id'");
$query->execute();
$query=$db->prepare("DELETE FROM job_requirement WHERE job_id ='$id'");
$query->execute();
}
else{
$id= $_GET['id'];
$table = $_GET['ta'];
$field = $_GET['fi'];
$query=$db->prepare("DELETE FROM $table WHERE $field ='$id'");
$query->execute();
}
?>