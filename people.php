<?php
	session_start();
	# Henter connect og informasjon om brukeren som er innlogget
	include("include/connect.inc.php");
	include("include/info.inc.php");

	# Sjekker om search er set og at den har innhold
	if (isset($_GET['search'])){
		if (!empty($_GET['search'])){
			$search = mysqli_real_escape_string($con, $_GET['search']);
			# Søke spøring hvor CONCAT gjør at du kan søke på f.eks: Kasper Emmerhoff, som er to ulike kolonner
			$sql = "SELECT username, f_name, l_name, pic, u_type FROM users WHERE username LIKE '%$search%' OR CONCAT( f_name,  ' ', l_name ) LIKE  '%$search%'";
			$result = $con->query($sql);
			$searchresult = "Search results for: '" . htmlspecialchars($_GET['search']) . "':";
		}
		else {
			# Hvis search er set men den er empty, viser den alle brukee
			$sql = "SELECT username, f_name, l_name, pic, u_type FROM users ORDER BY username";
			$result = $con->query($sql);
			$searchresult = "Displaying all users on Kvitter:";
		}
	}
	else {
		# Hvis search ikke er set, viser den alle brukere
		$sql = "SELECT username, f_name, l_name, pic, u_type FROM users ORDER BY username";
		$result = $con->query($sql);
		$searchresult = "Displaying all users on Kvitter:";
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Kvitter - People</title>
	<link rel="shortcut icon" href="media/icons/favicon.gif" type="icon/gif">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/people.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
		.people {color: #fff;}
	</style>
</head>
<body>
	<?php include("include/header.inc.php"); ?>
	<div class="container">
		<div class="box search">
			<form action='people.php' method="GET">
				<input type="text" name="search" placeholder="Search for other people here...">
				<input type="submit" value="SEARCH">
			</form>
			<p> <?php echo $searchresult;?></p>
		</div>
		<?php
			# While løkke som viser alle resultatene
			while ($rad = $result->fetch_assoc()){
				$userurl = urlencode($rad['username']);
				$userescape = htmlspecialchars($rad['username']);
				$f_nameescape = htmlspecialchars($rad['f_name']);
				$l_nameescape = htmlspecialchars($rad['l_name']);
				$pic = $rad['pic'];
				$utype = $rad['u_type'];
				echo "<div class='userbox'>\n";
				echo "<a href='user.php?u=$userurl'><div class='box users'>\n";
					echo "<img src='media/profilepics/$pic' alt='picture' width='75' height='75'>\n";
					echo "<div class='navn'>\n";
						if ($utype>=2){echo "<h3> $f_nameescape $l_nameescape <img src='media/icons/verified.png' width='20' height='20'></h3>\n";}
						else {echo "<h3> $f_nameescape $l_nameescape </h3>\n";}
						echo "<h3><i>@$userescape</i></h3>\n";
					echo "</div>\n";
				echo "</div></a>\n";
				echo "</div>\n";
			}


		?>
	</div>
</body>
</html>