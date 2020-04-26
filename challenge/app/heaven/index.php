<?php 
require_once('../scripts/admin_auth.php');
require_once('../scripts/player.php');
require_once('../scripts/stonks.php');
require_once("../scripts/dbconnect.php");

$username = $_SESSION['username'];
$player = getPlayer($dbhandle, $username);

$players = getPlayers($dbhandle);

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
		<div class="row">
			<div class="mx-auto">
				<h3>You wanna see your stonk?</h3>
			</div>
		</div>
		<div class="row">
			<div class="mx-auto">
				<h6 id='stonkResult'></h6>
			</div>
		</div>

		<div class="row">
			<div class='mx-auto w-100'>
				<table class="table">
					<thead>
						<tr>
						<th scope="col">#</th>
						<th scope="col">Name</th>
						<th scope="col">Username</th>
						<th scope="col">Email</th>
						<th scope="col">Money</th>
						<th scope="col">Type</th>
						<th scope="col">IP</th>
            <th scope="col">Queries</th>
            <th scope="col">Trades</th>
            <th scope="col">Info</th>
						</tr>
					</thead>
					<tbody>
						<?php 
              $counter = 1;
							foreach($players as $player) {
								echo "<tr>
                <td scope='row'>" . $counter . "</td>";
                foreach($player as $key => $value) {
									echo "<td>" . $value . "</td>";
                }
                echo "<td><a href='queries.php?username=".$player['username']."'><button class='btn btn-primary'>Queries</button></a></td>";
                echo "<td><a href='trades.php?username=".$player['username']."'><button class='btn btn-warning'>Trades</button></a></td>";
                echo "<td><a href='info.php?username=".$player['username']."'><button class='btn btn-info'>Info</button></a></td>";
								echo "</tr>";
								$counter += 1;
							}
						?>
					</tbody>
				</table>
			</div>
		</div>

	</div>
</body>
</html>