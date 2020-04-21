<?php 
require_once('../scripts/dbconnect.php');
require_once('../scripts/admin_auth.php');

        $sql = "DELETE FROM submits";
        if (mysqli_query($dbhandle, $sql)) {
          // echo "Answer added";
          header("Location: settings.php?msg=2");
        }
        else
        {
          echo "Error clearing submits : " . mysqli_error();
        }

 ?>