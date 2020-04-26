<?php 
require_once('dbconnect.php');
if (isset($_POST['username']) and isset($_POST['password'])){
$username = mysqli_real_escape_string($dbhandle, $_POST['username']);
$password = md5(mysqli_real_escape_string($dbhandle, $_POST['password']));
$res = mysqli_query($dbhandle, "SELECT * FROM players WHERE username='$username'"); 
 while($row = mysqli_fetch_assoc($res)) {
    $usertype = $row['usertype'];
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


$query = "SELECT * FROM `players` WHERE username='$username' and password='$password'";
$result = mysqli_query($dbhandle, $query) or die(mysqli_error());
$row = mysqli_fetch_assoc($result);
$name = $row['name'];

$count = mysqli_num_rows($result);

if ($count == 1){
session_start();
$_SESSION['username'] = $username; 
 if (function_exists('date_default_timezone_set'))
 		{
 			  date_default_timezone_set('Asia/Calcutta');
 			}
 			$date = date('Y-m-d h:i:s A');
if (mysqli_query($dbhandle, "INSERT INTO login(username,name,status,ip,time) VALUES('$username','$name','successful','$ip','$date')")) {
	// echo "done";
}
else {
	// echo "error " . mysqli_error();
}
if ($usertype == 1) {
header("Location: ../home/dashboard.php");
	// echo "success";
}
elseif ($usertype == 2) {
header("Location: ../heaven/index.php");
	// echo "heaven";
}
else{
header("Location: ../index.php?msg=2");
}
}
else{
header("Location: ../index.php?msg=1");
}
}


?>