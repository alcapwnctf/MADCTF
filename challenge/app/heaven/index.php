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
	<h1 class="heading">Admin Panel</h1>
	
	<table id="hor-zebra">
    <thead>
    	<tr>
        	<th scope="col">Rank</th>
            <th scope="col">Admission Number</th>
            <th scope="col">Name</th>
            <th scope="col">Level</th>
            <th scope="col">Last Level Time</th>
            <th scope="col">User Attempts</th>
        </tr>
    </thead>
    <tbody>
        <?php
    $rank = 1;
    $completed = 27; //Set 1 + Last Level
     $result = mysqli_query($dbhandle, "SELECT * FROM players WHERE status=1 AND usertype=1 ORDER by level DESC,time");
     while ($row = mysqli_fetch_assoc($result)) {
      $name = ucwords($row['name']);
      $player = $row['username'];
      $level = $row['level'];
      if ($level == $completed) {
        $level = "Completed!";
      }
      $time = $row['time'];
  $ctr=0;
$result2 = mysqli_query($dbhandle, "SELECT * FROM submits WHERE username='{$player}'");
     while ($row = mysqli_fetch_assoc($result2)) {
       $ctr++;

     }

      echo "<tr>
            <td>{$rank}</td>
            <td>{$player}</td>
            <td>{$name}</td>
            <td>{$level}</td>
            <td>{$time}</td>
              <td>{$ctr}</td>
            </tr>";
     $rank++;
     }
     ?>      	
    </tbody>
</table>

<div class="responsive-lead">
<?php 
for ($i=1; $i < 11; $i++) { 
  echo "<div class='dabba'>
  <p class='school'>ONLINE LOCKDOWN HUNT</p>
  <div class='expand' onclick='leaderboard{$i}()'>
    <i id='arrow{$i}' class='fa fa-angle-down' aria-hidden='true'></i>
  </div>
  <div class='clear'></div>
  </div>
  <div class='expanded' id='expanded{$i}'>
    <table class='responsive-table'>
      <tr>
        <th>Rank</th>
        <td>1</td>
      </tr>
      <tr>
        <th>Level</th>
        <td>17</td>
      </tr>
      <tr>
        <th>Last Level Time</th>
        <td>12:30 04-26-2017</td>
      </tr>
      <tr>
        <th>User Attempts</th>
        <td>786</td>
      </tr>
    </table>
  </div>";
}
 ?>
	<!-- <div class="dabba">
	<p class="school">ONLINE LOCKDOWN HUNT</p>
	<div class="expand" onclick="leaderboard()">
		<i id="arrow" class="fa fa-angle-down" aria-hidden="true"></i>
	</div>
	<div class="clear"></div>
	</div>
	<div class="expanded" id="expanded">
		<table class="responsive-table">
			<tr>
				<th>Rank</th>
				<td>1</td>
			</tr>
			<tr>
				<th>Level</th>
				<td>17</td>
			</tr>
			<tr>
				<th>Last Level Time</th>
				<td>12:30 04-26-2017</td>
			</tr>
			<tr>
				<th>User Attempts</th>
				<td>786</td>
			</tr>
		</table>
	</div> -->

</div>



<!-- <table>
	<thead>
	<tr class="table-headers">
    <th>Rank</th>
    <th>Username</th>
    <th>Level</th>
    <th>Last Level Time</th>
    <th>User Attempts</th>
	</tr>
	</thead>
	<tbody>
    <tr>
      <td>1</td>
      <th class="mobile-header">Username</th><td>ONLINE LOCKDOWN HUNT</td>
      <th class="mobile-header">Level</th><td>15</td>
      <th class="mobile-header">Last Level Time</th><td>12:30 04-26-2017</td>
      <th class="mobile-header">User Attempts</th><td>786</td>
    </tr>
     <tr>
      <td>2</td>
      <th class="mobile-header">Username</th><td>CORE</td>
      <th class="mobile-header">Level</th><td>14</td>
      <th class="mobile-header">Last Level Time</th><td>12:04 04-26-2017</td>
      <th class="mobile-header">User Attempts</th><td>491</td>
    </tr>
    <tr>
      <td>3</td>
      <th class="mobile-header">Username</th><td>ESPICE</td>
      <th class="mobile-header">Level</th><td>12</td>
      <th class="mobile-header">Last Level Time</th><td>11:45 04-26-2017</td>
      <th class="mobile-header">User Attempts</th><td>675</td>
    </tr>
    <tr>
      <td>4</td>
      <th class="mobile-header">Username</th><td>MSBK</td>
      <th class="mobile-header">Level</th><td>9</td>
      <th class="mobile-header">Last Level Time</th><td>07:43 04-26-2017</td>
      <th class="mobile-header">User Attempts</th><td>357</td>
    </tr>
	</tbody>
</table> -->



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