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
  <div class="message">
    <?php 
      $msgid = $_GET['msg'];
      if (isset($msgid)){
        if ($msgid == 1) {
          echo "<p class='msg-right'>Account Created Successfully!</p>";
        }

        elseif ($msgid == 2) {
          echo "<p class='msg'>Error!</p>";
        }

      }
      else {
        // echo "";
      }

     ?>
  </div>
  <h1 class="heading">Register</h1>
<form method="POST" action="scripts/register-action.php">
  <input type="text" name="name" placeholder="Name" class="input" required><br><br>
  <input type="email" name="email" placeholder="Email" class="input" required><br><br>
  <input type="text" name="username" placeholder="Admission Number" class="input" required><br><br>
  <input type="password" name="password" placeholder="Password" class="input" required><br><br>
  <input type="submit" class="subBtn" name="submit" value="SUBMIT">
</form>



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