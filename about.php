<?php
	session_start();
	include("include/connect.inc.php");
	include("include/info.inc.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Kvitter - About Us</title>
	<link rel="shortcut icon" href="media/icons/favicon.gif" type="icon/gif">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
		.about {color: #fff;}
	</style>
</head>
<body>
	<?php include("include/header.inc.php"); ?>
	<div class="container">
		<div class="box">
			<h1> About us </h1>
		</div>
		<div class="box">
			<p> Kvitter is an social media platform developed by Kasper Emmerhoff. The idea is heavely inspired by Twitter, but nothing has been copied. The project started April 21st 2018 and it is under constant development. <br><br> Kvitter is coded ONLY using HTML, CSS, PHP and MySQL and no code has been copied from other sites.<br><br> Here at Kvitter, we take your security very seriously and we are currently doing our best to secure all of your data. Abselutely none of your data will ever be given or selled to third-part companies. <br><br>We hope you are going to enjoy this social media, and if you find any bugs, errors or room for improvement, please contact us at: contact@kvitter.com </p>
		</div>
	</div>
</body>
</html>