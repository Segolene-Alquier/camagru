<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User settings</title>
    <link rel="stylesheet" type="text/css" href="./camagru.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css">
    <script src="https://kit.fontawesome.com/82e513fc69.js"></script>
</head>
<body>
	<?php include_once './navigation.php'; ?>
	<div class="section ">
		<h1 class="title is-2 settings-title">Welcome to your user page!</h1>
		<div class="settings-wrapper">
			<div class="settings-div">
				<h2 class="subtitle is-4">👋 Modify your username</h2>
				<div class="field is-horizontal ">
					<div class="field-body">
						<div class="field settings-field">
							<p class="control is-expanded has-icons-left">
								<input class="input" type="text" placeholder="Current username">
								<span class="icon is-small is-left">
								<i class="fas fa-user"></i>
								</span>
							</p>
						</div>
						<div class="field settings-field">
							<p class="control is-expanded has-icons-left has-icons-right">
								<input class="input " type="email" placeholder="New username" value="">
								<span class="icon is-small is-left">
								<i class="fas fa-user"></i>
								</span>
							</p>
						</div>
						<div class="field">
							<div class="control">
								<button class="button is-primary">
								Save
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="settings-div">
				<h2 class="subtitle is-4">🔑 Modify your password</h2>
				<div class="field is-horizontal ">
					<div class="field-body">
						<div class="field settings-field">
							<p class="control is-expanded has-icons-left">
								<input class="input" type="text" placeholder="Current password">
								<span class="icon is-small is-left">
								<i class="fas fa-key"></i>
								</span>
							</p>
						</div>
						<div class="field settings-field">
							<p class="control is-expanded has-icons-left has-icons-right">
								<input class="input " type="email" placeholder="New password" value="">
								<span class="icon is-small is-left">
								<i class="fas fa-key"></i>
								</span>
							</p>
						</div>
						<div class="field">
							<div class="control">
								<button class="button is-primary">
								Save
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="settings-div">
				<h2 class="subtitle is-4">💌 Modify your email address</h2>
				<div class="field is-horizontal ">
					<div class="field-body">
						<div class="field settings-field">
							<p class="control is-expanded has-icons-left">
								<input class="input" type="text" placeholder="Current email">
								<span class="icon is-small is-left">
								<i class="fas fa-envelope"></i>
								</span>
							</p>
						</div>
						<div class="field settings-field">
							<p class="control is-expanded has-icons-left has-icons-right">
								<input class="input " type="email" placeholder="New email" value="">
								<span class="icon is-small is-left">
								<i class="fas fa-envelope"></i>
								</span>
							</p>
						</div>
						<div class="field">
							<div class="control">
								<button class="button is-primary">
								Save
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="settings-div">
				<h2 class="subtitle is-4">🔔 Your notification preferences</h2>
				<h3 class="subtitle is-6">Do you want to get a notification email if someone comments one of your pictures?</h3>
				<div class="buttons has-addons">
					<span class="button is-success is-selected">Yes</span>
					<span class="button is-danger">No</span>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
