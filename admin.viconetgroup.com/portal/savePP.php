<?php
include "../include/connect.php";
$pp=$_POST['pp'];
$id = $_POST['sid'];
$path = "assets/images/".$_POST['pp'];
$name = $_POST['staff_name'];
$surname = $_POST['staff_surname'];
$cellphone=$_POST['staff_cellphone'];

if($_FILES['insight_pic']['name']!="")
	{
		$file_array = $_FILES['insight_pic'];
		
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
					move_uploaded_file($file_array['tmp_name'] ,'assets/images/'.$new_filename);
					
				$pp= $new_filename;	
				if(!unlink($path))
				{
					echo "not Deleted";
				}		
				?>
				</div>
				<?php  
				
			}
		}
	
	}
	$query=$db->prepare("UPDATE staff SET `profile_pic`='$pp',`s_first_name`='$name',`s_last_name`='$surname',`s_cell_number`='$cellphone' WHERE s_id='$id'");
	if($query->execute())
	{
		
	}

?>