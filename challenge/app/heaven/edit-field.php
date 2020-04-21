<?php 
// require_once('../scripts/dbconnect.php');
require_once('../scripts/admin_auth.php');

  if (isset($_GET['lid'])) {
    $lid = $_GET['lid'];  
  }


  if (isset($_GET['f'])) {
    $f = $_GET['f'];  
  }

// require_once('../scripts/dbconnect.php');

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


$result = mysqli_query($dbhandle, "SELECT * FROM levels WHERE id='$lid'");
     while ($row = mysqli_fetch_assoc($result)) {

      $fval = $row[$f];

      // echo $fval;

    }



 ?>
  </div>
  <h1 class="heading">Edit <?php echo ucwords($f); ?></h1>
<form method="POST" action="ed-action.php?lid=<?php echo $lid; ?>&f=<?php echo $f; ?>" enctype="multipart/form-data">
    <?php 

    $phold = ucwords($f);

      if ($f=="image") {
        if (empty($fval)) {
          echo "<input type='file' name='{$f}' class='input'><br>";
        }
        else {
          echo "<img src='../home/imgques/{$fval}' style='width:200px;height:200px;'><br>";
          echo "<ul class='input-list'><li><div class='pure-checkbox'><input id='checkbox1' name='removeimg' type='checkbox'><label for='checkbox1'>Remove Image</label></div></li></ul><br>";
        }
      }
      else {
        echo "<input type='text' name='{$f}' placeholder='{$phold}' value='{$fval}' class='input'><br>";
      }

     ?>
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

  </script>
</body>
</html>