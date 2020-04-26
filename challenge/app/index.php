<?php require_once('scripts/dbconnect.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<title>Best Investor's Exchange</title>
	<!-- <link rel="stylesheet" type="text/css" href="index.css"> -->
	<style>
		input {
		-webkit-appearance: none;
		border-radius: 0;
	}

	button {
		-webkit-appearance: none;
		border-radius: 0;
	}

	input[type="text"], input[type="email"] {
		border: none;
		border-bottom: 2px solid rgba(136,136,136,0.6);
		width: 300px;
		outline: none;
		font-size: 18px;
		background: none;
		padding: 15px;
		padding-left: 0;
		font-weight: 300;
		transition: all .4s ease;
	}

	input[type="text"]:focus,input[type="password"]:focus, input[type="email"]:focus {
		border-bottom: 2px solid rgba(136,136,136,1);
		transition: all .4s ease;
	}

	input[type="password"] {
		border: none;
		border-bottom: 2px solid rgba(136,136,136,0.6);
		width: 300px;
		background: none;
		outline: none;
		font-size: 18px;
		padding: 15px;
		padding-left: 0;
		font-weight: 300;
		transition: all .4s ease;
	}

	label {
		color: #222;
		font-size: 18px;
		margin-top: 20px;
	}
	</style>
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
			<a class="nav-link active" href="index.php">Home</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="register.php">Register</a>
		</li>
		</ul>
	</div>
	</nav>

	<div class="container">
		<div class='row'>
			<div class='mx-auto'>
				<p class='msg'>
				<?php 
					if (isset($_GET['msg'])) {
						$msgid = $_GET['msg'];
						if (isset($msgid)){
							if ($msgid == 1) {
								echo "Invalid Username or Password!";
							}
							if ($msgid == 2) {
								echo "Please login to stonk!";
							}
							elseif ($msgid == 3) {
								echo "Only admins allowed!";
							}
	
						}
						else {
							echo "";
						}
					}
				?>
				</p>
			</div>
		</div>
		
		<div class="row" >
			<div class="mx-auto">
				<h1>Login</h1>
				<form method="post" action="scripts/login.php">
				<div class="form-group">
					<label for="username">BIEX Username</label>
					<input type="text" class="form-control" id="username" name="username">
				</div>
				<div class="form-group">
					<label for="password">BIEX Secret Code</label>
					<input type="password" class="form-control" id="password" name="password">
				</div>
				<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="mx-auto">
			<img src="brr.png">
		</div>
	</div>
</body>
</html>