<?php 
require_once('../scripts/dbconnect.php');
if (isset($_POST['submit'])) {
	$uid = rand(10000000, 100000000);
	$name = mysqli_real_escape_string($dbhandle, $_POST['name']);
	$username = mysqli_real_escape_string($dbhandle, $_POST['username']);
	$password = md5(mysqli_real_escape_string($dbhandle, $_POST['password']));
	$school = mysqli_real_escape_string($dbhandle, $_POST['school']);
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

$query = "INSERT INTO players(uid,name,username,school,password,usertype,level,status,ip) VALUES('$uid','$name','$username','$school','$password','1','0','1','$ip')";
$result = mysqli_query($dbhandle, $query);
if ($result) {
	header("Location: createacc.php?msg=1");
}
else {
	header("Location: createacc.php?msg=2");
}

 // if(mysqli_query($dbhandle, "INSERT INTO players(uid,name,email,username,password,status,usertype,ip) VALUES('$uid','$name','$email','$username','$password',1,1,'$ip')"))
 // {
 //  header("Location: index.php");
 // }
 // else
 // {
   
 //  echo "Error: " . mysqli_error();
    
 // }
}
else {
echo "Error: " . mysqli_error();
 }
?>
