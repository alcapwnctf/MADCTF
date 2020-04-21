<?php 
require_once('../scripts/dbconnect.php');
session_start();

$result = mysqli_query($dbhandle, "SELECT * FROM players WHERE username='".$_SESSION['username']."'");
while ($row = mysqli_fetch_assoc($result)) {
      $usertype = $row['usertype'];
}


if (!isset($_SESSION['username'])) {
	header("Location: ../index.php");
}
else {
	if ($usertype == 2) {
}
else {
	header("Location: ../index.php?msg=3");
}

}
?>