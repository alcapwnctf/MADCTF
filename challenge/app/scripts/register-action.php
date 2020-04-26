<?php 
require_once('dbconnect.php');
if (isset($_POST['submit'])) {
	$uid = rand(10000000, 100000000);
	$name = mysqli_real_escape_string($dbhandle, $_POST['name']);
	$email = mysqli_real_escape_string($dbhandle, $_POST['email']);
	$username = mysqli_real_escape_string($dbhandle, $_POST['username']);
	$password = md5(mysqli_real_escape_string($dbhandle, $_POST['password']));
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

	$query = "INSERT INTO players(name,email,username,password,usertype,money,ip) VALUES('$name','$email','$username','$password','1','10000','$ip')";
	$result = mysqli_query($dbhandle, $query);

	if ($result) {
		header("Location: ../register.php?msg=1");
	}
	else {
		header("Location: ../register.php?msg=2");
	}
}
?>