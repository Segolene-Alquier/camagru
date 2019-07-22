<?php
	session_start();
	require "user_class.php";

	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$user = new User();
		$user->reset_pwd_pending($_POST['email']);
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css">
</head>
<body>
    <div class="wrapper">
        <h2>Reset your password</h2>
        <p>Please fill your email address.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			<div class="form-group <?php echo (!empty($user->email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input required type="text" name="email" class="form-control" value="">
				<?php if (isset($user)) {?>
                <span class="help-block"><?php echo $user->email_err; ?></span>
				<?php }; ?>
            </div>
            <div class="form-group">
                <input type="submit" class="button" value="Submit">
                <!-- <input type="reset" class="btn btn-default" value="Reset"> -->
            </div>
            <p>Changed your mind? <a href="login.php">Login here</a>.</p>
			<?php if (isset($user) && !isset($user->email_err) && $_SERVER["REQUEST_METHOD"] == "POST") {?>
			<span class="help-block"><?php echo "Please check your email box, we sent you the link to reset your password"; ?></span>
			<?php }; ?>
        </form>
    </div>
</body>
</html>
