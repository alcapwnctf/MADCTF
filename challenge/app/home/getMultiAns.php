<?php 
require_once('../scripts/dbconnect.php');
session_start();

$res = mysqli_query($dbhandle, "SELECT * FROM levels WHERE level='1'");
 while($row = mysqli_fetch_assoc($res)) {
    $level = $row['level'];
    $ques = $row['question'];
    $ans = $row['answer'];
    $descr = $row['description'];
 }

$ansarray = json_decode($ans);
$arrcount = count($ansarray);

// print_r($ansarray);

$rawstr = "samba";
$encrypted = md5($rawstr);

for ($i=0; $i < $arrcount; $i++) { 
	if ($encrypted == $ansarray[$i]) {
		echo "obj found | \n";
		break;
	}
	else
		 {
		 	echo "obj not found | \n";
		 }
}

?>
