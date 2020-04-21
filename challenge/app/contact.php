<!DOCTYPE html>
<html>
<head>
	<title>DECODE 2020 | ONLINE LOCKDOWN HUNT</title>
	<link rel="stylesheet" type="text/css" href="index.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
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
	<h1 class="heading">Contact Us</h1>
	<p class="sub-text">Feel free to contact us only for a technical issue.</p>
	<!-- <div class="contact-links">
	<a href="mailto:xquest2017@gmail.com">xquest2017@gmail.com</a><br>
	<a href="https://www.facebook.com/XINO.DPSR/">https://www.facebook.com/XINO.DPSR/</a>
	</div>
	<div class="social">
      <div class="soc" id="soc1" onclick="A()"><i class="fa fa-facebook" aria-hidden="true"></i></div>
      <div class="soc" id="soc3" onclick="C()"><i class="fa fa-envelope" aria-hidden="true"></i></div>
    </div> -->
	<iframe src="https://forms.gle/ArP2LVWQqo1WBweY6" style="width: 80%; height: 1000px">
            <p>Your browser does not support iframes.</p>
    </iframe>
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

       	function A() {
  			window.open('https://www.facebook.com/XINO.DPSR/','_self');
		}

		function C() {
  			window.open('mailto:xquest2017@gmail.com','_self');
		}

	</script>
</body>
</html>