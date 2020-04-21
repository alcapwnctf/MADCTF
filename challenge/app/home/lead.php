<?php require_once('../scripts/dbconnect.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>DECODE 2020 | ONLINE LOCKDOWN HUNT</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
	<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
</head>
<body>
	<div class="container">
		<div class="ham" onclick="fadeIn()">
			<div class="hamlines" id="hamlines"></div>
			<div class="hamlines" id="hamlines2"></div>
			<div class="hamlines" id="hamlines3"></div>
		</div>

		<div class="side" id="side">
			<img src="logo.png" class="im">
			<hr>

			<div class="option">
			<center>
			<br><br>
				<a href="play.php"><div class="be">play</div></a>
				<a href="rules.php"><div class="be">rules</div></a>
        <a href="https://www.facebook.com/infinitycryptichunt"><div class="be">hints</div></a>
				<a href="lead.php"><div class="be">leaderboard</div></a>
				<a href="https://forms.gle/ArP2LVWQqo1WBweY6"><div class="be">contact</div></a>
				<a href="logout.php"><div class="be">logout</div></a>
			</center>
			</div>
		</div>

		<div class="mc">
			<div class="main">
				<center>
	<h1 class="heading">Leaderboard</h1>
<table id="hor-zebra">
    <thead>
      <tr style="background: none;">
      <th scope="col">Rank</th>
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

</div>


	</center>
			</div>


		</div>


		<div class="main2" id="main2" onclick="fadeOut()">

		</div>
	</div>
<script type='text/javascript' src='animations.js'></script>
</body>
</html>