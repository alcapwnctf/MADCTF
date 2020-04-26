<?php 
require_once('../scripts/admin_auth.php');
require_once('../scripts/player.php');
require_once("../scripts/dbconnect.php");

$username = $_SESSION['username'];
$player = getPlayer($dbhandle, $username);

if (isset($_GET["username"])) {
    $reqUser = getPlayer($dbhandle, $_GET['username']);
    if ($reqUser['username'] === $_GET['username']) {
		$queries = getPlayerQueries($dbhandle, $reqUser);
    } else {
        $msg = "User not found.";
    }
} else {
    $msg = "No Username";
}

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<title>Best Investor's Exchange</title>
	<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<a class="navbar-brand" href="#">Best Investor's Exchange</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarNav">
		<ul class="navbar-nav mr-auto">
		<li class="nav-item">
			<a class="nav-link" href="index.php">Home</a>
		</li>
		</ul>
		<span class="navbar-text">
		<?php echo "<a href='user.php'>" . $_SESSION['username']  . "</a> | " . $player['money'] . "$"; ?>
		</span>
	</div>
	</nav>

	<div class="container">
		<div class='row'>
			<div class='mx-auto'>
				<?php
					if (isset($msg)){
						echo "<p class='msg bg-warning p-3'>". $msg . "</p>";
					}
				?>
			</div>

		</div>

		<div class='row mt-3'>
				<div class='mx-auto w-50'>
				</div>
		</div>

		<div class='row mt-3'>
			<div class='col'>
				<h4>Queries for <?php echo $reqUser['username']; ?>, <br />Good Sire:</h4>
			</div>
			<div class='col'>
				<div class="card-columns">
            <?php 
                foreach($queries as $row) {
                echo '<div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">'. $row['type'] .'</h5>
                            <p class="card-text">'. $row['query'] . '</p>
                            <a href="read-statement.php?f='. $row['filename']. '" class="card-link">Read Statement</a>
                        </div>
                    </div>';
                }
			?>
				</div>
			</div>
		</div>
	</div>
</body>
</html>