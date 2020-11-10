<?php
if (isset($_POST['userinput'])){

	session_start();
	include("connect.inc.php");

	# Definerer variabler
	$userinput = $_POST['userinput'];
	$firstnameinput = $_POST['firstnameinput'];
	$lastnameinput = $_POST['lastnameinput'];
	$emailinput = $_POST['emailinput'];
	$passinput = $_POST['passinput'];
	$pass2input = $_POST['pass2input'];

	# Hasher passordet med BCRYPT som inneholder salt
	$passhash = password_hash($passinput, PASSWORD_DEFAULT);

	# Escaper inputene (utenom $passhash) slik at brukeren ikke kan skrive inn kode i MySQL
	$userescape = mysqli_real_escape_string($con, $userinput);
	$fnameescape = mysqli_real_escape_string($con, $firstnameinput);
	$lnameescape = mysqli_real_escape_string($con, $lastnameinput);
	$emailescape = mysqli_real_escape_string($con, $emailinput);

	# Sender det brukeren tastet inn tilbake slik at man slipper å skrive inn på nytt
	# htmlspecialchars escaper html og php kode slik at brukeren ikke kan benytte seg av cross site scripting (XSS)
	$_SESSION['userinput'] = htmlspecialchars($userinput);
	$_SESSION['fnameinput'] = htmlspecialchars($firstnameinput);
	$_SESSION['lnameinput'] = htmlspecialchars($lastnameinput);
	$_SESSION['emailinput'] = htmlspecialchars($emailinput);

	# Error om hvilke felt som ikke er fylt inn
	if (empty($userinput)){$_SESSION['emptyuser'] = 1;}
	if (empty($firstnameinput)){$_SESSION['emptyfirst'] = 1;}
	if (empty($lastnameinput)){$_SESSION['emptylast'] = 1;}
	if (empty($emailinput)){$_SESSION['emptyemail'] = 1;}
	if (empty($passinput)){$_SESSION['emptypass'] = 1;}
	if (empty($pass2input)){$_SESSION['emptypass2'] = 1;}

	# Sjekker om brukernavnet er tatt
	$sql1 = "SELECT user_id FROM users WHERE username='$userescape'";
	$result1 = $con->query($sql1);
	if (mysqli_num_rows($result1)>0){$_SESSION['usertaken'] = 1;}

	# Sjekker om mailen er tatt
	$sql2 = "SELECT user_id FROM users WHERE email='$emailescape'";
	$result2 = $con->query($sql2);
	if (mysqli_num_rows($result2)>0){$_SESSION['emailtaken'] = 1;}

	# Sjekker om mailen er av godtjent form og type (kasper@eksempel.no)
	if (!empty($emailinput)){if (!filter_var($emailinput, FILTER_VALIDATE_EMAIL)){$_SESSION['emailnotvalid'] = 1;}}

	# Sjekker om passordene matcher
	if (!empty($passinput) && !empty($pass2input)){if ($passinput != $pass2input){$_SESSION['passnotmatch'] = 1;}}

	header("Location: ../register.php");
	
	# Sjekker at all informasjon er gyldig
	if (!empty($userinput) && !empty($firstnameinput) && !empty($lastnameinput) && !empty($emailinput) && !empty($passinput) && !empty($pass2input) && (mysqli_num_rows($result1) == 0) && (mysqli_num_rows($result2) == 0) && filter_var($emailinput, FILTER_VALIDATE_EMAIL) && ($passinput == $pass2input) && (6/2*(1+2) == 9)){
		$creationtime = date('Y-m-d H:i:s');
		$sql3 = "INSERT INTO users (username, f_name, l_name, email, password, creationtime) VALUES ('$userescape', '$fnameescape', '$lnameescape', '$emailescape', '$passhash', '$creationtime')";
		$result3 = $con->query($sql3);
		header("Location: ../login.php");
		unset($_SESSION['userinput']);
		unset($_SESSION['fnameinput']);
		unset($_SESSION['lnameinput']);
		unset($_SESSION['emailinput']);
		$_SESSION['userinput'] = htmlspecialchars($userinput);
	}

}

else {
	header("Location: ../register.php");
	exit();
}
?>