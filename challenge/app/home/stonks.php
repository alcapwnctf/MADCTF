<?php  
include("../scripts/player.php");
require_once("../scripts/dbconnect.php");
require_once("../scripts/stonks.php");
require_once('../scripts/auth.php'); 
session_start();

if(!isset($_SESSION['username'])) {
	header("Location: ../index.php?msg=2");
}

$username = $_SESSION['username'];
$player = getPlayer($dbhandle, $username);

if(isset($_POST['submit'])) {
	$stonks = getStonksLike($dbhandle, $_POST['q']);
} else {
	$stonks = getAllStonks($dbhandle);
}

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<title>Best Investor's Exchange</title>
	<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
	<script>
	async function tradeStonks(ticker, type) {
		const value = document.querySelector("#stonkValue-"+ticker).value
		let formData = new FormData()
		formData.append("submit", true)
		formData.append("ticker", ticker)
		formData.append("value", value)
		formData.append("type", type)
		
		const response = await fetch('trade.php', {
			method: 'POST',
			body: formData
		})
		const result = await response.text()
		console.log(result)
		document.querySelector("#stonkResult").innerText = result;
	}

	</script>
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
			<a class="nav-link active" href="stonks.php">Stonks</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="orders.php">Stonk Order</a>
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
				<h3>You wanna sell some stonk?</h3>
			</div>
		</div>
		<div class="row">
			<div class="mx-auto">
				<h6 id='stonkResult'></h6>
			</div>
		</div>

		<div class='row'>
			<div class="mx-w-100">
				<form method="POST" action="stonks.php">
					<div class="input-group mb-3">
						<input type="text" class="form-control" name="q" placeholder="Search stonk.." aria-label="Stonk Search" aria-describedby="basic-addon2">
						<div class="input-group-append">
							<button type="submit" name="submit" class="btn btn-outline-secondary" type="button">Search</button>
						</div>
					</div>
				</form>
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
						<th scope="col">Price</th>
						<th scope="col">Shares</th>
						<th scope="col">Buy</th>
						<th scope="col">Sell</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$counter = 1;

							foreach($stonks as $stonk) {
								echo "<tr>
								<td scope='row'>" . $counter . "</td>";
								foreach($stonk as $key => $value) {
									echo "<td>" . $value . "</td>";
								}
								echo "<td><input type='number' class='form-control' id='stonkValue-" . $stonk['ticker'] . "' value=0 /></td>";
								echo "<td><button class='btn btn-primary' onclick=\"tradeStonks('" . $stonk['ticker'] . "', 'buy')\" >Buy</button></td>";
								echo "<td><button class='btn btn-danger' onclick=\"tradeStonks('" . $stonk['ticker'] . "', 'sell')\" >Sell</button></td>";
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