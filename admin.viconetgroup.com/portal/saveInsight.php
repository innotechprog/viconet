<?php
include "../include/connect.php";
include "assets/classes/functions.php";
$insight = new Insight($db);
$title = $_POST['insight_title'];
$date = $_POST['insight_date'];
$author = $_POST['author_name'];
$content = $_POST['insight_notes'];
$fileName="";
//Error messages
$phpFileUPloadErrors = array(
    0 => 'there is no error the file is successful uploaded',
    1 => 'the file is too large',
    2 => 'the file exceeded the size that is specified',
    3 => 'the uploaded file was only partially uploaded',
    4 => 'no file was uploaded',
    6 => 'missinng a temporary folder',
    7 => 'failed to write files to disk',
    8 => 'a php extension stopped the file upload'
    );

if(!empty($_POST['id']))
{
    $id = $_POST['id'];
     $insight->setInsight($_POST['id']);
    if(!empty( $_FILES['insight_pic']['name']))
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
                    move_uploaded_file($file_array['tmp_name'] ,'../img/'.$file_array['name']);
                   
            }
       }
       $fileName= $file_array['name'];
   }
   else{
    $fileName= $insight->getImage();
   }
         
    $query= $db->prepare("UPDATE `insight` SET `insight_title`=?,`insight_date`= ?, `insight_content`=? ,`insight_author` = ?,`insight_img` = ? WHERE md5(id) =?");
    $query->execute(array($title,$date,$content,$author,$fileName,$id));
    ?>
    <script type="text/javascript"> window.location = "add-insight?id=<?php echo$id;?>"</script>
    <?php
}
else{
    
        $file_array = $_FILES['insight_pic'];
        
            if($file_array['error'])
            {
                ?> <div class ="alert alert-danger">
                <?php echo $file_array['name']. ' - '.$phpFileUPloadErrors[$file_array['error']];?>
                </div>
                <?php
            }
            else{
                $allow = array('jpg','png','jpeg','svg');
                $fileExt = explode('.',$file_array['name']);
                $fileActualExt = strtolower(end($fileExt));
                if(!in_array($fileActualExt, $allow))
                {
                    ?> <div class ="alert alert-danger">
                <?php echo "{$file_array['name']} -invalid file extension"?>
                </div>
                <?php
                }
                else
                {
                    move_uploaded_file($file_array['tmp_name'] ,'../img/'.$file_array['name']);
                    ?> <div class ="alert alert-danger">
                <?php echo $file_array['name']. ' - '.$phpFileUPloadErrors[$file_array['error']];
                      
                ?>
                </div>
                <?php  
                
            }
       }
         $fileName= $file_array['name'];  

$query = $db->prepare("INSERT INTO `insight`(`insight_title`, `insight_date`,`insight_author`,`insight_content`, `insight_img`) VALUES (?,?,?,?,?)");
$query->execute(array($title,$date,$author,$content,$fileName));
?>
<script type="text/javascript"> window.location = "insight"</script>
<?php
}  

?>