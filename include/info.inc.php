<?php
	# Sjekker om brukeren er logget inn og setter $user variablen, slik at det blir mindre kode.
	if (isset($_SESSION['login'])){
		$user = $_SESSION['login'];
		$usere = htmlspecialchars($user);
		$userurl = urlencode($user);
	}
	else {
		header("Location: welcome.php");
	}
?>