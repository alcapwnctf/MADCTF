<?php  
require_once('../scripts/dbconnect.php');
require_once('../scripts/auth.php'); 
session_start();

if(!isset($_SESSION['username'])) {
	header("Location: ../index.php?msg=2");
}

if (isset($_POST['submit'])) {
    $uploaddir = './talking/';
    $uploadfile = $uploaddir . basename($_FILES['file']['name']);

	$uploaded = 0;
    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
		$uploaded = 1;
    } else {
		$msg = "Sorry, talkin to stonk bronker failed!";
    }
	
	if ($uploaded === 1) {
		$filename = basename($_FILES['file']['name']);
		$query = mysqli_real_escape_string($dbhandle, $_POST['query']);
		$type = mysqli_real_escape_string($dbhandle, $_POST['query']);
		$username = $_SESSION['username'];
	
		$query = "INSERT INTO talking(username, query, type, filename) VALUES('$username','$query','$type','$filename')";
		$result = mysqli_query($dbhandle, $query);
		if ($result) {
			$msg = "Thanks, your bronker has received your query."; 
		} else {
			$msg = "Sorry, talking to stonk bronker failed";
		}
	}
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
		<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link" href="dashboard.php">Home</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="stonks.php">Stonks</a>
		</li>
		
		<li class="nav-item">
			<a class="nav-link" href="orders.php">Stonk Order</a>
		</li>
		<li class="nav-item">
			<a class="nav-link active" href="broker.php">Talk To stonkbronker?</a>
		<li class="nav-item">
			<a class="nav-link" href="https://www.reddit.com/r/wallstreetbets">Gambler's Den</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="https://brrr.money/">Haha money go brrr</a>
		</li>
		</ul>
	</div>
	</nav>

	<div class="container">
		<div class="row">
		
			<div class="mx-auto p-3 text-center text-light bg-dark">
			    <h3>Is the VIX making you take RIX?</h3> <h3>Say no to liquidate, Just talk to your (our) best ethical bronker!</h3>
			</div>
		</div>

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
					<form method="POST" action="broker.php" enctype="multipart/form-data">
						<div class="form-group">
							<label for="type">Query Type</label>
							<input class="form-control" type="text" name="type" placeholder="What kind of query, sire?" class="input">
						</div>
						<div class="form-group">
							<label for="query">Query</label>
							<textarea class="form-control" rows='10' name="query" placeholder="Query, sire?" class="input" required></textarea>
						</div>
						<div class="form-group">
							<label for="file">Upload Financial Statment</label>
							<input class="form-control-file" type="file" name="file">
						</div>
						<button type="submit" class="btn btn-primary" name="submit">Submit</button>
					</form>
				</div>
		</div>

		<div class='row mt-3'>
			<div class='col'>
				<h4>Your Queries, <br />Good Sire:</h4>
			</div>
			<div class='col'>
				<div class="card-columns">
			<?php 
			$talking_query = mysqli_query($dbhandle, "SELECT query, type, filename FROM talking WHERE username='".$_SESSION['username']."'");
				if ($talking_query) {
					while($row = mysqli_fetch_assoc($talking_query)) {
					echo '<div class="card" style="width: 18rem;">
							<div class="card-body">
								<h5 class="card-title">'. $row['type'] .'</h5>
								<p class="card-text">'. $row['query'] . '</p>
								<a href="talking/'. $row['filename']. '" class="card-link">Download Statement</a>
							</div>
						</div>';
					}
				}
			?>
				</div>
			</div>
		</div>
	</div>
</body>
</html>