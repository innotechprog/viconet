<?php
/* Database config */
$db_host		= 'localhost';
$db_user		= 'root';
$db_pass		= '';
$db_database	= 'vico'; 

/* End config */
$db = new PDO('mysql:host='.$db_host.';dbname='.$db_database, $db_user, $db_pass);

date_default_timezone_set('Africa/johannesburg');
?>