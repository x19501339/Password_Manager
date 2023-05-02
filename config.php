<?php

/*Session*/
session_start();

/*DATABASE CREDENTIALS*/
define("DB_HOST", 'localhost');
define("DB_USER", 'root');
define("DB_PASS", '');
define("DB_TABLE", 'user_db');

$conn = mysqli_connect(DB_HOST, DB_USER , DB_PASS , DB_TABLE);
/*Check Connection*/
if (!$conn) 
{
	die("Connection failed: " . mysqli_connect_error());
}




/**
 * dump -start
 * cookie lock
 * debuging live production server
 * 
 */

 function _d($m, $dump = 0)
 {
	
 
	 // display error
	 ini_set('display_errors', 1);
	 ini_set('display_startup_errors', 1);
	 error_reporting(E_ALL);
 
	 echo '<pre>';
	 if ($dump == 0) print_r($m);
	 if ($dump == 1) var_dump($m);
	 if ($dump == 2) print_r(htmlspecialchars($m));
	 echo '</pre>';
 }
 function _dd($m, $dump = 0)
 {
	 _d($m, $dump);
	 die();
 }
 function _dbm()
 {
	 $cookie = 'dd';
	 if (isset($_GET[$cookie]) || isset($_COOKIE[$cookie])) {
		 return true;
	 }
	 return false;
 }
?>