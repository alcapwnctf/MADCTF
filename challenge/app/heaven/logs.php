<?php 
require_once('../scripts/admin_auth.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>DECODE 2020 | ONLINE LOCKDOWN HUNT</title>
	<link rel="stylesheet" type="text/css" href="admin.css">
	<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
</head>
<body>
	<div class="top">
		<img src="logo.png" class="logo">
		<div class="ham" onclick="fadeIn()">
			<div class="hamlines" id="hamlines"></div>
			<div class="hamlines" id="hamlines2"></div>
			<div class="hamlines" id="hamlines3"></div>
		</div>
		<div class="container">
			<a href="index.php"><div>home</div></a>
			<a href="players.php"><div>players</div></a>
			<a href="levels.php"><div>levels</div></a>
			<a href="logs.php"><div>logs</div></a>		
			<a href="settings.php"><div>settings</div></a>		
			<a href="logout.php"><div>logout</div></a>		
		</div>
	</div>
	<center>
	<div class="sidenav" id="sidenav">
	<div class="little-space"></div>
			<a href="index.php"><div>home</div></a>
			<a href="players.php"><div>players</div></a>
			<a href="levels.php"><div>levels</div></a>
			<a href="logs.php"><div>logs</div></a>		
			<a href="settings.php"><div>settings</div></a>		
			<a href="logout.php"><div>logout</div></a>		
	</div>
	<br><br>
  <h1 class="heading">Login Logs</h1>

<table border="1" class="common-table" cellpadding="20">
    <tr>
      <th>S. No.</th>
      <th>Name</th>
      <th>Admission Number</th>
      <th>Status</th>
      <th>IP</th>
      <th>Time</th>
    </tr>

    <?php 
    $sn=1;
$result = mysqli_query($dbhandle, "SELECT * FROM login ORDER BY time asc");
while ($row = mysqli_fetch_assoc($result)) {
      $name = $row['name'];
      $username = $row['username'];
      $status = $row['status'];
      $ip = $row['ip'];
      $time = $row['time'];

      echo "<tr>
            <td>{$sn}</td>
            <td>{$name}</td>
            <td>{$username}</td>
            <td>{$status}</td>
            <td>{$ip}</td>
            <td>{$time}</td>
            </tr>";

$sn++;
}  
?>
  </table>

	<h1 class="heading">Submit Logs</h1>
	
 <table border="1" class="common-table" cellpadding="20">
    <tr>
      <th>S. No.</th>
      <th>Name</th>
      <th>Admission Number</th>
      <th>Answer</th>
      <th>Level</th>
      <th>Status</th>
      <th>IP</th>
      <th>Time</th>
    </tr>

    <?php 
    $sno=1;
$result = mysqli_query($dbhandle, "SELECT * FROM submits ORDER BY time desc");
while ($row = mysqli_fetch_assoc($result)) {
      $name = $row['name'];
      $username = $row['username'];
      $answer = $row['answer'];
      $level = $row['level'];
      $status = $row['status'];
      $ip = $row['ip'];
      $time = $row['time'];

      echo "<tr>
            <td>{$sno}</td>
            <td>{$name}</td>
            <td>{$username}</td>
            <td>{$answer}</td>
            <td>{$level}</td>
            <td>{$status}</td>
            <td>{$ip}</td>
            <td>{$time}</td>
            </tr>";

$sno++;
}  
?>
  </table>

<br><br><br>

	<div onclick="fadeOut()" class="overlay" id="overlay"></div>

	</center>
	<script type="text/javascript">

		function fadeIn(){
				document.getElementById('sidenav').style.right = '0%'
				document.getElementById('overlay').style.opacity = '0.7'
				document.getElementById('overlay').style.zIndex = '1'
		}

       function fadeOut() {
       			document.getElementById('sidenav').style.right = '-300px'
       			document.getElementById('overlay').style.opacity = '0'
				document.getElementById('overlay').style.zIndex = '-1'
       }

	</script>
</body>
</html>