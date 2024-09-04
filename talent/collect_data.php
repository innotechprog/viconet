<?php
session_start();
include "include/connect.php";
include "include/functions.php";
include 'include/corp_auth.php';
$compReg = $corp->getCompReg();
$corp->getSubscription();
//$data_array = array();
//$data_array['data'] = array();
$data = "";
$id = $_POST['id'];

if($id=='getJobTitle'){
	$query= $candidate->getJobTitle();
	for($i = 0; $row=$query->fetch();$i++)
	{
		$sql = $candidate->_getKeySkills($row['job_title']);
		for($x =0; $rows=$sql->fetch();$x++)
		{
			$data = $data.$row['job_title'].'-'.$rows['skill'].',';
		//$job_title = array($row['job_title']);
		//array_push($data_array['data'], $job_title);
		}	 
	}
	echo substr($data,0,-1);
}
else if($id=='checkout'){
	if($corp->getPackPrice() > 0){
		echo 2;
	}
	else{
		echo 1; 
	}
}
else if ($id=="subscription") {
	echo $corp->getCompPackId();	
}
else if ($id=="projectId") {
		echo $corp->checkReceiptExistByName($_POST['proj_name']);
}
?>