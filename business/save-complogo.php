<?php
include "include/connect.php";
include "include/functions.php";
$corp = new Corporate($db);
$idss = $_POST['idss'];
 
$pp=$_POST['pp'];
$id = $_POST['sid'];
$path = "img/".$_POST['pp'];

if($_FILES['p_pic']['name']!="")
	{
		$file_array = $_FILES['p_pic'];
		
			if($file_array['error'])
			{
				
			}
			else{
				$allow = array('jpg','png','jpeg','svg');
				$fileExt = explode('.',$file_array['name']);
				$fileActualExt = strtolower(end($fileExt));
				if(!in_array($fileActualExt, $allow))
				{
					
				}
				else
				{
					$new_filename = round(microtime(true)).'.'.$fileActualExt;
					move_uploaded_file($file_array['tmp_name'] ,'img/'.$new_filename);
					
				$pp= $new_filename;	
				if(!unlink($path))
				{
					echo "not Deleted";
				}		
				?>
				</div>
				<?php  
				$query=$db->prepare("UPDATE corporate SET `logo`='$pp' WHERE `company_email`='$id'");
				$query->execute();
					
			}
		}
	
	}


?>