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
  <h1 class="heading">Players</h1>
  
  <table id="hor-zebra" style="width:50%">
    <thead>
      <tr>
          <th scope="col">Rank</th>
            <th scope="col">Admission Number</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Level</th>
            <th scope="col">Attempts</th>
            <th scope="col">Info</th>
            <th scope="col">Disqulify</th>
            <th scope="col">Hide</th>
        </tr>
    </thead>
    <tbody>
        <?php
    $rank = 1;
    $completed = 27; //Set 1 + Last Level
     $result = mysqli_query($dbhandle, "SELECT * FROM players WHERE status=1 AND usertype=1 ORDER by level DESC,time");
     while ($row = mysqli_fetch_assoc($result)) {
      $name = ucwords($row['name']);
      $player = $row['username'];
      $email = $row['email'];
      $uid = $row['uid'];
      $level = $row['level'];
      if ($level == $completed) {
        $level = "Completed!";
      }
      $school = $row['school'];
  $ctr=0;
$result2 = mysqli_query($dbhandle, "SELECT * FROM submits WHERE username='{$player}'");
     while ($row = mysqli_fetch_assoc($result2)) {
       $ctr++;

     }

      echo "<tr>
            <td>{$rank}</td>
            <td>{$player}</td>
            <td>{$name}</td>
            <td>{$email}</td>
            <td>{$level}</td>
            <td>{$ctr}</td>
            <td><a href='info.php?uid={$uid}'>Info</td>
            <td><a href='disqualify.php?uid={$uid}' onclick='return confirm(\"Are you sure?\")'>Disqulify</td>
            <td><a href='hide.php?uid={$uid}' onclick='return confirm(\"Are you sure?\")'>Hide</td>
            </tr>";
     $rank++;
     }
     ?>       
    </tbody>
</table>

  <h1 class="heading">Disqualified Players</h1>
  
  <table id="hor-zebra" style="width:50%">
    <thead>
      <tr>
          <th scope="col">Rank</th>
            <th scope="col">Admission Number</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Level</th>
            <th scope="col">Attempts</th>
            <th scope="col">Info</th>
            <th scope="col">Qualify</th>
        </tr>
    </thead>
    <tbody>
        <?php
    $rank = 1;
    $completed = 27; //Set 1 + Last Level
     $result = mysqli_query($dbhandle, "SELECT * FROM players WHERE status=2 AND usertype=1 ORDER by level DESC,time");
     while ($row = mysqli_fetch_assoc($result)) {
      $name = ucwords($row['name']);
      $player = $row['username'];
      $email = $row['email'];
      $uid = $row['uid'];
      $level = $row['level'];
      if ($level == $completed) {
        $level = "Completed!";
      }
      $school = $row['school'];
  $ctr=0;
$result2 = mysqli_query($dbhandle, "SELECT * FROM submits WHERE username='{$player}'");
     while ($row = mysqli_fetch_assoc($result2)) {
       $ctr++;

     }

      echo "<tr>
            <td>{$rank}</td>
            <td>{$player}</td>
            <td>{$name}</td>
            <td>{$email}</td>
            <td>{$level}</td>
            <td>{$ctr}</td>
            <td><a href='info.php?uid={$uid}'>Info</td>
            <td><a href='qualify.php?uid={$uid}' onclick='return confirm(\"Are you sure?\")'>Qualify</td>
            </tr>";
     $rank++;
     }
     ?>       
    </tbody>
</table>



  <h1 class="heading">Hidden Players</h1>
  
  <table id="hor-zebra" style="width:50%">
    <thead>
      <tr>
          <th scope="col">Rank</th>
            <th scope="col">Admission Number</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Level</th>
            <th scope="col">Attempts</th>
            <th scope="col">Info</th>
            <th scope="col">Show</th>
        </tr>
    </thead>
    <tbody>
        <?php
    $rank = 1;
    $completed = 27; //Set 1 + Last Level
     $result = mysqli_query($dbhandle, "SELECT * FROM players WHERE status=0 AND usertype=1 ORDER by level DESC,time");
     while ($row = mysqli_fetch_assoc($result)) {
      $name = ucwords($row['name']);
      $player = $row['username'];
      $email = $row['email'];
      $uid = $row['uid'];
      $level = $row['level'];
      if ($level == $completed) {
        $level = "Completed!";
      }
      $school = $row['school'];
  $ctr=0;
$result2 = mysqli_query($dbhandle, "SELECT * FROM submits WHERE username='{$player}'");
     while ($row = mysqli_fetch_assoc($result2)) {
       $ctr++;

     }

      echo "<tr>
            <td>{$rank}</td>
            <td>{$player}</td>
            <td>{$name}</td>
            <td>{$email}</td>
            <td>{$level}</td>
            <td>{$ctr}</td>
            <td><a href='info.php?uid={$uid}'>Info</td>
            <td><a href='qualify.php?uid={$uid}' onclick='return confirm(\"Are you sure?\")'>Show</td>
            </tr>";
     $rank++;
     }
     ?>       
    </tbody>
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