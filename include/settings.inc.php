<?php
if (isset($_POST['emailinput'])){
	session_start();
	include("connect.inc.php");
	# Definerer variabler:
	$user = $_SESSION['login'];
	$userescape = mysqli_real_escape_string($con, $user);
	$emailinput = $_POST['emailinput'];
	$emailescape = mysqli_real_escape_string($con, $emailinput);
	$picnew = $_POST['profilepic'];
	$passinput = $_POST['passinput'];
	$pass2input = $_POST['pass2input'];

	# Setter inn ny email hvis input ikker er tomt, ikke er det samme som før, er av godkjent type og ingen andre har det. Feilmeldinger sendes som SESSION variabler
	if (!empty($emailinput)){
		$sql2 = "SELECT email FROM users WHERE username='$userescape'";
		$result2 = $con->query($sql2);
		$rad = $result2->fetch_assoc();
		$email = $rad['email'];
		if ($email != $emailinput){
			if (filter_var($emailinput, FILTER_VALIDATE_EMAIL)){
				$sql3 = "SELECT email from users WHERE email='$emailescape'";
				$result3 = $con->query($sql3);
				if (mysqli_num_rows($result3) == 0){
					$sql4 = "UPDATE users SET email = '$emailescape' WHERE username = '$userescape'";
					$result4 = $con->query($sql4);
					$_SESSION['successemail'] = 1;
				}
				else {
					$_SESSION['emailtaken'] = 1;
				}

			}
			else {
				$_SESSION['emailnotvalid'] = 1;
			}
		}
	}

	# Setter nytt profilbilde hvis det er ulikt eksisterende profilbile
	$sql5 = "SELECT pic FROM users WHERE username='$userescape'";
	$result5 = $con->query($sql5);
	$rad = $result5->fetch_assoc();
	$pic = $rad['pic'];
	if ($pic != $picnew){
		$sql6 = "UPDATE users SET pic = '$picnew' WHERE username = '$userescape'";
		$result=$con->query($sql6);
		$_SESSION['successpic'] = 1;
	}

	# Setter nytt passord hvis begge feltene ikke er tomme og er samsvarende. Errormeldinger sendes i form av SESSION variabler
	if ((!empty($passinput)) && (!empty($pass2input))){
		if ($passinput == $pass2input){
			$passhash = password_hash($passinput, PASSWORD_DEFAULT);
			$sql = "UPDATE users SET password = '$passhash' WHERE username = '$userescape'";
			$result=$con->query($sql);
			$_SESSION['successpass'] = 1;
		}
		else {
			$_SESSION['passnotmatch'] = 1;
		}
	}

	header("Location: ../settings.php");
}
else {
	header("Location: ../settings.php");
}
?>