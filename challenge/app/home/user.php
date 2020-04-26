<?php  
include("../scripts/player.php");
require_once("../scripts/dbconnect.php");
require_once("../scripts/stonks.php");
require_once('../scripts/auth.php'); 

if(!isset($_SESSION['username'])) {
	header("Location: ../index.php?msg=2");
}

$username = $_SESSION['username'];
$player = getPlayer($dbhandle, $username);
if (isset($_POST['download_stmt'])) {
	$serializedStonks = getSerializedPlayerStonks($dbhandle, $player);
	header('Content-Disposition: attachment; filename="statement.biex"');
	header("Content-type: text/plain");
	print $serializedStonks;
	die();
}

if (isset($_POST['upload_stmt'])) {
	$uploadData = file_get_contents($_FILES['file']['tmp_name']); 
	$stonks = unserializePlayerStonks($uploadData);
} else {
	$stonks = getPlayerStonks($dbhandle, $player);
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
			<a class="nav-link" href="dashboard.php">Home</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="stonks.php">Stonks</a>
		</li>
		<li class="nav-item">
			<a class="nav-link active" href="orders.php">Stonk Order</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="broker.php">Talk To stonkbronker?</a>
		<li class="nav-item">
			<a class="nav-link" href="https://www.reddit.com/r/wallstreetbets">Gambler's Den</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="https://brrr.money/">Haha money go brrr</a>
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
						<th scope="col">Ticker</th>
						<th scope="col">Name</th>
						<th scope="col">Shares</th>
						<th scope="col">Value</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$counter = 1;
							foreach($stonks as $key => $value) {
                                $stonk = getStonk($dbhandle, $key);
								echo "<tr>
								<td scope='row'>" . $counter . "</td>";
                                echo "<td>" . $key . "</td>";
                                echo "<td>" . $stonk['name'] . "</td><td>" . $value . "</td>";
                                echo "<td>" . $value*floatval($stonk['value']) . "</td>";
								echo "</tr>";
								$counter += 1;
							}
						?>
					</tbody>
				</table>
			</div>
		</div>

		<div class='row'>
			<div class='col'>
				<form method='POST'>
					<button type='submit' name='download_stmt' class='btn btn-primary'>Download Statement</button>
				</form>
			</div>
			<div class='col'>
				<form method='POST' enctype="multipart/form-data">
					<div class='form-group'>
						<input type='file' class='form-control-file' name='file'>
					</div>
					<button type='submit' name='upload_stmt' class='btn btn-primary'>Upload Statement</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>