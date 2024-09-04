<?php
if(isset($_SESSION['id'])) {
	unset($_SESSION['id']);
	session_destroy();	
}
if(isset($_SESSION['corpid'])){
	unset($_SESSION['corpid']);
	session_destroy();
}