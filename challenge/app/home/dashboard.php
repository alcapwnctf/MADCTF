<?php  
require_once("../scripts/player.php");
require_once('../scripts/auth.php'); 
session_start();

if(!isset($_SESSION['username'])) {
	header("Location: ../index.php?msg=2");
}

$player = getPlayer($dbhandle, $_SESSION['username']);
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
			<a class="nav-link active" href="dashboard.php">Home</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="stonks.php">Stonks</a>
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
			<div class="mx-auto" id="chart">
				<h1>BIEX provides the fairest stonk and honk.</h1>
			</div>
		</div>
	</div>

	<div class='m-10'>
		<!-- TradingView Widget BEGIN -->
		<div class="tradingview-widget-container">
		<div id="tradingview_0e4f5"></div>
		<div class="tradingview-widget-copyright"><a href="https://in.tradingview.com/symbols/NASDAQ-AAPL/" rel="noopener" target="_blank"><span class="blue-text">AAPL Chart</span></a> by TradingView</div>
		<script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
		<script type="text/javascript">
		new TradingView.widget(
		{
		"width": 980,
		"height": 610,
		"symbol": "NASDAQ:AAPL",
		"interval": "D",
		"timezone": "Etc/UTC",
		"theme": "light",
		"style": "1",
		"locale": "in",
		"toolbar_bg": "#f1f3f6",
		"enable_publishing": false,
		"allow_symbol_change": true,
		"container_id": "tradingview_0e4f5"
		}
		);
		</script>
		</div>
		<!-- TradingView Widget END -->
	</div>
</body>
</html>