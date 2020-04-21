<?php require_once('scripts/dbconnect.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>DECODE 2020 | ONLINE LOCKDOWN HUNT</title>
	<link rel="stylesheet" type="text/css" href="index.css">
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<script type="text/javascript">

 function onSubmit(token) {
       	  document.getElementById("login-form").submit();
  }

	</script>
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
	<div class="message">
		<?php 
 			$msgid = $_GET['msg'];
 			if (isset($msgid)){
 				if ($msgid == 1) {
 					echo "<p class='msg'>Invalid Username or Password!</p>";
 				}
 				if ($msgid == 2) {
 					echo "<p class='msg'>Please login to play!</p>";
 				}
 				elseif ($msgid == 3) {
 					echo "<p class='msg'>Only admins allowed!</p>";
 				}

 			}
 			else {
 				// echo "";
 			}

		 ?>
	</div>
	<div class="loginf" <?php if (isset($msgid)) {
		if ($msgid==1 || $msgid==2 || $msgid==3) {
		echo "style='margin-top:6%;'";
		}
		else {
		echo "style='margin-top:10%;'";
		}
	} 
	else {
		echo "style='margin-top:10%;'";
	}	?>>
	<h1>Login</h1>
	<form id="login-form" method="post" action="scripts/login.php">
	<br><br>
		<input type="text" id="username" name="username" placeholder="Admission Number" required><br><br>
        <input type="password" id="password" name="password" placeholder="Password" required><br><br>
        <!-- <button class="g-recaptcha" data-sitekey="6LcToiIUAAAAAAZKXTWeDr427822J3w0B5BgfGbS" data-callback="onSubmit">SUBMIT</button> -->
        <br><br>
	</form>
	</div>

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