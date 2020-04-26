<?php
    require_once('../scripts/dbconnect.php');
    require_once('../scripts/stonks.php');
    require_once('../scripts/player.php');
    require_once('../scripts/auth.php'); 

    session_start();
    $username = $_SESSION['username'];
    $player = getPlayer($dbhandle, $username);

    if (isset($_POST['submit'])) {    
      $ticker = $_POST['ticker'];
      $type = $_POST['type'];
      $value = $_POST['value'];
      if ($type === 'buy') {
        $res = buyStonk($dbhandle, $player, $ticker, $value);   
      } elseif ($type === 'sell') {
        $res = sellStonk($dbhandle, $player, $ticker, $value);   
      }
      echo $res;

    } else {
      echo "Invalid input.";
    }


?>