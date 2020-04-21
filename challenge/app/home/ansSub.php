<?php
require_once('../scripts/auth.php');
session_start();

 // echo $_SESSION['username'];


// echo $_GET['answer'];


$res2 = mysqli_query($dbhandle, "SELECT * FROM players WHERE username='".$_SESSION['username']."'");
 while($row = mysqli_fetch_assoc($res2)) {
    $uid = $row['uid'];
    $lvl = $row['level'];
 }


 // print_r($res2);

// if (isset($_POST['submit'])){
$rawstr = strtolower(mysqli_escape_string($_POST['answer']));
$answer = md5(str_replace(' ','',$rawstr));
$res = mysqli_query($dbhandle, "SELECT * FROM levels WHERE level='$lvl'");
 while($row = mysqli_fetch_assoc($res)) {
    $correctanswer = $row['answer'];
    $level = $row['level'];
 }

$result = mysqli_query($dbhandle, "SELECT * FROM players WHERE uid='$uid'");
 while($row = mysqli_fetch_assoc($result)) {
    $name = $row['name'];
    $username = $row['username'];
    $level = $row['level'];
 }

$ip = "";

if (!empty($_SERVER["HTTP_CLIENT_IP"]))
{
 //check for ip from share internet
 $ip = $_SERVER["HTTP_CLIENT_IP"];
}
elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
{
 // Check for the Proxy User
 $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
}
else
{
 $ip = $_SERVER["REMOTE_ADDR"];
}

 if (function_exists('date_default_timezone_set'))
 		{
 			  date_default_timezone_set('Asia/Calcutta');
 			}
 			$date = date('Y-m-d H:i:s');

$response = array();


$ansarray = json_decode($correctanswer);
$arrcount = count($ansarray);

// print_r($correctanswer);

// if ($answer == $correctanswer) {
// 	$response["correct"] = 1;
// 	// header("Location: play.php");
// 	// $newlevel = $level + 1;
// 	// $query = "UPDATE `players` SET `level` = '{$newlevel}' , time = '{$date}' WHERE `uid` = '{$uid}'";
// 	// $result = mysqli_query($dbhandle, $query);
// 	// $query2 = "INSERT INTO submits(name,username,answer,level,status,ip,time) VALUES ('$name','$username','$answer','$level','Correct Answer','$ip','$date')";
// 	// $result2 = mysqli_query($dbhandle, $query2);
// }
// else {
// 	// $response["correct"] = 0;
// 	header("Location: play.php?msg=1");
// 	$submitted_ans = strtolower(mysqli_real_escape_string($dbhandle, $_POST['answer']));
//     $trimmedstr = str_replace(' ','',$submitted_ans);
// 	$query3 = "INSERT INTO submits(name,username,answer,level,status,ip,time) VALUES ('$name','$username','$trimmedstr','$level','Wrong Answer','$ip','$date')";
// 	$result3 = mysqli_query($dbhandle, $query3);
// }

for ($i=0; $i < $arrcount; $i++) { 
	if ($answer == $ansarray[$i]) {
		// echo "Response = 1 | \n";
		$response['correct'] = 1;
		break;
	}
	else
		 {
		 	// echo "Response = 0 | \n";
			$response['correct'] = 0;
		 }
}

// print_r($response);

if ($response['correct'] == 1) {
	// echo "level solved";
	// echo "response=1";
	// echo $response['correct'];
	// header("Location: play.php");
	$newlevel = $level + 1;
	$query = "UPDATE `players` SET `level` = '{$newlevel}' , time = '{$date}' WHERE `uid` = '{$uid}'";
	$result = mysqli_query($dbhandle, $query);
	$query2 = "INSERT INTO submits(name,username,answer,level,status,ip,time) VALUES ('$name','$username','$answer','$level','Correct Answer','$ip','$date')";
	$result2 = mysqli_query($dbhandle, $query2);
	// print_r($result2);
}
elseif ($response['correct'] == 0) {
	// echo "try again";
	// echo "response=0";
	// header("Location: play.php?msg=1");
	$submitted_ans = strtolower(mysqli_real_escape_string($dbhandle, $_POST['answer']));
    $trimmedstr = str_replace(' ','',$submitted_ans);
	$query3 = "INSERT INTO submits(name,username,answer,level,status,ip,time) VALUES ('$name','$username','$trimmedstr','$level','Wrong Answer','$ip','$date')";
	$result3 = mysqli_query($dbhandle, $query3);
	// if ($result3) {
	// 	echo "inserted";
	// }
	// else {
	// 	echo mysqli_error();
	// }
	// print_f($result3);
}
else {
	header("Location: play.php?msg=2");
	// echo "lol";
}


// }

// else {
// 	echo "answer not submitted";
// }

echo json_encode($response);

 // echo "string";
?>
