<?php
	session_start();
	require_once "../config/database.php";

	$email = $param_email = "";
	$email_err = $email_sent = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if (empty(trim($_POST["email"])))
			$email_err = "Please enter your email address.";
		else
		{
			$sql = "SELECT Email FROM user WHERE Email = :email";

			if ($stmt = $bdd->prepare($sql))
			{
				$stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
				$param_email = trim($_POST["email"]);

				if ($stmt->execute())
				{
					if ($stmt->rowCount() >= 1)
						$email = trim($_POST["email"]);
					else
						$email_err = "The email address dosen't have an account yet.";
				}
				else
					echo "Oops! Something went wrong. Please try again later.";
			}
			unset($stmt);
		}
		$sql = "UPDATE user SET `Reset`= :reset WHERE Email = :email";

		if (!$email_err && $stmt = $bdd->prepare($sql))
		{
			$email_sent = "Please check your email box, we sent you the link to reset your password";
			$stmt->bindParam(":reset", $reset, PDO::PARAM_STR);
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$reset = md5(microtime(TRUE)*100000);
			if ($stmt->execute())
			{
				$sujet = "Reset your password on Camagru" ;
				$message = 'Hello,

				Looks like you forgot your password... It happens, no worries!
				You can click on the following link in order to choose a new password:

				http://localhost:8080/camagru/users/reset_pwd.php?email='.urlencode($email).'&reset='.urlencode($reset).'

				---------------
				Ceci est un mail automatique, Merci de ne pas y répondre.';
				$message = wordwrap($message, 70, "\n");
				$headers = 'From: camagru@42.fr' . "\r\n" .
						'Reply-To: camagru@42.fr' . "\r\n" .
						'X-Mailer: PHP/' . phpversion();
				mail($email, $sujet, $message, $headers) ;
			}
			else
				echo "Something went wrong. Please try again later.";
		}
		unset($stmt);
		unset($bdd);
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Reset your password</h2>
        <p>Please fill your email address.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			<div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input required type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <!-- <input type="reset" class="btn btn-default" value="Reset"> -->
            </div>
            <p>Changed your mind? <a href="login.php">Login here</a>.</p>
			<span class="help-block"><?php echo $email_sent; ?></span>
        </form>
    </div>
</body>
</html>
