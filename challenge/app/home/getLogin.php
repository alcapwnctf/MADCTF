<?php 
require_once('../scripts/dbconnect.php'); 
session_start(); 

if (isset($_SESSION['username'])) {
	echo 1;
}
else {
	echo 0;
}

 ?>