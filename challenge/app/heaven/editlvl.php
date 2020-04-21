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
          echo "<p class='msg'>Error!</p>";
        }

        elseif ($msgid == 4) {
          echo "<p class='msg-right'>Answers Edited!</p>";
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
  <h1 class="heading">Edit Level</h1>

  <table class="common-table" border="1" cellpadding="20" cellspacing="0">
    
  <?php 
       $result4 = mysqli_query($dbhandle, "SELECT * FROM levels WHERE id='$lid' ORDER BY level asc");
     while($row4 = mysqli_fetch_assoc($result4)) {
     $level = $row4['level'];
     $question = $row4['question'];
     $html = $row4['html'];
     $description = $row4['description'];
     $image = $row4['image'];

      echo "<tr>
            <th>Level</th>
            <td>{$level}</td>
            <td><a href='edit-field.php?lid={$lid}&f=level'>Edit</a></td>
            </tr>
            <tr>
            <th>Question</th>
            <td>{$question}</td>
            <td><a href='edit-field.php?lid={$lid}&f=question'>Edit</a></td>
            </tr>
            <tr>
            <th>Answer</th>
            <td>[encrypted]</td>
            <td><a href='add-ans.php?lid={$lid}'>Add Answer</a> / <a href='change-answer.php?lid={$lid}'>Change All Answers</a></td>
            </tr>
            <tr>
            <th>Image</th>";
            if (!empty($image)) {
              echo "<td><a href='../home/imgques/{$image}'>View Image</a></td>";
            }
            else {
              echo "<td></td>";
            }
       echo "<td><a href='edit-field.php?lid={$lid}&f=image'>Edit</a></td>
            </tr>
            <tr>
            <th>HTML</th>
            <td>{$html}</td>
            <td><a href='edit-field.php?lid={$lid}&f=html'>Edit</a></td>
            </tr>
            <tr>
            <th>Description</th>
            <td>{$description}</td>
            <td><a href='edit-field.php?lid={$lid}&f=description'>Edit</a></td>
            </tr>";
}
  

   ?>

  </table>  



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