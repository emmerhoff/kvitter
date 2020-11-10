<?php
	# Inkluderer connect information og informasjon om den innloggede brukeren
	session_start();
	include("include/connect.inc.php");
	include("include/info.inc.php");
	if (!isset($_GET['u'])){
		header("Location: people.php");
	}
	$u = $_GET["u"];
	$uescape = mysqli_real_escape_string($con, $u);
	$uurl = urlencode($u);
	$userescape = mysqli_real_escape_string($con, $user);

	#Sjekk om brukeren eksisterer
	$sql = "SELECT username, f_name, l_name, pic FROM users WHERE username = '$uescape'";
	$result = $con->query($sql);
	$rad = $result->fetch_assoc();
	if (mysqli_num_rows($result) != 1){
		header("Location: people.php");
	}

	# Henter usertype fra brukeren
	$sqlutype = "SELECT u_type FROM users WHERE username='$uescape'";
	$resultutype = $con->query($sqlutype);
	$radutype = $resultutype->fetch_assoc();
	$utype = $radutype['u_type'];

	# Hente ut variabler
	$username = $rad['username'];
	$f_name = $rad['f_name'];
	$l_name = $rad['l_name'];
	$pic = $rad['pic'];
	$usernameescape = htmlspecialchars($username);
	$f_nameescape = htmlspecialchars($f_name);
	$l_nameescape = htmlspecialchars($l_name);

	# Legg til innlegg hvis du er på din egen side
	if (isset($_POST['innlegg'])){
		if (!empty($_POST['innlegg'])){
			$innleggescape = mysqli_real_escape_string($con, $_POST['innlegg']);
			$posttimenow = date("H:i - j F Y");
			$sql2 = "INSERT INTO posts (post_text, user_id, posttime) VALUES ('$innleggescape', (SELECT user_id FROM users WHERE username='$userescape'), '$posttimenow')";
			$result2 = $con->query($sql2);
		}
	}

	# Slett innlegg hvis du er på din egen side
	if (isset($_POST['deleteid'])){
		$deleteid = $_POST['deleteid'];
		$sql4 = "DELETE FROM posts WHERE post_id = '$deleteid' AND  user_id = (SELECT user_id FROM users WHERE username='$userescape')";
		$result4 = $con->query($sql4);
	}

	#Følg/Unfollow
	if (isset($_POST['follow'])){
		$followuser = $_POST['follow'];
		$sql6 = "INSERT INTO follow (user_id, user_id_follow) VALUES ((SELECT user_id FROM users WHERE username='$userescape'), (SELECT user_id FROM users WHERE username='$uescape'))";
		$result6=$con->query($sql6);
	}
	if (isset($_POST['unfollow'])){
		$unfollowuser = $_POST['unfollow'];
		$sql7 = "DELETE FROM follow WHERE follow.user_id = (SELECT user_id FROM users WHERE username='$userescape') AND follow.user_id_follow = (SELECT user_id FROM users WHERE username='$uescape')";
		$result7=$con->query($sql7);
	}

	# Sjekke om du følger personen fra før av eller ikke (mange til mange kobling) og vise ulike knapper
	$sql5 = "SELECT follow.user_id, follow.user_id_follow FROM follow WHERE follow.user_id=(SELECT users.user_id FROM users where users.username='$userescape') AND follow.user_id_follow=(SELECT users.user_id FROM users WHERE users.username='$uescape')";
	$result5 = $con->query($sql5);
	if (mysqli_num_rows($result5)){
		$follow = "<input type='hidden' name='unfollow' value='$u'><input id='followbutton' type='submit' value='Following'>";
	}
	else {
		$follow = "<input type='hidden' name='follow' value='$u'><input id='followbutton' type='submit' style='color: #4d9900; background-color: #fff; border: 2px solid #4d9900;' value='Follow +'>";
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Kvitter - </title>
	<link rel="shortcut icon" href="media/icons/favicon.gif" type="icon/gif">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/user.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
		<?php 	if ($u == $user){ echo ".profile, .user {color: #fff;}";}
				else {echo ".people {color: #fff;}";}
		?>
	</style>
</head>
<body>
	<?php include("include/header.inc.php"); ?>
	<div class="container">
		<div class="box userpage">
			<div class="userdiv">
				<!-- Hvis du er på din egen side vises instillinger og log ut ikonene -->
				<?php if ($user == $u){ echo "<a href='settings.php' title='SETTINGS'><img src='media/icons/settings.png' alt='settings'></a>";}?>
				<img src="media/profilepics/<?php echo $pic;?>" width="150" alt='picture' height="150">
				<?php if ($user == $u){ echo "<a href='include/logout.inc.php' title='LOG OUT'><img src='media/icons/logout.png' alt='logout'></a>";}?>
			</div>
			<h1 class="nameverified"> <?php echo "$f_nameescape $l_nameescape";?><?php if($utype>=2){echo "<img class='verified' width='35' height='35' src=media/icons/verified.png>";}?></h1>
			<div class='followbox'>
				<div><h2><i><?php echo "@$usernameescape";?></i></h2></div>
				<?php
					# Hvis du ikke er på din egen bruker har du mulighet til å følge eller slutte å følge
					if ($u != $user){
						echo "<form action='user.php?u=$uurl' method='POST'>$follow</form>\n";
					}
				?>
			</div>
			<div class='followfollowers'>
				<div class=following>
					<h4> Following: </h4>
					<h2>
					<?php
						$sql8 = "SELECT * FROM follow WHERE user_id = (SELECT user_id FROM users WHERE username='$uescape')";
						$result8 = $con->query($sql8);
						echo mysqli_num_rows($result8);
					?>	
					</h2>
				</div>
				<hr>
				<div class=followers>
					<h4> Followers: </h4>
					<h2> 
					<?php
						$sql8 = "SELECT * FROM follow WHERE user_id_follow = (SELECT user_id FROM users WHERE username='$uescape')";
						$result8 = $con->query($sql8);
						echo mysqli_num_rows($result8);
					?>
					</h2>
				</div>
			</div>
		</div>

		<?php
			# Hvis du er på din egen bruker har du mulighet til å skrive innlegg
			if ($u == $user){
				echo "<div class='box'>\n";
					echo "<form action='user.php?u=$uurl' method='POST'>\n";
						echo "<textarea name='innlegg' placeholder='Write a new post here...' maxlength='600' rows='5'></textarea>\n";
						echo "<input type='submit' value='PUBLISH'>\n";
					echo "</form>\n";
				echo "</div>\n";
			}


		?>

		<?php
			# Viser alle innlegg til brukeren
			$sql3 = "SELECT f_name, l_name, username, pic, post_text, post_id, posttime, u_type FROM users JOIN posts ON users.user_id=posts.user_id WHERE username='$uescape' ORDER BY posts.post_id DESC";
			$result3 = $con->query($sql3);
			while ($rad3 = $result3->fetch_assoc()){
				$userfirst = htmlspecialchars($rad3['f_name']);
				$userlast = htmlspecialchars($rad3['l_name']);
				$useruser = htmlspecialchars($rad3['username']);
				$userpic = $rad3['pic'];
				$post_id = $rad3['post_id'];
				$post_text = htmlspecialchars($rad3['post_text']);
				$posttime = $rad3['posttime'];
				$utype = $rad3['u_type'];

				# Hvis du er på din egen bruker har du mulighet til å slette dine innlegg
				if ($u == $user){
					echo "<div class='delete'>\n";
						echo "<form action='user.php?u=$uurl' method='POST'>\n";
							echo "<input type='hidden' name='deleteid' value='$post_id'>\n";
							echo "<input type='image' name='delete' src='media/icons/delete.png' alt='Delete' width='20' height='22'>\n";
						echo "</form>\n";
					echo "</div>\n";
				}
				echo "<div class='box'>\n";
					echo "<div class='navn'>\n";
						echo "<img src='media/profilepics/$userpic' alt='picture' width='50' height='50'>\n";
						if($utype>=2){echo "<h3> $userfirst $userlast</h3><img class='verified' width='22' height='22' src=media/icons/verified.png><h3><i>- @$useruser</i></h3>\n";}
						else {echo "<h3> $userfirst $userlast - <i>@$useruser</i></h3>\n";}
					echo "</div>\n";
					echo "<div class='text'>\n";
						echo "<p> $post_text </p>\n";
					echo "</div>\n";
					echo "<div class='dato'>\n";
						echo "<p> $posttime </p>\n";
					echo "</div>\n";
				echo "</div>\n";
			}

			# Hvis brukeren ikke har noen innlegg vises teksten:
			if (mysqli_num_rows($result3) == 0){
				echo "<div class='box'>\n";
					echo "<p> This user has not published anything yet! </p>\n";
				echo "</div>\n";
			}
		?>

	</div>
</body>
</html>