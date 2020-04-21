<?php 
require_once('../scripts/dbconnect.php');
require_once('../scripts/admin_auth.php');

        $sql = "DELETE FROM levels";
        if (mysqli_query($dbhandle, $sql)) {
          // echo "Answer added";
          header("Location: settings.php?msg=1");
        }
        else
        {
          echo "Error deleting levels : " . mysqli_error();
        }

 ?>