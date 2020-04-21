<?php 
require_once('../scripts/dbconnect.php');
session_start(); 

$sql = "SELECT * FROM players WHERE username='".$_SESSION['username']."'";
$result = mysqli_query($dbhandle, $sql);
while ($row = mysqli_fetch_assoc($result)) {
	$status=$row['status'];
}

if ($status == 2) {
	//dqed
	echo 1;
}
else {
	//playing
	echo 0;
}

 ?>