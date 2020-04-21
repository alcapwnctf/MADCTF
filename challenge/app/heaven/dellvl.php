<?php 
require_once('../scripts/dbconnect.php');
require_once('../scripts/admin_auth.php');

  if (isset($_GET['lid'])) {
    $lid = $_GET['lid'];  
  }

  $sql = "DELETE FROM levels WHERE id='$lid'";

  if (mysqli_query($dbhandle, $sql)) {
  	header("Location: levels.php");
    // echo "success";
  }
  else {
  	header("Location: levels.php?msg=1");
  }
 ?>