<?php 
require_once('../scripts/dbconnect.php');
require_once('../scripts/admin_auth.php');

        $sql = "DELETE FROM players WHERE usertype != '2'";
        if (mysqli_query($dbhandle, $sql)) {
          // echo "Answer added";
          header("Location: settings.php?msg=4");
        }
        else
        {
          echo "Error deleting players : " . mysqli_error();
        }

 ?>