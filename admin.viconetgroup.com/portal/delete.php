<?php
include "../include/connect.php";
include "../include/functions.php";
$candidate = new Candidates($db);
if(isset($_GET['ty'])){
$id= md5($_GET['id']);
$candidate->setCandidate($id);
	$path = "https://talent.viconetgroup.com/img/".$candidate->getPP();
	$path2 = "https://talent.viconetgroup.com/cv/".$candidate->getPdfCV();
	$path3 = "https://talent.viconetgroup.com/video cv/".$candidate->getVideoCV();
	//Deleting files associated with this profile
	if(!empty($candidate->getPP())){
		unlink($path);
		?>
		<script>
			var test = '<?php echo $candidate->getPdfCV() ?>';
		//console.log(test);
		</script>
		<?php
	}
	if(!empty($candidate->getPdfCV())){
		unlink($path2);
	}
	if(!empty($candidate->getVideoCV())){
		unlink($path3);
	}
	//Delete from address
	$query=$db->prepare("DELETE FROM address WHERE email =?");
	$query->execute(array($id));
	
	//Delete from basket
	$query=$db->prepare("DELETE FROM basket WHERE c_email =?");
	$query->execute(array($id));
	
	//Delete from candidate_role
	$query=$db->prepare("DELETE FROM candidate_role WHERE c_email =?");
	$query->execute(array($id));
	
	//Delete from key_courses
	$query=$db->prepare("DELETE FROM key_courses WHERE c_email =?");
	$query->execute(array($id));
	
	//Delete from key_roles
	$query=$db->prepare("DELETE FROM key_roles WHERE c_email =?");
	$query->execute(array($id));
	
	//Delete from key_skills
	$query=$db->prepare("DELETE FROM key_skills WHERE c_email =?");
	$query->execute(array($id));

	//Delete from qualifications
	$query=$db->prepare("DELETE FROM qualifications WHERE c_email =?");
	$query->execute(array($id));

	//Delete from curriculum_vitae
	$query=$db->prepare("DELETE FROM curriculum_vitae WHERE c_email =?");
	$query->execute(array($id));

	//Delete cand
	$query=$db->prepare("DELETE FROM candidate_tbl WHERE md5(c_email) =?");
	$query->execute(array($id));
}
else{
$id= $_GET['id'];
$table = $_GET['ta'];
$field = $_GET['fi'];
$query=$db->prepare("DELETE FROM $table WHERE $field ='$id'");
$query->execute();
}
?> 