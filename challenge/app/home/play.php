<?php  
require_once('../scripts/auth.php'); 
session_start();

if(isset($_SESSION['username'])) {
echo "<!DOCTYPE html>
<html>
<head>
	<title>DECODE 2020 | ONLINE LOCKDOWN HUNT</title>
	<link rel='stylesheet' type='text/css' href='style.css'>
	<link rel='stylesheet' type='text/css' href='popup.css'>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
	<meta name='viewport' content='width=device-width, initial-scale=1,user-scalable=no'>
</head>
<body>
	<div class='container'>
		<div class='ham' onclick='fadeIn()'>
			<div class='hamlines' id='hamlines'></div>
			<div class='hamlines' id='hamlines2'></div>
			<div class='hamlines' id='hamlines3'></div>
		</div>

		<div class='side' id='side'>
			<img src='logo.png' class='im'>
			<hr>

			<div class='option'>
			<center>
			<br><br>
				<a href='play.php'><div class='be'>play</div></a>
				<a href='rules.php'><div class='be'>rules</div></a>
				<a href='https://www.facebook.com/infinitycryptichunt'><div class='be'>hints</div></a>
				<a href='lead.php'><div class='be'>leaderboard</div></a>
				<a href='https://forms.gle/ArP2LVWQqo1WBweY6'><div class='be'>contact</div></a>
				<a href='logout.php'><div class='be'>logout</div></a>
			</center>
			</div>
		</div>

		<div class='mc'>

	<!-- Question -->
			<div class='main'>
				<div class='level'>
				</div>

				<div class='qs' id='qs'>
					<div id='question'></div>
					<div id='image'></div>
					<div id='html'></div>
					<div id='hint'></div>
				</div>
				<form method='post' action='javascript:subAns()'>
				<div class='sb'>
				
					<input class='submit' placeholder='Answer' id='ans' name='answer' autocomplete='off' required></input>

					<button type='submit' class='enter' name='submit'><img src='submit.png' alt='SUBMIT'></button>
				
				</div>
				</form>
			</div>

		</div>

		<!-- Overlay -->

		<div class='main2' id='main2' onclick='fadeOut()'>

		</div>
	</div>
	<center>
<!--	<div class='panel'>
	<br>
	<div id='res'></div>
	</div> -->
<!-- <div class='wrong'><p>Wrong Answer</p></div>
<div class='right'><p>Correct Answer</p></div> -->
	</center>

<!-- CSS Settings -->
 <div style='padding-bottom: 100px; position: absolute; top: 100%; left: 50%;'><p style='visibility: hidden;'>....</p></div>
<script type='text/javascript' src='script.js'></script>
<script type='text/javascript' src='animations.js'></script>
</body>
</html>";
}
else {
header("Location: ../index.php?msg=2");
}

?>

