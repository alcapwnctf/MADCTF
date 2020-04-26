<?php 
require_once('../scripts/admin_auth.php');
require_once('../scripts/player.php');
require_once('../scripts/stonks.php');
require_once("../scripts/dbconnect.php");

$username = $_SESSION['username'];
$player = getPlayer($dbhandle, $username);

if (isset($_POST['download_stmt'])) {
    $reqUser = getPlayer($dbhandle, $_POST['username']);
    if ($reqUser['username'] === $_GET['username']) {
      $serializedStonks = getSerializedPlayerStonks($dbhandle, $reqUser);
      header('Content-Disposition: attachment; filename="statement.biex"');
      header("Content-type: text/plain");
      print $serializedStonks;
      die();
    } else {
      $msg = "Invalid username.";
    }
  }

if (isset($_GET["username"])) {
    $reqUser = getPlayer($dbhandle, $_GET['username']);
    if ($reqUser['username'] === $_GET['username']) {
		$stonks = getStonkHistory($dbhandle, $reqUser);
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

		<div class="row">
			<div class='mx-auto w-100'>
				<table class="table">
					<thead>
						<tr>
						<th scope="col">#</th>
						<th scope="col">Ticker</th>
						<th scope="col">Shares</th>
						<th scope="col">Type</th>
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
        <input hidden name='username' value='<?php echo $reqUser['username']; ?>'>
                <button type='submit' name='download_stmt' class='btn btn-primary'>Download Statement</button>
            </form>
        </div>
    </div>
	</div>

</body>
</html>