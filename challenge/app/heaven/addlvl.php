<?php 
require_once('../scripts/admin_auth.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>DECODE 2020 | ONLINE LOCKDOWN HUNT</title>
  <link rel="stylesheet" type="text/css" href="admin.css">
  <script type="text/javascript" src="jquery.js"></script>
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

        if (isset($_GET['lid'])) {
    $lid = $_GET['lid'];  
  }

       $result4 = mysqli_query($dbhandle, "SELECT * FROM levels WHERE id='$lid'");
     while($row4 = mysqli_fetch_assoc($result4)) {
     $level = $row4['level'];
     $question = $row4['question'];
     $html = $row4['html'];
     $description = $row4['description'];
     $image = $row4['image'];
 }


     ?>
  </div>
  <h1 class="heading">Add Level</h1>
<form method="POST" action="add-action.php" enctype="multipart/form-data">
    <input type="number" name="level" placeholder="Level" value="<?php echo $newlevel; ?>" class="input" required><br>
  <input type="text" name="question" placeholder="Question" class="input"><br>
  <input type="text" name="answers[]" placeholder="Answer" class="input" required><div class="add-new" onclick="addNewBox()">+</div><br>
  <div id="more-fields"></div>
  <input type="file" name="image" class="input"><br>
  <input type="text" name="html" placeholder="HTML" class="input"><br>
  <input type="text" name="hint" placeholder="Source Hint" class="input"><br>
  <input type="text" name="description" placeholder="Description" class="input"><br><br>
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

       function addNewBox() {
        var div = document.getElementById('more-fields');

        var textbox = document.createElement('div');;
        textbox.innerHTML = '<input type=\"text\" name=\"answers[]\" placeholder=\"Answer\" class=\"input\" required><br>';

        div.appendChild(textbox);
       }

  </script>
</body>
</html>