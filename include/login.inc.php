<?php
if (isset($_POST['userinput'])){
	session_start();
	include("connect.inc.php");

	# Definerer variabler
	$userinput = $_POST['userinput'];
	$passinput = $_POST['passinput'];
	$userescape = mysqli_real_escape_string($con, $userinput);

	$sql = "SELECT username, password FROM users WHERE username='$userescape'";
	$result = $con->query($sql);
	$rad = $result->fetch_assoc();
	$username = $rad['username'];
	$password = $rad['password'];

	# Sjekker om innloggingen er gyldig og sender til index.php hvis den er det
	if ((!empty($userinput)) && (!empty($passinput)) && (mysqli_num_rows($result) == 1) && (password_verify($passinput, $password))){
		header("Location: ../");
		$_SESSION['login'] = $username;
	}

	# Hvis ikke sender den feilmelding og sender userinput, slik at brukeren slipper å skrive det på nytt
	else {
		$_SESSION['wrong'] = 1;
		$_SESSION['userinput'] = htmlspecialchars($userinput);
		header("Location: ../login.php");
	}

}

else {
	header("Location: ../login.php");
	exit();
}
?>