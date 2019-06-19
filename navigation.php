<div class="nav-wrap">
	<div class="home-link">
		<div><a href="/index.php"><i class="fas fa-home"></i></a></div>
	</div>
	<div class="log-section">
		<?php
			// echo $_SESSION['username'];
			if(isset($_SESSION['username']) === true){
				// Say "Welcome"
				echo '<div class="log-elem"><a href="/users/myaccount.php"><i class="fas fa-user"></i></a></div>';
				echo '<div class="log-elem"><a href="/camagru/users/logout.php">Log out</a></div>';
			 } else {
				echo '<div class="log-elem"><a href="/camagru/users/login.php">Log in</a>';
				echo '<div class="log-elem"><a href="/camagru/users/create_user.php">Sign up</a></div>';
			 }


			// if (!$_SESSION['username'])
			// {
			// 	echo '<div class="log-elem"><a href="/users/login.php">Log in</a>';
			// 	echo '<div class="log-elem"><a href="/users/create_user.php">Sign up</a></div>';
			// }
			// else
			// {
			// 	echo '<div class="log-elem"><a href="/users/myaccount.php"><i class="fas fa-user"></i></a></div>';
			// 	echo '<div class="log-elem"><a href="/camagru/users/logout.php">Log out</a></div>';
			// }
		?>
	</div>
</div>
