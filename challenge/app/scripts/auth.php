<?php 
require_once('../scripts/dbconnect.php');
session_start();
if (!isset($_SESSION['username'])) {
	header("Location: ../index.php");
}

?>