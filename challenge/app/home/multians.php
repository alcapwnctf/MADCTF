<?php 
require_once('../scripts/dbconnect.php');
session_start();
$answers = ['bapu'];

$no = count($answers);

for ($i=0; $i < $no; $i++) { 
	$answers[$i] = md5($answers[$i]);
}

$ansarr = json_encode($answers);

// print_r($ansarr);

if(mysqli_query($dbhandle, "INSERT INTO levels (level,question,answer,description) VALUES ('3','bapu','$ansarr','lvl bapu with array')")) {
	echo "success";
}
else {
	echo mysqli_error();
}

?>
