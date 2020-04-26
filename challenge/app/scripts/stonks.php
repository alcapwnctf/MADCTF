<?php 
require_once('dbconnect.php');

class Stonk {
    public $ticker;
    public $value;

    function getStonkName($dbhandle) {
        return getStonk($dbhandle, $ticker)['name'];
    }
}

function getAllStonks($dbhandle) {
    $result = mysqli_query($dbhandle, "SELECT ticker, name, value FROM stonks");
    if ($result) {
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

function getStonk($dbhandle, $ticker) {
    $result = mysqli_query($dbhandle, "SELECT ticker, name, value FROM stonks WHERE ticker='$ticker'");
    if ($result) {
        return $result->fetch_assoc();
    }
}

function insertEvent($dbhandle, $player, $ticker, $value, $type) {
    $id = $player['id'];
    $result = mysqli_query($dbhandle, "INSERT INTO trade_events(player_id, ticker, type, value) VALUES('" . $id . "','" . $ticker . "','" . $type . "','" . $value . "')");
    if ($result) {
        return 1;
    }

    return 0;
}

function getPlayerStonks($dbhandle, $player) {
    $id = $player['id'];
    $portfolio = array();
    
    $result = mysqli_query($dbhandle, "SELECT player_id, ticker, value, type FROM trade_events WHERE player_id=" . $id . "");
    if ($result) {
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        foreach($rows as $row) {
            $ticker = $row['ticker'];
            $type = $row['type'];
            $value = $row['value'];
            if ($type === 'BUY') {
                if (isset($portfolio[$ticker])) {
                    $portfolio[$ticker] += $value;
                } else {
                    $portfolio[$ticker] = $value;
                }
            } elseif ($row['type'] === 'SELL') {
                if (isset($portfolio[$ticker])) {
                    $portfolio[$ticker] -= $value;
                } else {
                    $portfolio[$ticker] = -$value;
                }
            }
        }
        return $portfolio;
    }   
}

function getStonkHistory($dbhandle, $player) {
    $id = $player['id'];
    $portfolio = array();
    
    $result = mysqli_query($dbhandle, "SELECT ticker, value, type FROM trade_events WHERE player_id=" . $id . "");
    if ($result) {
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        return $rows;
    }   
}

function buyStonk($dbhandle, $player, $ticker, $value) {
    $stonk = getStonk($dbhandle, $ticker);
    $playerMoney = $player['money'];
    $value = floatval($value);
    $stonkVal = floatval($stonk['value']);


    if ($value < 1) {
        return "Invalid value.";
    }
    
    if ($player['money'] > $value*$stonkVal) {
        $val = insertEvent($dbhandle, $player, $stonk['ticker'], $value, "BUY");
        setPlayerMoney($dbhandle, $player);
        return "Bought stonk ". $value . " " . $ticker . " worth ". $stonkVal*$value . ".";
    }

    return "Insufficient funds '$playerMoney' to buy '$value' '$ticker' worth ". $stonkVal*$value . ".";
}

function sellStonk($dbhandle, $player, $ticker, $value) {
    $playerStonks = getPlayerStonks($dbhandle, $player);
    $value = floatval($value);

    if ($value < 1) {
        return "Invalid value.";
    }
    
    if (isset($playerStonks[$ticker])) {
        if ($playerStonks[$ticker] >= $value) {
            insertEvent($dbhandle, $player, $ticker, $value, "SELL");
            setPlayerMoney($dbhandle, $player, $ticker, $value);
            return "Sold " . $value . " " . $ticker . ".";
        }
    }

    return "You do not have the stock in your portfolio.";
}

function setPlayerMoney($dbhandle, $player) {
    $playerStonks = getPlayerStonks($dbhandle, $player);
    $playerMoney = 10000;
    
    foreach($playerStonks as $ticker => $value) {
        $stonk = getStonk($dbhandle, $ticker);
        $totalVal = floatval($stonk['value'])*floatval($value);
        $playerMoney -= $totalVal;
    }

    $query = "UPDATE players SET money=" . $playerMoney . " WHERE username='" . $player['username'] . "'";
    $result = mysqli_query($dbhandle, $query);
    if ($result) {
        return 1;
    }

    return 0;
}

function getStonksLike($dbhandle, $string) {
    $query = 'SELECT ticker, name, value FROM stonks WHERE name="' . $string . '" OR ticker="' . $string . '"';
    $result = mysqli_query($dbhandle, $query);
    if ($result) {
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

function getSerializedPlayerStonks($dbhandle, $player) {
    $stonks = array();
    $portfolio = getPlayerStonks($dbhandle, $player);

    foreach ($portfolio as $ticker => $value) {
        array_push($stonks, new Stonk($ticker, $value));
    }

    $serialized = serialize($stonks);   
    
    return base64_encode($serialized);
}

function unserializePlayerStonks($serialized) {
    $unserialized = unserialize(base64_decode($serialized));
    
    $portfolio = array();
    foreach ($unserialized as $stonk) {
        $portfolio[$stonk->ticker] = $stonk->value;
    }

    return $unserialized;
}

?>