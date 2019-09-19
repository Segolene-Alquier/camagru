<nav class="navbar is-fixed-top is-primary" role="navigation" aria-label="main navigation" id="navbar">
	<div class="navbar-brand" style="background-color: transparent;">
		<?php
			if (file_exists('index.php'))
				echo '<a href="index.php" class="icon-home navbar-item"><i class="icon-nav fas fa-home"></i></a>';
			else
				echo '<a href="../index.php" class="icon-home navbar-item"><i class="icon-nav fas fa-home"></i></a>';
		?>
		<a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" onclick="document.querySelector('.navbar-menu').classList.toggle('is-active');">
			<span aria-hidden="true"></span>
			<span aria-hidden="true"></span>
			<span aria-hidden="true"></span>
		</a>
	</div>
	<div class="navbar-menu ">
		<div class="navbar-start">
		</div>
		<div class="navbar-end">
			<?php
			if(isset($_SESSION['username']) === true){
				echo '<div class="navbar-item"><a href="/camagru/editing/edit.php" title="Montage"><i class="icon-nav fas fa-camera"></i></a></div>';
				echo '<div class="navbar-item"><a href="/camagru/settings/settings.php" title="Mon Compte"><i class="icon-nav fas fa-user"></i></a></div>';
				echo '<div class="navbar-item"><a href="/camagru/users/logout.php"><i class="icon-nav fas fa-sign-out-alt"></i></a></div>';
			 }
			 else {
				echo '<div class="navbar-item"><a href="/camagru/users/login.php"><i class="icon-nav fa fa-sign-in" aria-hidden="true"></i></a></div>';
				echo '<div class="navbar-item"><a href="/camagru/users/create_user.php"><i class="icon-nav fa fa-user-plus" aria-hidden="true"></i></a></div>';
			 }
		?>
		</div>
	</div>
</nav>
