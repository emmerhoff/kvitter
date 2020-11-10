<?php
	# Unsetter og destroyer alle sessionvariabler, slik at brukeren ikke lengre er inlogget
	session_start();
	unset($_SESSION['login']);
	session_destroy();
	header("Location: ../");
	exit();
?>