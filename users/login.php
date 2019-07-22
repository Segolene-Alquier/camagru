<?php
require "user_class.php";

session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header ("location: ./../index.php");
    exit;
}



// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $user = new User();
    $user->login($_POST['username'], $_POST['password']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
            <div class="form-group <?php echo (!empty($user->username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input required type="text" name="username" class="form-control" value="">
                <?php if (isset($user)) {?>
                <span class="help-block"><?php echo $user->username_err; ?></span>
                <?php }; ?>
            </div>
            <div class="form-group <?php echo (!empty($user->password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input required type="password" name="password" class="form-control">
                <?php if (isset($user)) {?>
                <span class="help-block"><?php echo $user->password_err; ?></span>
                <?php }; ?>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Can't remember your password? <a href="reset_pwd_pending.php">Change it</a>.</p>
            <p>Don't have an account? <a href="create_user.php">Sign up now</a>.</p>
        </form>
    </div>
</body>
</html>
