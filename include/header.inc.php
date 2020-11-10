	<header>
		<label for="show-menu" class="show-menu" title="Show Menu">&#9776;</label>
		<input type="checkbox" id="show-menu" role="button">
		<ul>
			<li><a href="index.php" class="home" title="HOME"> HOME </a></li>
			<li><a href="people.php" class="people" title="PEOPLE"> PEOPLE </a></li>
			<li><a href="about.php" class="about" title="ABOUT US"> ABOUT US </a></li>
			<li class="dropdown">
				<a href="user.php?u=<?php echo $userurl;?>" class="user" title="YOUR PROFILE"> <?php echo "@$usere"; ?> </a>
					<div class="dropdiv">
						<a href="user.php?u=<?php echo $userurl;?>" class="profile"> My profile </a>
						<a href="settings.php" class="settings" title="SETTINGS"> Settings </a>
						<a href="include/logout.inc.php" title="LOG OUT"> Log Out </a>
					</div>
			</li>
		</ul>
	</header>