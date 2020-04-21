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
  <div class="message">
    <?php 
      $msgid = $_GET['msg'];
      if (isset($msgid)){
        if ($msgid == 1) {
          echo "<p class='msg-right'>Deleted All Levels!</p>";
        }

        elseif ($msgid == 2) {
          echo "<p class='msg-right'>Cleared Submit Logs!</p>";
        }

        elseif ($msgid == 3) {
          echo "<p class='msg-right'>Cleared Login Logs!</p>";
        }

        elseif ($msgid == 4) {
          echo "<p class='msg-right'>Deleted All Players!</p>";
        }

      }
      else {
        // echo "";
      }

     ?>
  </div>
	<h1 class="heading">Settings</h1>
  <div class="admin-links">
	 
   <a href="delalllvls.php" onclick="return confirm('Are You Sure?')">Delete All Levels</a>
   <a href="clearsubmits.php" onclick="return confirm('Are You Sure?')">Clear Submit Logs</a>
   <a href="clearlogin.php" onclick="return confirm('Are You Sure?')">Clear Login Logs</a>
   <a href="delallplayers.php" onclick="return confirm('Are You Sure?')">Delete All Players</a>

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