<!DOCTYPE html>
<html lang="en">
<head>
	<title> Kvitter - Register</title>
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

	/* Nullsetter alle mulige error meldinger */
		$red1 = "";
		$red2 = "";
		$red3 = "";
		$red4 = "";
		$red5 = "";
		$filluser = "";
		$fillfirst = "";
		$filllast = "";
		$fillemail = "";
		$fillpass = "";
		$usertaken = "";
		$emailtaken = "";
		$emailnotvalid = "";
		$passnotmatch = "";
		
	/* Error melding om å fylle inn felt */
		if (isset($_SESSION['emptyuser'])) {$red1 = "border: 2px solid red"; $filluser = "<label> Fill in a username </label>"; unset($_SESSION['emptyuser']); }
		if (isset($_SESSION['emptyfirst'])) {$red2 = "border: 2px solid red"; $fillfirst = "<label> Fill in your first name </label>"; unset($_SESSION['emptyfirst']); }
		if (isset($_SESSION['emptylast'])) {$red3 = "border: 2px solid red"; $filllast = "<label> Fill in your last name </label>"; unset($_SESSION['emptylast']); }
		if (isset($_SESSION['emptyemail'])) {$red4 = "border: 2px solid red"; $fillemail = "<label> Fill in your email </label>"; unset($_SESSION['emptyemail']); }
		if (isset($_SESSION['emptypass'])) {$red5 = "border: 2px solid red"; $fillpass = "<label> Fill in a password </label>"; unset($_SESSION['emptypass']); }
		if (isset($_SESSION['emptypass2'])) {$red5 = "border: 2px solid red"; $fillpass = "<label> Fill in a password </label>"; unset($_SESSION['emptypass2']); }

	# Brukernavn og/eller mail er allerede tatt
		if (isset($_SESSION['usertaken'])) {$red1 = "border: 2px solid red"; $usertaken = "<label> Username is already taken </label>"; unset($_SESSION['usertaken']); }
		if (isset($_SESSION['emailtaken'])) {$red4 = "border: 2px solid red"; $emailtaken = "<label> Email is already taken </label>"; unset($_SESSION['emailtaken']); }
		
	# Email er ikke gyldig
		if (isset($_SESSION['emailnotvalid'])) {$red4 = "border: 2px solid red"; $emailnotvalid = "<label> Email not valid </label>"; unset($_SESSION['emailnotvalid']); }
		
	# Passord matcher ikke
		if (isset($_SESSION['passnotmatch'])) {$red5 = "border: 2px solid red"; $passnotmatch = "<label> Passwords do not match </label>"; unset($_SESSION['passnotmatch']); }


	/* Autofill hva som tidligere har blitt skrevet inn */
		$userinput = "";
		$fnameinput = "";
		$lnameinput = "";
		$emailinput = "";

		if (isset($_SESSION['userinput'])){
			$userinput = $_SESSION['userinput'];
			$fnameinput = $_SESSION['fnameinput'];
			$lnameinput = $_SESSION['lnameinput'];
			$emailinput = $_SESSION['emailinput'];
			unset($_SESSION['userinput']);
			unset($_SESSION['fnameinput']);
			unset($_SESSION['lnameinput']);
			unset($_SESSION['emailinput']);
		}
	?>

	<div class="container">
		<!-- Sender post data til include/reg.inc.php -->
		<form action="include/reg.inc.php" method="POST">
			<h1> Register today! </h1>
			<input name="userinput" placeholder="Username" autocomplete="off" maxlength="255" class="user" type="text" style="<?php echo $red1;?>" value="<?php echo $userinput;?>">
			<?php echo $filluser; echo $usertaken; ?>
			<input name="firstnameinput" placeholder="First name" autocomplete="off" maxlength="255" class="user" type="text" style="<?php echo $red2;?>" value="<?php echo $fnameinput;?>">
			<?php echo $fillfirst; ?>
			<input name="lastnameinput" placeholder="Last name" autocomplete="off" maxlength="255" class="user" type="text" style="<?php echo $red3;?>" value="<?php echo $lnameinput;?>">
			<?php echo $filllast; ?>
			<input name="emailinput" placeholder="Email" autocomplete="off" maxlength="255" class="mail" type="text" style="<?php echo $red4;?>" value="<?php echo $emailinput;?>">
			<?php echo $fillemail; echo $emailtaken; echo $emailnotvalid; ?>
			<input name="passinput" placeholder="Password" autocomplete="off" maxlength="255" class="pass" type="password" style="<?php echo $red5;?>" value="">
			<?php echo $fillpass; echo $passnotmatch ?>
			<input name="pass2input" placeholder="Repeat password" autocomplete="off" maxlength="255" class="pass" type="password" style="<?php echo $red5;?>" value="">
			<?php echo $fillpass; echo $passnotmatch ?>
			<input type="submit" value="REGISTER">
			<a href="login.php"> Already an user? <span style="text-decoration: underline;">Click here! </span></a>
		</form>
	</div>
</body>
</html>