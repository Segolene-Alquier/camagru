<?php
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header ("location: ./../index.php");
    exit;
}

require_once "../config/database.php";

$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    // Check if username is empty
    if (empty(trim($_POST["username"])))
        $username_err = "Please enter username.";
    else
        $username = trim($_POST["username"]);

    // Check if password is empty
    if (empty(trim($_POST["password"])))
        $password_err = "Please enter your password.";
    else
        $password = trim($_POST["password"]);
    // Validate credentials
	if (empty($username_err) && empty($password_err))
	{
        // Prepare a select statement
        $sql = "SELECT UserID, Username, Passwd FROM user WHERE Username = :username";

		if ($stmt = $bdd->prepare($sql))
		{
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
			if ($stmt->execute())
			{
                // Check if username exists, if yes then verify password
				if ($stmt->rowCount() == 1)
				{
					if ($row = $stmt->fetch())
					{
                        $id = $row["UserID"];
                        $username = $row["Username"];
                        $hashed_password = $row["Passwd"];
						if (password_verify($password, $hashed_password))
						{
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            header("location: ./../index.php");
						}
						else
                            $password_err = "The password you entered was not valid.";
                    }
				}
				else
                    $username_err = "No account found with that username.";
			}
			else
                echo "Oops! Something went wrong. Please try again later.";
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
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Can't remember your password? <a href="reset_pwd.php">Change it</a>.</p>
            <p>Don't have an account? <a href="create_user.php">Sign up now</a>.</p>
        </form>
    </div>
</body>
</html>
