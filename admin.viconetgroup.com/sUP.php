<?php
include "include/connect.php";
include "include/functions.php";
$corp = new Corporate($db);
$idss = $_POST['idss'];

$userName = $_POST['userName'];
$userSurname = $_POST['userSurname'];
$userCell = $_POST['userCellphone'];
$id = $_POST['id'];
$corp->updateCorporate($userName,$userSurname,$userCell,$id);
?>