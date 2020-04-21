<?php 
require_once('../scripts/dbconnect.php');
session_start();
if (!isset($_SESSION['username'])) {
	header("Location: ../index.php");
}

// Disqualification Check

$result = mysqli_query($dbhandle, "SELECT * FROM players WHERE username='".$_SESSION['username']."'");
while ($row = mysqli_fetch_assoc($result)) {
      $status = $row['status'];
}

if ($status == 2) {
	header("Location: disqualified.php");
}

?>