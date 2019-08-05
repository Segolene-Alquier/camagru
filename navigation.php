<nav class="navbar is-fixed-top is-primary" role="navigation" aria-label="main navigation">
	<div class="navbar-brand">
		<?php
			if (file_exists('index.php'))
				echo '<a href="index.php" class="navbar-item"><i class="fas fa-home"></i></a>';
			else
				echo '<a href="../index.php" class="navbar-item"><i class="fas fa-home"></i></a>';
		?>
		<a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" onclick="document.querySelector('.navbar-menu').classList.toggle('is-active');">
			<span aria-hidden="true"></span>
			<span aria-hidden="true"></span>
			<span aria-hidden="true"></span>
		</a>
	</div>
	<div class="navbar-menu ">
		<div class="navbar-start">
			<!-- navbar items -->
		</div>
		<div class="navbar-end">
			<?php
			if(isset($_SESSION['username']) === true){
				echo '<div class="navbar-item"><a href="/camagru/editing/edit.php" title="Montage"><i class="fas fa-camera"></i></a></div>';
				echo '<div class="navbar-item"><a href="/users/myaccount.php" title="Mon Compte"><i class="fas fa-user"></i></a></div>';
				echo '<div class="navbar-item"><a href="/camagru/users/logout.php title="Log Out"><i class="fas fa-sign-out-alt"></i></a></div>';
			 }
			 else {
				echo '<div class="navbar-item"><a href="/camagru/users/login.php">Log in</a>';
				echo '<div class="navbar-item"><a href="/camagru/users/create_user.php">Sign up</a></div>';
			 }
		?>
		</div>
	</div>
</nav>
