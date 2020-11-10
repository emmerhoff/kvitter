<?php
	# All information om koblingen til SQL databasen
	$tjener="127.0.0.1";
	$brukernavn="root";
	$passord="";
	$database="kvitter_db";

	$con = new mysqli($tjener, $brukernavn, $passord, $database);

	if ($con->connect_error){
		die("<br><br><p id='red'>Noe gikk galt: " . $kobling->connect_error . "</p>");
	}
	$con->set_charset("utf8");
?>