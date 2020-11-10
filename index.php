<?php
	/*
		Det som mangler foreløpig er:
			0: Dropdownpil etter @username
			1: Fikse CSS slik at navn+brukernavn+verifiedlogo blir bra scala
			2: minst tre karakterer og ikke lov med forskjellige tegn i brukernavn
			2: Sorteringsknapp på 'PEOPLE' og kanskje 'HOME'
				'PEOPLE': sort by followers, username, firstname, lastname
				'HOME': sort by publishing date
			3: Laste opp eget profilbilde og gjøre om til riktig størrelse og .jpg/høyere resolution på profilbilder
			4: Laste opp bilder som innlegg???
			5: Admin kan slette innlegg på user.php og ikke bare på index.php
			6: Promt: are you sure you want to delete this post? når man trykker slett
			6: Når du har posta innlegg og refresher, fiks at innlegget ikke postes flere ganger (plassering av kommando???)
			7: Fikse /user.php til /user/ på alle sider
			8: Legge til 'like' knapp, og vedsiden av viser hvor mange likes innlegget har
			9: Javascript/jQuery fikse at når du hovrer over "Following" byttes teksen til "Unfollow" + background-color: #f00
			10: Lage footer hvor man kan kontakte oss, rapportere bugs/innlegg, Persovernerklæring
			11: Legge til varsel om lagring av Cookies, (lese GDPR og vite hva som gjelder meg)
			12: Når man registrer seg så kommer det opp en prompt hvor du må lese gjennom bruksvilkår og godkjenne dem
			13: Koble til Google Analytics???
			14: Legge til ads?
	*/
	session_start();
	include("include/connect.inc.php");
	include("include/info.inc.php");

	$userescape = mysqli_real_escape_string($con, $user);

	# Legg til innlegg hvis du er på din egen side
	if (isset($_POST['innlegg'])){
		if (!empty($_POST['innlegg'])){
			$innleggescape = mysqli_real_escape_string($con, $_POST['innlegg']);
			$posttimenow = date("H:i - j F Y");
			$sql2 = "INSERT INTO posts (post_text, user_id, posttime) VALUES ('$innleggescape', (SELECT user_id FROM users WHERE username='$userescape'), '$posttimenow')";
			$result2 = $con->query($sql2);
		}
	}

	# Sletting av innlegg
	if (isset($_POST['deleteid'])){
		$deleteid = $_POST['deleteid'];
		# Sletting hvis du er på din egen bruker
		$sql4 = "DELETE FROM posts WHERE post_id = '$deleteid' AND  user_id = (SELECT user_id FROM users WHERE username='$userescape')";
		$result4 = $con->query($sql4);

		# Slett hvis du er admin
		if ($usertype == 3){
			$sql5 = "DELETE FROM posts WHERE post_id = '$deleteid'";
			$result5 = $con->query($sql5);
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Kvitter - Hjem</title>
	<link rel="shortcut icon" href="media/icons/favicon.gif" type="icon/gif">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
		.home {color: #fff;}
	</style>
</head>
<body>
	<?php include("include/header.inc.php"); ?>
	<div class="container">
		<?php
			# Mulighet for å skrive innlegg
			echo "<div class='box'>";
				echo "<form action='index.php' method='POST'>";
					echo "<textarea name='innlegg' placeholder='Write a new post here...' maxlength='600' rows='5'></textarea>";
					echo "<input type='submit' value='PUBLISH'>";
				echo "</form>";
			echo "</div>";

			# Sql spørring for å vise alle innlegg(posts) som brukeren du er logget inn med følger (mange til mange kobling), fra alle tre tabeller, inkludert dine egne innlegg
			$sql3 = "SELECT posts.post_id, post_text, posttime, posts.user_id, f_name, l_name, username, pic, u_type FROM posts JOIN users ON posts.user_id=users.user_id WHERE posts.user_id=(SELECT user_id FROM users WHERE username='$userescape') OR posts.user_id IN (SELECT user_id_follow FROM follow WHERE user_id=(SELECT user_id FROM users WHERE username='$userescape')) ORDER BY posts.post_id DESC";
			$result3 = $con->query($sql3);
			while ($rad3 = $result3->fetch_assoc()){
				$userfirst = htmlspecialchars($rad3['f_name']);
				$userlast = htmlspecialchars($rad3['l_name']);
				$useruser = htmlspecialchars($rad3['username']);
				$userurl = urlencode($rad3['username']);
				$userpic = $rad3['pic'];
				$post_id = $rad3['post_id'];
				$post_text = htmlspecialchars($rad3['post_text']);
				$posttime = $rad3['posttime'];
				$utype = $rad3['u_type'];

				# Hvis det er dine egne innlegg har du mulighet til å slette
				if ($rad3['username'] == $user OR $usertype == 3){
					echo "<div class='delete'>\n";
						echo "<form action='index.php' method='POST'>\n";
							echo "<input type='hidden' name='deleteid' value='$post_id'>\n";
							echo "<input type='image' name='delete' src='media/icons/delete.png' alt='Delete' width='20' height='22'>\n";
						echo "</form>\n";
					echo "</div>\n";
				}
				echo "<div class='box'>\n";
					echo "<a href='user.php?u=$userurl'><div class='navn'>\n";
						echo "<img src='media/profilepics/$userpic' alt='picture' width='50' height='50'>\n";
						if($utype>=2){echo "<h3> $userfirst $userlast<img class='verified' width='22' height='22' src='media/icons/verified.png'></h3><h3><i>- @$useruser</i></h3>\n";}
						else {echo "<h3> $userfirst $userlast - <i>@$useruser</i></h3>\n";}
					echo "</div></a>\n";
					echo "<div class='text'>\n";
						echo "<p> $post_text </p>\n";
					echo "</div>\n";
					echo "<div class='dato'>\n";
						echo "<p> $posttime </p>\n";
					echo "</div>\n";
				echo "</div>\n";
			}

			# Hvis du ikke følger noen eller ikke har skrevet noen innlegg kommer denne teksten opp:
			if (mysqli_num_rows($result3) == 0){
				echo "<div class='box'>";
					echo "<p> You have to follow some people to show their latest content. Navigate to the 'PEOPLE' tab to find some new people to follow </p>";
				echo "</div>";
			}
		?>
	</div>
</body>
</html>