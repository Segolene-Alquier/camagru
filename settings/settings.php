<?php
session_start();
require "settings_class.php";
// creer restriction login
if (!isset($_SESSION['username']))
	header('Location: ../users/login.php');
// if (isset($_POST["modifyPwd"]))
// {
// 	$user = new Setting();
// 	$user->modifyPassword($_SESSION['username'], $_POST['old_password'], $_POST['new_password']);

// }
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["modifyMail"]))
{
	// $user = new Setting();
	?>
	<script> console.log('coucou');</script>
	<?php
	// $user->modifyMail($_SESSION['username'], $_POST['old_mail'], $_POST['new_mail']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User settings</title>
    <link rel="stylesheet" type="text/css" href="../camagru.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css">
    <script src="https://kit.fontawesome.com/82e513fc69.js"></script>
</head>
<body onload="wantsNotification()">
	<?php include_once '../navigation.php'; ?>
	<div class="section ">
		<h1 class="title is-2 settings-title">Welcome to your page <?= $_SESSION['username']?>!</h1>
		<div class="settings-wrapper">
			<div class="box settings-div">
				<h2 class="subtitle is-4">👋 Modify your username</h2>
				<!-- <form method="POST" action=""> -->
					<div class="field is-horizontal ">
						<div class="field-body">
							<div class="field settings-field">
								<p class="control is-expanded has-icons-left">
									<input required class="input" id="old_name" type="text" placeholder="Current username">
									<span class="icon is-small is-left">
									<i class="fas fa-user"></i>
									</span>
								</p>
							</div>
							<div class="field settings-field">
								<p class="control is-expanded has-icons-left has-icons-right">
									<input required class="input " id="new_name" type="text" placeholder="New username" value="">
									<span class="icon is-small is-left">
									<i class="fas fa-user"></i>
									</span>
								</p>
							</div>
							<div class="field">
								<div class="control">
									<input type="submit" name="modifyUsername" class="button is-primary" value="Save" onclick="modifyName();"/>
								</div>
							</div>
						</div>
					</div>
				<!-- </form> -->
			</div>
			<div class="box settings-div">
				<h2 class="subtitle is-4">🔑 Modify your password</h2>
				<!-- <form method="POST" action=""> -->
					<div class="field is-horizontal ">
						<div class="field-body">
							<div class="field settings-field">
								<p class="control is-expanded has-icons-left">
									<input required class="input" id="old_pwd" name="old_password" type="password" placeholder="Current password">
									<span class="icon is-small is-left">
									<i class="fas fa-key"></i>
									</span>
								</p>
							</div>
							<div class="field settings-field">
								<p class="control is-expanded has-icons-left has-icons-right">
									<input required class="input" id="new_pwd" name="new_password" type="password" placeholder="New password" value="">
									<span class="icon is-small is-left">
									<i class="fas fa-key"></i>
									</span>
								</p>
							</div>
							<div class="field">
								<div class="control">
									<input type="submit" name="modifyPwd" class="button is-primary" value="Save" onclick="checkPassword();"/>
								</div>
							</div>
						</div>
					</div>
				<!-- </form> -->
			</div>
			<div class="box settings-div">
				<h2 class="subtitle is-4">💌 Modify your email address</h2>
				<!-- <form method="POST" action="" > -->

				<div class="field is-horizontal ">
					<div class="field-body">
						<div class="field settings-field">
							<p class="control is-expanded has-icons-left">
								<input required class="input" id="old_mail" name="old_mail" type="text" placeholder="Current email">
								<span class="icon is-small is-left">
								<i class="fas fa-envelope"></i>
								</span>
							</p>
						</div>
						<div class="field settings-field">
							<p class="control is-expanded has-icons-left has-icons-right">
								<input required class="input" id="new_mail" name="new_mail" type="email" placeholder="New email" value="">
								<span class="icon is-small is-left">
								<i class="fas fa-envelope"></i>
								</span>
							</p>
						</div>
						<div class="field">
							<div class="control">
							<input type="submit" name="modifyMail" class="button is-primary" value="Save" onclick="modifyMail();"/>
							</div>
						</div>

					</div>

				</div>
				<!-- </form> -->

			</div>
			<div class="box settings-div">
				<h2 class="subtitle is-4">🔔 Your notification preferences</h2>
				<h3 class="subtitle is-6">Do you want to get a notification email if someone comments one of your pictures?</h3>
				<div class="buttons has-addons is-right">
					<span id="notif-yes" class="button is-success" onclick="notifYes();">Yes</span>
					<span id="notif-no" class="button is-danger" onclick="notifNo();">No</span>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="settings.js"></script>
</body>
</html>
