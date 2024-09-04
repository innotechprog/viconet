<?php
session_start();
include "include/connect.php";
include "include/functions.php";
$corp = new Corporate($db);
include "include/website_class.php";
$web = new Website($db); //Website class
include 'include/corp_auth.php';

$filename = $_GET['id'];
$pdfFilePath = "https://".$web->getWebLinkExt()."talent.viconetgroup.com/cv/".$filename;
?>
<div style="width: 100%; height:100vh">
        <iframe src="<?php echo $pdfFilePath ?>" width="100%" height="100%"></iframe>
</div> ;
    
