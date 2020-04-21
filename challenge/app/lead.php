<?php require_once('scripts/dbconnect.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>DECODE 2020 | ONLINE LOCKDOWN HUNT</title>
	<link rel="stylesheet" type="text/css" href="index.css">
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
      <a href="index.php">Home</a>
      <a href="register.php">Register</a>
      <a href="https://www.facebook.com/infinitycryptichunt">Hints</a>
      <a href="rules.php">rules</a>
      <a href="lead.php">leaderboard</a>
      <a href="https://forms.gle/ArP2LVWQqo1WBweY6">contact</a>   
    </div>
  <center>
  <div class="sidenav" id="sidenav">
  <div class="little-space"></div>
      <a href="index.php">Home</a>
      <a href="register.php">Register</a>
      <a href="https://www.facebook.com/infinitycryptichunt">Hints</a>
      <a href="rules.php">rules</a>
      <a href="lead.php">leaderboard</a>
      <a href="https://forms.gle/ArP2LVWQqo1WBweY6">contact</a>   
  </div>
	<br><br>
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

       // Leaderboard

       function showLead() {
            document.getElementById('expanded').style.height = '14em';
            document.getElementById('arrow').style.transform = 'rotate(-180deg)';
            // console.log('Display = yes');
            x=1;
       }

       function hideLead() {
            document.getElementById('expanded').style.height = '0';
            document.getElementById('arrow').style.transform = 'rotate(0deg)';
            // console.log('Display = no');
            x=0;
       }

        var x=0;

       function leaderboard() {
        if (x==0) {
            showLead();
        }
        else {
          hideLead();
        }
       }

  <?php 
for ($f=1; $f < 11; $f++) { 
  echo "function showLead{$f}() {
            document.getElementById('expanded{$f}').style.height = '15em';
            document.getElementById('arrow{$f}').style.transform = 'rotate(-180deg)';
            // console.log('Display = yes');
            x=1;
       }

       function hideLead{$f}() {
            document.getElementById('expanded{$f}').style.height = '0';
            document.getElementById('arrow{$f}').style.transform = 'rotate(0deg)';
            // console.log('Display = no');
            x=0;
       }

        var x=0;

       function leaderboard{$f}() {
        if (x==0) {
            showLead{$f}();
        }
        else {
          hideLead{$f}();
        }
       }";
}
   ?>

	</script>

</body>
</html>