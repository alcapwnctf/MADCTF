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
	<h1 class="heading">Rules</h1>
	<div class="rules">
	<ul class="all-rules">
		<li class="rule" style="font-weight: 300">The hunt starts on <b>13th April 2020 at 12:00:00 AM</b> and ends on <b>14th April 2020 at 11:59:59 PM</b>.</li>
		<li class="rule" style="font-weight: 300">There can be multiple answers to a single question!</li>
		<li class="rule" style="font-weight: 300">The answers can contain special characters and alphanumeric values. The website automatically removes spaces and capital letters from the answer. So if the answer is <b> decode2020 </b> and you enter <b> d E c O De 2 02 0 </b>, the answer will be accepted as <b>decode2020</b>. But we cannot autocorrect wrong spellings, so make sure you are putting in the right spelling.</li>
		<li class="rule" style="font-weight: 300">The recommended web browser for the hunt is Google Chrome.</li>
		<li class="rule" style="font-weight: 300">This hunt is made to test the knowledge and creativity skills of the participant. Most levels will require some amount of lateral thinking combined with some help from our good ol&#39; friend Google.</li>
		<li class="rule" style="font-weight: 300">If there are multiple images combined together in a level, you may need to crop and search for each image individually.</li>
		<li class="rule" style="font-weight: 300">Hints are scattered everywhere including the source code, image names, etc.</li>
		<li class="rule" style="font-weight: 300">Hints can be viewed in the source code by pressing Ctrl/Cmd + Shift + C or Right Click and Inspect.</li>
		<li class="rule" style="font-weight: 300">Ranks are the based upon the number of levels solved and the time at which you solved the previous level (lower time is better).</li>
		<li class="rule" style="font-weight: 300">You are not allowed to ask the answers from other players, if we find substantial proof we will disqualify you without giving any explanation.</li>
		<li class="rule" style="font-weight: 300">Players with offensive or any inappropriate username according to the admin will be disqualified immediately.</li>
		<li class="rule" style="font-weight: 300">We have no restrictions on the number of attempts, so do abuse this rule outrightly.</li>
		<li class="rule" style="font-weight: 300">As the difficulty levels increase, so does our reluctance to give out obvious clues. In case we find many players to be stuck at certain levels, a blatant push will be provided from our end. But the later levels of the game are made in such a way that players will have to spend some time wrapping their head around the clues, rather than expect the same to be solved in a matter of minutes.</li>
		<li class="rule" style="font-weight: 300">Do try your best, and be a little patient as far as hints are concerned.</li>
		<li class="rule" style="font-weight: 300">If you have any doubts or face any technical issues, please contact the admin.</li>
	</ul>
		<br><br><br>
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