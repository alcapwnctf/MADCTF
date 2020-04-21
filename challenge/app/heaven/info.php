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
  <h1 class="heading">Player Info</h1>
  <table class="common-table" border="1" cellpadding="20" cellspacing="0">
    
  <?php 
  if (isset($_GET['uid'])) {
    $uid = $_GET['uid'];  
  }

  $result = mysqli_query($dbhandle, "SELECT * FROM players WHERE uid='$uid'");
while ($row = mysqli_fetch_assoc($result)) {
      $name = $row['name'];
      $username = $row['username'];
      $level = $row['level'];
      $status = $row['status'];
      $email = $row['email'];
      if ($status == 1) {
        $status = "Playing";
      }
      elseif ($status == 0) {
        $status = "Hidden";
      }
      elseif ($status == 2) {
        $status = "Disqualified";
      }
      else {
        $status = "Unknown";
      }
      echo "<tr>
            <th>Name</th>
            <td>{$name}</td>
            </tr>
            <th>Admission Number</th>
            <td>{$username}</td>
            </tr>
            <th>Email</th>
            <td>{$email}</td>
            </tr>
            <th>Level</th>
            <td>{$level}</td>
            </tr>
            <th>Status</th>
            <td>{$status}</td>
            </tr>";
}
  

   ?>

  </table>  
  <h1 class="heading">Login Logs</h1>

  <table class="common-table" border="1" cellpadding="20" cellspacing="0">
  <tr>
    <th>S. No.</th>
    <th>Status</th>
    <th>IP</th>
    <th>Time</th>
  </tr>
<?php 
$sno = 1;
$result = mysqli_query($dbhandle, "SELECT * FROM login WHERE username='$username'");
while ($row = mysqli_fetch_assoc($result)) {
      $status1 = $row['status'];
      $ip = $row['ip'];
      $time = $row['time'];

      echo "<tr>
            <td>{$sno}</td>
            <td>{$status1}</td>
            <td>{$ip}</td>
            <td>{$time}</td>
            ";
$sno++;
}  
?>

</table>

<h1 class="heading">Submits</h1>

  <table class="common-table" border="1" cellpadding="20" cellspacing="0" style="width: 90%;">
  <tr>
    <th>S. No.</th>
    <th>Answer</th>
    <th>Level</th>
    <th>Status</th>
    <th>IP</th>
    <th>Time</th>
  </tr>
<?php 
$sno1 = 1;
$result = mysqli_query($dbhandle, "SELECT * FROM submits WHERE username='$username'");
while ($row = mysqli_fetch_assoc($result)) {
      $ans = $row['answer'];
      $lvl = $row['level'];
      $status2 = $row['status'];
      $ip1 = $row['ip'];
      $time1 = $row['time'];

      echo "<tr>
            <td>{$sno1}</td>
            <td>{$ans}</td>
            <td>{$lvl}</td>
            <td>{$status2}</td>
            <td>{$ip1}</td>
            <td>{$time1}</td>
            ";

            $sno1++;

}  
?>

</table>

  <div onclick="fadeOut()" class="overlay" id="overlay"></div>
<br><br><br><br>
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