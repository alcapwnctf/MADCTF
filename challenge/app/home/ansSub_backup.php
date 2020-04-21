 <?php
require_once('../scripts/dbconnect.php');
session_start();

$res2 = mysqli_query($dbhandle, "SELECT * FROM players WHERE username='".$_SESSION['username']."'");
 while($row = mysqli_fetch_assoc($res2)) {
    $uid = $row['uid'];
    $lvl = $row['level'];
 }

 // print_r($res2);

if (isset($_POST['submit'])){
$rawstr = strtolower(mysqli_real_escape_string($dbhandle, $_POST['answer']));
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
if ($answer == $correctanswer) {
	// $response["correct"] = 1;
	header("Location: play.php");
	$newlevel = $level + 1;
	$query = "UPDATE `players` SET `level` = '{$newlevel}' , time = '{$date}' WHERE `uid` = '{$uid}'";
	$result = mysqli_query($dbhandle, $query);
	$query2 = "INSERT INTO submits(name,username,answer,level,status,ip,time) VALUES ('$name','$username','$answer','$level','Correct Answer','$ip','$date')";
	$result2 = mysqli_query($dbhandle, $query2);
}
else {
	// $response["correct"] = 0;
	header("Location: play.php?msg=1");
	$submitted_ans = strtolower(mysqli_real_escape_string($dbhandle, $_POST['answer']));
        $trimmedstr = str_replace(' ','',$submitted_ans);
	$query3 = "INSERT INTO submits(name,username,answer,level,status,ip,time) VALUES ('$name','$username','$trimmedstr','$level','Wrong Answer','$ip','$date')";
	$result3 = mysqli_query($dbhandle, $query3);
}

}
?>
