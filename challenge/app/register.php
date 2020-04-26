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
			<a class="nav-link" href="index.php">Home</a>
		</li>
		<li class="nav-item">
			<a class="nav-link active" href="register.php">Register</a>
		</li>
		</ul>
	</div>
  </nav>
  
  <div class="container">
		<div class='row'>
			<div class='mx-auto'>
				<p class='msg'>
				<?php
					$msgid = $_GET['msg'];
					if (isset($msgid)){
						if ($msgid == 1) {
							echo "Account Created Successfully!";
						}
						if ($msgid == 2) {
							echo "Error!";
						}

					}
					else {
						echo "";
					}
				?>
				</p>
			</div>
		</div>
		
		<div class="row" >
			<div class="mx-auto">
				<div>
					<h1>Register</h1>
				</div>
				<form method="POST" action="scripts/register-action.php">
				<div class="form-group">
					<label for="name">BIEX Your Name, good sire?</label>
					<input type="text" class="form-control" id="name" name="name">
				</div>
				<div class="form-group">
					<label for="username">BIEX Username</label>
					<input type="text" class="form-control" id="username" name="username">
				</div>
				<div class="form-group">
					<label for="password">BIEX Secret Code</label>
					<input type="password" class="form-control" id="password" name="password">
				</div>
				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" class="form-control" id="email" name="email">
				</div>
				<button type="submit" name="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>