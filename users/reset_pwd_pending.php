<?php
	session_start();
	require_once "../config/database.php";

	$email = $param_email = "";
	$email_err = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if (empty(trim($_POST["email"])))
			$email_err = "Please enter your email address.";
		else
		{
			$sql = "SELECT Email FROM user WHERE Email = :email";

			if ($stmt = $bdd->prepare($sql))
			{
				// Bind variables to the prepared statement as parameters
				$stmt->bindParam(":email", $param_email, PDO::PARAM_STR);

				// Set parameters
				$param_email = trim($_POST["email"]);
				echo $param_email;
				// Attempt to execute the prepared statement
				if ($stmt->execute())
				{

					if ($stmt->rowCount() >= 1)
					{
						// $email = trim($_POST["email"]);
						// $email_err = "Yes c'est bon ma vieille";
					echo "ok trouve";



					}
					else
						$email_err = "The email address dosen't have an account yet.";

				}
				else
					echo "Oops! Something went wrong. Please try again later.";
			}
			unset($stmt);
		}
		// // Préparation du mail contenant le lien d'activation
		// $sujet = "Activation de votre compte sur Camagru" ;
		// // $entete = "From: inscription@camagru.com" ;
		// $message = 'Hello,

		// Looks like you forgot your password... It happens, no worries!
		// You can click on the following link in order to choose a new password:

		// http://localhost:8080/camagru/users/reset_pwd.php?log='.urlencode($username).'&cle='.urlencode($cle).'

		// ---------------
		// Ceci est un mail automatique, Merci de ne pas y répondre.';
		// $message = wordwrap($message, 70, "\n");
		// $headers = 'From: camagru@42.fr' . "\r\n" .
		// 		'Reply-To: camagru@42.fr' . "\r\n" .
		// 		'X-Mailer: PHP/' . phpversion();
		// mail($email, $sujet, $message, $headers) ;
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
<h1>Please check your emails, we sent you a link to reset your password.</h1>
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
        </form>
    </div>
</body>
</html>
