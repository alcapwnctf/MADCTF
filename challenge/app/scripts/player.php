<?php 

function getPlayer($dbhandle, $username) {
    $result = mysqli_query($dbhandle, "SELECT * FROM players WHERE username='$username'");
    return $result->fetch_assoc();
}
    
function getPlayers($dbhandle) {
    $result = mysqli_query($dbhandle, "SELECT name, username, email, money, usertype, ip FROM players");
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getMoney($dbhandle, $username) {
    $result = mysqli_query($dbhandle, "SELECT money FROM players WHERE username='$username'");
    return $result->fetch_assoc();
}

function getPlayerQueries($dbhandle, $player) {
    $result = mysqli_query($dbhandle, "SELECT query, type, filename FROM talking WHERE username='".$player['username']."'");
    return $result->fetch_all(MYSQLI_ASSOC);
}


?>