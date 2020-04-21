<?php 
require_once('../scripts/dbconnect.php');
require_once('../scripts/admin_auth.php');

  if (isset($_GET['uid'])) {
    $uid = $_GET['uid'];  
  }

  $sql = "UPDATE players SET status='0' WHERE uid='$uid'";

  if (mysqli_query($dbhandle, $sql)) {
  	header("Location: players.php");
  }
  else {
  	header("Location: players.php?msg=1");
  }
 ?>