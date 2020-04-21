<?php 
require_once('../scripts/dbconnect.php'); 
session_start();

$res = mysqli_query($dbhandle, "SELECT * FROM players WHERE username='".$_SESSION['username']."'");
while ($row = mysqli_fetch_assoc($res)) {
	$currentlvl = $row['level'];
}

$r = mysqli_query($dbhandle, "SELECT * FROM levels WHERE level='$currentlvl'");

while ($ro = mysqli_fetch_assoc($r)) {
	$question=$ro['question'];
	$image=$ro['image'];
	$html=$ro['html'];
	$hint=$ro['hint'];
}

$level = array();

$level['level']=$currentlvl;
$level['question']=$question;
$level['image']=$image;
$level['html']=$html;
$level['hint']=$hint;

echo json_encode($level);

 ?>