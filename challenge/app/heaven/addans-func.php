<?php 
require_once('../scripts/dbconnect.php');
require_once('../scripts/admin_auth.php');

  // if (isset($_POST['newans'])) {
    $newans = $_POST['newans'];  
  // }

  $lvlid = $_POST['levelno'];

  $newans = md5($newans);

  $result = mysqli_query($dbhandle, "SELECT * FROM levels WHERE id='$lvlid'");
     while($row = mysqli_fetch_assoc($result)) {
        $answers = $row['answer'];
     }
        $json = json_decode($answers);

        array_push($json, $newans);



        $newanswers = json_encode($json);
        print_r($newanswers);

        $sql = "UPDATE levels SET answer='$newanswers' WHERE id='$lvlid'";
        if (mysqli_query($dbhandle, $sql)) {
          // echo "Answer added";
          header("Location: editlvl.php?msg=4&lid={$lvlid}");
        }
        else
        {
          echo "Error adding answers : " . mysqli_error();
        }

 ?>