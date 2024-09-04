<?php
session_start();
include "include/connect.php";
include "include/functions.php";
include 'include/auth.php';
$id= $_GET['id'];
$table = $_GET['ta'];
$field = $_GET['fi'];
$query=$db->prepare("DELETE FROM $table WHERE $field ='$id'");
$query->execute();

?>