<nav class="navbar is-fixed-top is-primary" role="navigation" aria-label="main navigation">
	<div class="navbar-brand">
		<a href="/index.php" class="navbar-item"><i class="fas fa-home"></i></a>
	</div>
	<div class="navbar-menu is-active">
		<div class="navbar-start">
			<!-- navbar items -->
		</div>

		<div class="navbar-end">
			<!-- navbar items -->
		</div>
		<?php
			// echo $_SESSION['username'];
			if(isset($_SESSION['username']) === true){
				// Say "Welcome"
				echo '<div class="navbar-item"><a href="/users/myaccount.php"><i class="fas fa-user"></i></a></div>';
				echo '<div class="navbar-item"><a href="/camagru/users/logout.php">Log out</a></div>';
			 } else {
				echo '<div class="navbar-item"><a href="/camagru/users/login.php">Log in</a>';
				echo '<div class="navbar-item"><a href="/camagru/users/create_user.php">Sign up</a></div>';
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
</nav>
