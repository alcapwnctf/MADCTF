<?php
require_once('../scripts/admin_auth.php');
require_once('../scripts/player.php');
require_once("../scripts/dbconnect.php");

$statementDir = "../home/talking/";
if (isset($_GET['f'])) {
    $location = $statementDir . $_GET['f'];
    $contents = file_get_contents($location);

    echo $contents;
}

?>