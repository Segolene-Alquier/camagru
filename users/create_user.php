<?php
// Include config file
require_once "../config/database.php";

// Define variables and initialize with empty values
$username = $email = $password = $confirm_password = "";
$username_err = $email_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    // Validate username
    if (empty(trim($_POST["username"])))
        $username_err = "Please enter a username.";
	else
	{
        // Prepare a select statement
        $sql = "SELECT UserID FROM user WHERE Username = :username";

		if ($stmt = $bdd->prepare($sql))
		{
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
			if ($stmt->execute())
			{
                if ($stmt->rowCount() == 1)
                    $username_err = "This username is already taken.";
				else
                    $username = trim($_POST["username"]);
			}
			else
                echo "Oops! Something went wrong. Please try again later.";
        }
        // Close statement
        unset($stmt);
	}

	// Validate email
    if (empty(trim($_POST["email"])))
        $email_err = "Please enter an email address.";
	elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
        $email_err = "Email must be a valid email.";
	else
        $email = trim($_POST["email"]);

    // Validate password
    if (empty(trim($_POST["password"])))
		$password_err = "Please enter a password.";
    elseif (!preg_match ("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $_POST["password"]))
        $password_err = "Password must have at least 8 characters, one uppercase letter, one lowercase letter and one number.";
    else
        $password = trim($_POST["password"]);

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"])))
        $confirm_password_err = "Please confirm password.";
	else
	{
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password))
            $confirm_password_err = "Password did not match.";
    }

    // Check input errors before inserting in database
	if (empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err))
	{
        // Prepare an insert statement
        $sql = "INSERT INTO user (Username, Passwd, Email, Cle) VALUES (:username, :password, :email, :cle)";

		if ($stmt = $bdd->prepare($sql))
		{
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $stmt->bindParam(":cle", $cle, PDO::PARAM_STR);

            // Set parameters
            $param_username = $username;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            $cle = md5(microtime(TRUE)*100000);

            if ($stmt->execute())
                header("location: login.php");
			else
                echo "Something went wrong. Please try again later.";

            // Préparation du mail contenant le lien d'activation
            $sujet = "Activation de votre compte sur Camagru" ;
            // $entete = "From: inscription@camagru.com" ;
            $message = 'Bienvenue sur Camagru,

            Pour activer votre compte, veuillez cliquer sur le lien ci dessous
            ou copier/coller dans votre navigateur internet.

            http://localhost:8080/camagru/users/validation.php?log='.urlencode($username).'&cle='.urlencode($cle).'

            ---------------
            Ceci est un mail automatique, Merci de ne pas y répondre.';
            $message = wordwrap($message, 70, "\n");
            $headers = 'From: camagru@42.fr' . "\r\n" .
                    'Reply-To: camagru@42.fr' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
            mail($email, $sujet, $message, $headers) ;
        }
        // Close statement
        unset($stmt);
    }
    // Close connection
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
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input required type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
			<div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input required type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input required type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input required type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>
</body>
</html>