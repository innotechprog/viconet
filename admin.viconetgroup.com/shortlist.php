<?php
session_start();
include "include/connect.php";
include "include/functions.php";
include 'include/corp_auth.php';

if(isset($_POST['id'])){
echo $corp->countCandatesInBasket();
}
else if(isset($_POST['c_email'])){
	//Declaring and assigning variables
$desc = "";
$fakeId = md5("receId");
$status = md5("consid");
$c_email = $_POST['c_email'];
$cand_num = $_POST['cand_num'];
$comp_reg = md5($corp->getCompReg());
$userEmail = md5($corp->getUserEmail());
//Add to shortlist table
$corp->addToBasket($fakeId,$comp_reg,$userEmail,$c_email,$cand_num,$status);
}
else if(isset($_GET['cand_id'])){
$c_email = $candidate->getCandEmailByID($_GET['cand_id']);
$fakeId = md5("receId");
$comp_reg = md5($corp->getCompReg());
$cand_num = $_GET['cand_num'];
$userEmail = md5($corp->getUserEmail());
$desc = "";
$status = md5("consid");
//Add to Basket table
$corp->addToBasket($fakeId,$comp_reg,$userEmail,$c_email,$cand_num,$status);
//$corp->addToReceipt($receipt_id,$comp_reg,$desc,$status); 
}
else if (isset($_GET['cand_id2'])) {
$c_email = $candidate->getCandEmailByID($_GET['cand_id2']);
$fakeId = md5("receId2");
$comp_reg = md5($corp->getCompReg());
$cand_num = $_GET['cand_num'];
$userEmail = md5($corp->getUserEmail());
$desc = "";
$status = md5("consid");
//Add to Basket table
$corp->addToBasket($fakeId,$comp_reg,$userEmail,$c_email,$cand_num,$status);
}
?>
