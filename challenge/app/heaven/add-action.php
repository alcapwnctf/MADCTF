<?php 
require_once('../scripts/dbconnect.php');
//require_once('../scripts/admin_auth.php');

if (isset($_POST['submit'])) {

  $uploaddir = '../home/imgques/';
  $uploadfile = $uploaddir . basename($_FILES['image']['name']);

  //echo '<pre>';
  if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
      // echo "File is valid, and was successfully uploaded.\n";
  } else {
       //echo "Nahi hui upload!\n";
  }

  // echo 'Here is some more debugging info:';
  // print_r($_FILES);

  //print "</pre>";

  $level = mysqli_real_escape_string($dbhandle, $_POST['level']);
  $question = mysqli_real_escape_string($dbhandle, $_POST['question']);
  // $answer = md5(mysqli_real_escape_string($dbhandle, $_POST['answer']));
  $answers = $_POST['answers'];
  $image = basename($_FILES['image']['name']);
  $html = $_POST['html'];
  $hint = $_POST['hint'];
  $description = mysqli_real_escape_string($dbhandle, $_POST['description']);

$no = count($answers);

for ($i=0; $i < $no; $i++) { 
  $answers[$i] = md5($answers[$i]);
}

$ansarr = json_encode($answers);

  //print_r($ansarr);



$query = "INSERT INTO levels(level,question,answer,image,html,hint,description) VALUES('$level','$question','$ansarr','$image','$html','$hint','$description')";
$result = mysqli_query($dbhandle, $query);
if ($result) {
  header("Location: levels.php");
    // echo "success";
}
else {
  // header("Location: ");
    echo $html;
    echo "error creating question: " . mysqli_error();
}

}
else {
echo "Error";
 }
?>