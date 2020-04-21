<?php 
require_once('../scripts/dbconnect.php');
require_once('../scripts/admin_auth.php');

  // if (isset($_POST['newans'])) {
    $newanswers = $_POST['newanswers'];  
  // }

  $lvlid = $_POST['levelid'];

  $a = count($newanswers);

  for ($i=0; $i < $a; $i++) { 
    $newanswers[$i] = md5($newanswers[$i]);
  }

  $newjson = json_encode($newanswers);

  print_r($newjson); 

        $sql = "UPDATE levels SET answer='$newjson' WHERE id='$lvlid'";
        if (mysqli_query($dbhandle, $sql)) {
          // echo "Answer added";
          header("Location: editlvl.php?msg=4&lid={$lvlid}");
        }
        else
        {
          echo "Error changing answers : " . mysqli_error();
        }

 ?>