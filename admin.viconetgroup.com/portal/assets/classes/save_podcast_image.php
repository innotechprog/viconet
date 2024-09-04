<?php
/*if(isset($filename)){
    if($filename!=""){
        $filename = $filename;
    }
}
else{*/
$filename="";
//}

if(!empty( $_FILES['podcast_pic']['name']))
    {
     $file_array = $_FILES['podcast_pic'];
        
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
                    move_uploaded_file($file_array['tmp_name'] ,'../../images/podcast/'.$file_array['name']);
                   
                }
       }
       //$filename = $file_array['name'];
       $_SESSION['filename'] = $file_array['name'];
   }
  ?>  