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
    <link rel="stylesheet" type="text/css" href="../camagru.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css">
    <script src="https://kit.fontawesome.com/82e513fc69.js"></script></head>
<body>
    <?php include_once '../navigation.php'; ?>
    <div class="container form-container">
        <div class="column is-half form-wrapper">
            <div class="box card-title">
                <h2 class="form-title title">Reset your password</h2>
            </div>
            <div class="box">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="control">
                    <div class="field <?php echo (!empty($user->email_err)) ? 'has-error' : ''; ?>">
                        <label class="label">Email</label>
                        <div class="control has-icons-left has-icons-right">
                            <input required type="text" name="email" class="input" value="">
                            <span class="icon is-small is-left">
                            <i class="fas fa-envelope"></i>
                            </span>
                        </div>
                        <?php if (isset($user)) {?>
                        <span class="help-block"><?php echo $user->email_err; ?></span>
                        <?php }; ?>
                    </div>
                    <div class="field">
                        <input type="submit" class="button is-link" value="Submit">
                    </div>
                    <p>Changed your mind? <a href="login.php">Login here</a>.</p>
                    <?php if (isset($user) && !isset($user->email_err) && $_SERVER["REQUEST_METHOD"] == "POST") {?>
                    <span class="help-block"><?php echo "Please check your email box, we sent you the link to reset your password"; ?></span>
                    <?php }; ?>
                </form>
            </div>
        </div>
    </div>
    <?php include_once '../footer.php'; ?>
</body>
</html>
