<?php
	session_start();
	# Sjekker om man er logget inn
	if (isset($_SESSION['login'])){
		header("Location: index.php");
	}
	else {
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title> Welcome to Kvitter </title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/welcome.css">
	<link rel="shortcut icon" href="media/icons/favicon.gif" type="icon/gif">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<div class="welcome-container">
		<div id="left">
			<div id="left-content">
				<h1> Welcome to Kvitter! </h1><br>
				<p> A place where you can <br>share your thoughts to your followers<br> and follow people without them knowing! </p>
			</div>
		</div>

		<div id="right">
			<div id="right-content">
				<a href="register.php">Register now!</a>
				<a href="login.php">Login</a>
			</div>
		</div>
	</div>
</body>
</html>