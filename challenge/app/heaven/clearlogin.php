<?php 
require_once('../scripts/dbconnect.php');
require_once('../scripts/admin_auth.php');

        $sql = "DELETE FROM login";
        if (mysqli_query($dbhandle, $sql)) {
          // echo "Answer added";
          header("Location: settings.php?msg=3");
        }
        else
        {
          echo "Error clearing login : " . mysqli_error();
        }

 ?>