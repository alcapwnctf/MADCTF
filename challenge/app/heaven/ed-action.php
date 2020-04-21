<?php 
require_once('../scripts/dbconnect.php');
require_once('../scripts/admin_auth.php');

  if (isset($_GET['lid'])) {
    $lid = $_GET['lid'];  
  }

  if (isset($_GET['f'])) {
    $f = $_GET['f'];  
  }
$remove=0;
  if (isset($_POST['removeimg'])) {
    $remove=1;
  }

  if (isset($_POST['submit'])) {

    if ($f=="image") {
      if ($remove==1) {
        $sql = "UPDATE levels SET {$f}='' WHERE id='$lid'";
          if (mysqli_query($dbhandle, $sql)) {
    header("Location: levels.php");
    // echo "success";
  }
  else {
    header("Location: levels.php?msg=1");
    // echo "error: " . mysqli_error();
  }
      }
      else {

       $uploaddir = '../home/imgques/';
       $uploadfile = $uploaddir . basename($_FILES[$f]['name']);

       echo '<pre>';
        if (move_uploaded_file($_FILES[$f]['tmp_name'], $uploadfile)) {
            echo "File is valid, and was successfully uploaded.\n";
        } 

        else {
            echo "Nahi hui upload!\n";
        }

  // echo 'Here is some more debugging info:';
  // print_r($_FILES);

  print "</pre>";

  $nfile = basename($_FILES[$f]['name']);
        $sql = "UPDATE levels SET {$f}='$nfile' WHERE id='$lid'";
          if (mysqli_query($dbhandle, $sql)) {
    header("Location: levels.php");
    // echo "success";
  }
  else {
    header("Location: levels.php?msg=1");
    // echo "error: " . mysqli_error();
  }
      }
    }
    else {

$fnval = $_POST[$f];

  $sql = "UPDATE levels SET {$f}='$fnval' WHERE id='$lid'";

  if (mysqli_query($dbhandle, $sql)) {
    header("Location: levels.php");
    // echo "success";
  }
  else {
    header("Location: levels.php?msg=1");
    // echo "error: " . mysqli_error();
  }
    }

  

  }


 ?>