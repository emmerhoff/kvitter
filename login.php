<!DOCTYPE html>
<html lang="en">
<head>
	<title> Kvitter - Login </title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<link rel="shortcut icon" href="media/icons/favicon.gif" type="icon/gif">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<?php
		session_start();

		# Sjekker om brukeren er loggen inn
		if (isset($_SESSION['login'])){
			header("Location: index.php");
		}
		else {
		}

		# Errormeldinger
		$red = "";
		$wrong = "";
		$userinput = "";
		if (isset($_SESSION['userinput'])){$userinput = $_SESSION['userinput']; unset($_SESSION['userinput']);}
		if (isset($_SESSION['wrong'])){$red = "border: 2px solid red"; $wrong = "<label>Wrong username or password</label>"; unset($_SESSION['wrong']);}
	?>
	<div class="container">
		<!-- Sender POST verdiene til include/login.inc.php -->
		<form action="include/login.inc.php" method="POST">
			<h1> Login to Kvitter </h1>
			<input name="userinput" placeholder="Username" autocomplete="off" maxlength="255" class="user" type="text" style="<?php echo $red; ?>" value="<?php echo $userinput; ?>">
			<?php echo $wrong; ?>
			<input name="passinput" placeholder="Password" autocomplete="off" maxlength="255" class="pass" type="password" style="<?php echo $red; ?>">
			<?php echo $wrong; ?>
			<input type="submit" value="LOGIN">
			<a href="register.php"> Do you want to register? <span style="text-decoration: underline;">Click here! </span></a>
		</form>
	</div>
</body>
</html>