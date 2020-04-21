<?php 
// require_once('../scripts/dbconnect.php');
require_once('../scripts/admin_auth.php');

  if (isset($_GET['lid'])) {
    $lid = $_GET['lid'];  
  }
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
          echo "<p class='msg'>Error!</p>";
        }

        elseif ($msgid == 2) {
          echo "<p class='msg-right'>Disqulified!</p>";
        }

        elseif ($msgid == 3) {
          echo "<p class='msg-right'>Hidden!</p>";
        }

      }
      else {
        // echo "";
      }

 ?>
  </div>
  <h1 class="heading">Change All Answers</h1>
<form method="POST" action="changeans-func.php">
  <input type="text" name="newanswers[]" placeholder="Answer" class="input" required><div class="add-new" style="top: 26%;" onclick="addNewBox()">+</div><br>
  <div id="more-fields"></div>
  <input type='hidden' name='levelid' value="<?php echo $lid; ?>" class='input'>
  <input type="submit" class="subBtn" name="submit" value="SUBMIT"><br>
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

       function addNewBox() {
        var div = document.getElementById('more-fields');

        var textbox = document.createElement('div');;
        textbox.innerHTML = '<input type=\"text\" name=\"newanswers[]\" placeholder=\"Answer\" class=\"input\" required><br>';

        div.appendChild(textbox);
       }

  </script>
</body>
</html>