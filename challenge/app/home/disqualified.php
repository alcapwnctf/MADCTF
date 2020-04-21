<?php 
require_once('../scripts/dbconnect.php');
session_start();
if (!isset($_SESSION['username'])) {
	header("Location: ../index.php");
}

// Disqualification Check

$result = mysqli_query($dbhandle, "SELECT * FROM players WHERE username='".$_SESSION['username']."'");
while ($row = mysqli_fetch_assoc($result)) {
      $status = $row['status'];
}

if ($status == 1) {
	header("Location: play.php");
}
 ?>
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
<!-- 				<div class="level">
					Level 0
				</div>

				<div class="qs">
					Where are you?
				</div>
				<form method="post" action="#">
				<div class="sb">
				
					<input class="submit" placeholder="Answer" required></input>

					<input class="enter" src="submit.png" type="image" name="submit">
				
				</div>
				</form> -->
				<center>
	<h1 class="heading">You have been disqualified!</h1>
	<p class="sub-text">If you think this was a mistake then contact the admin on the following mediums!</p>
	<div class="contact-links">
	<a href="https://www.facebook.com/infinitycryptichunt">https://www.facebook.com/infinitycryptichunt</a>
	</div>
	<div class="social">
      <div class="soc" id="soc1" onclick="A()"><i class="fa fa-facebook" aria-hidden="true"></i></div>
      <div class="soc" id="soc3" onclick="C()"><i class="fa fa-envelope" aria-hidden="true"></i></div>
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