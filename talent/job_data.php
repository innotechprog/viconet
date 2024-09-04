<?php
session_start();
include "include/connect.php";
include "include/functions.php";
//$candidate = new Candidates($db);
include "../business.viconetgroup.com/include/jobs_class.php";
$jobs = new Jobs($db);	
$data ="";
	$query= $jobs->getAllJobs();
	for($i = 0; $row=$query->fetch();$i++)
	{
		//$sql = $candidate->_getKeySkills($row['job_title']);
		//for($x =0; $rows=$sql->fetch();$x++)
		//{
			$data = $data.$row['job_title'].',';//.'-'.$rows['skill'].',';
		//$job_title = array($row['job_title']);
		//array_push($data_array['data'], $job_title);
		//}	 
	}
	echo substr($data,0,-1);

?>