<?php
	$username = getenv('DBUSER');
	$password = getenv('DBPASS');
	$hostname = getenv('DBHOST');
	$database = getenv('DBNAME');

	ini_set('session.gc_maxlifetime', 3600*3);
	$dbhandle = mysqli_connect($hostname, $username, $password) 
  		or die("Unable to connect to MySQL");
	

  	$selected_db = mysqli_select_db($dbhandle,$database) 
 		 or die("Could not select ".$database);

?>