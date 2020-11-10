<?php
	session_start();
	# Inkluderer informasjon om personen som er inlogget og connect info
	include("include/connect.inc.php");
	include("include/info.inc.php");

	# Escaper slik at man ikke kan utføre SQL-injection
	$userescape = mysqli_real_escape_string($con, $_SESSION['login']);

	# Henter ut informasjon om personen som er logget inn
	$sql = "SELECT username, f_name, l_name, email, pic FROM users WHERE username='$userescape'";
	$result = $con->query($sql);
	$rad = $result->fetch_assoc();
	$username = htmlspecialchars($rad['username']);
	$f_name = htmlspecialchars($rad['f_name']);
	$l_name = htmlspecialchars($rad['l_name']);
	$email = htmlspecialchars($rad['email']);
	$pic = htmlspecialchars($rad['pic']);

	# Markering av eksisterende profilbilde, slik at det du har er markert:
	$pic1 = "";
	$pic2 = "";
	$pic3 = "";
	$pic4 = "";
	$pic5 = "";
	$pic6 = "";
	$pic7 = "";
	$pic8 = "";
	if ($pic == "1.jpg"){$pic1="checked";}
	if ($pic == "2.jpg"){$pic2="checked";}
	if ($pic == "3.jpg"){$pic3="checked";}
	if ($pic == "4.jpg"){$pic4="checked";}
	if ($pic == "5.jpg"){$pic5="checked";}
	if ($pic == "6.jpg"){$pic6="checked";}
	if ($pic == "7.jpg"){$pic7="checked";}
	if ($pic == "8.jpg"){$pic8="checked";}

	# Errormeldinger:
	$successpass = "";
	$successemail = "";
	$passnotmatch = "";
	$emailnotvalid = "";
	$emailtaken = "";
	$successpic = "";
	if (isset($_SESSION['emailnotvalid'])){$emailnotvalid = "<label> The email you typed in is not valid. Your email has NOT been changed </label>";unset($_SESSION['emailnotvalid']);}
	if (isset($_SESSION['emailtaken'])){$emailtaken = "<label> The email you typed in is already in use. Your email has NOT been changed </label>";unset($_SESSION['emailtaken']);}
	if (isset($_SESSION['successemail'])){$successemail = "<label style='color:green;font-size:110%'>The email has successfully been changed</label>";unset($_SESSION['successemail']);}
	if (isset($_SESSION['passnotmatch'])){$passnotmatch = "<label> The two passwords does not match. Your password has NOT been changed </label>";unset($_SESSION['passnotmatch']);}
	if (isset($_SESSION['successpass'])){$successpass = "<label style='color:green;font-size:110%'>The password has successfully been changed</label>";unset($_SESSION['successpass']);}
	if (isset($_SESSION['successpic'])){$successpic = "<label style='color:green;font-size:110%'>Your profile picture has successfully been updated</label>";unset($_SESSION['successpic']);}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Kvitter - Settings</title>
	<link rel="shortcut icon" href="media/icons/favicon.gif" type="icon/gif">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/settings.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
		.settings {color: #fff;}
		.user {color: #fff;}
	</style>
</head>
<body>
	<?php include("include/header.inc.php"); ?>
	<div class="container">
		<div class="box">
			<?php echo "<h2> Settings for $f_name $l_name:</h2>"; ?>
			<!-- Printer errormeldinger -->
			<div><?php echo $emailnotvalid;?></div>
			<div><?php echo $emailtaken;?></div>
			<div><?php echo $successemail;?></div>
			<div><?php echo $successpic;?></div>
			<div><?php echo $passnotmatch;?></div>
			<div><?php echo $successpass;?></div>
		</div>
		<div class="box">
			<!-- POST informasjonen sendes til include/settings.inc.php -->
			<form action="include/settings.inc.php" method="POST">
				<p> Email: </p><input type="text" name="emailinput" value="<?php echo $email;?>">
				<p> Choose profile picture: </p>

				<!-- Bildene er Radiobuttons som er hidden i css, men de har labels i form av bilder, som vises for brukeren -->
				<div class="pictures">
				<span><input type="radio" name="profilepic" value="1.jpg" id="pic1" <?php echo $pic1;?>><label for="pic1"><img src="media/profilepics/1.jpg" alt="picture 1"></label></span>
				<span><input type="radio" name="profilepic" value="2.jpg" id="pic2" <?php echo $pic2;?>><label for="pic2"><img src="media/profilepics/2.jpg" alt="picture 2"></label></span>
				<span><input type="radio" name="profilepic" value="3.jpg" id="pic3" <?php echo $pic3;?>><label for="pic3"><img src="media/profilepics/3.jpg" alt="picture 3"></label></span>
				<span><input type="radio" name="profilepic" value="4.jpg" id="pic4" <?php echo $pic4;?>><label for="pic4"><img src="media/profilepics/4.jpg" alt="picture 4"></label></span>
				<span><input type="radio" name="profilepic" value="5.jpg" id="pic5" <?php echo $pic5;?>><label for="pic5"><img src="media/profilepics/5.jpg" alt="picture 5"></label></span>
				<span><input type="radio" name="profilepic" value="6.jpg" id="pic6" <?php echo $pic6;?>><label for="pic6"><img src="media/profilepics/6.jpg" alt="picture 6"></label></span>
				<span><input type="radio" name="profilepic" value="7.jpg" id="pic7" <?php echo $pic7;?>><label for="pic7"><img src="media/profilepics/7.jpg" alt="picture 7"></label></span>
				<span><input type="radio" name="profilepic" value="8.jpg" id="pic8" <?php echo $pic8;?>><label for="pic8"><img src="media/profilepics/8.jpg" alt="picture 8"></label></span>
				</div>

				<p> New password: </p><input type="password" name="passinput" placeholder="Leave empty for no change">

				<p> Repeat new password: </p><input type="password" name="pass2input" placeholder="Leave empty for no change">
				<input type="submit" value="Update settings">
			</form>
		</div>
	</div>
</body>
</html>