<?php
require "user_class.php";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $user = new User();
    $user->create_user($_POST['username'], $_POST['email'], $_POST['password'], $_POST['confirm_password']);
    var_dump($user);
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
            <div class="form-group <?php echo (!empty($user->username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input required type="text" name="username" class="form-control" value="">
                <?php if (isset($user)) {?>
                <span class="help-block"><?php echo $user->username_err; ?></span>
                <?php }; ?>
            </div>
			<div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input required type="text" name="email" class="form-control" value="">
                <?php if (isset($user)) {?>
                <span class="help-block"><?php echo $user->email_err; ?></span>
                <?php }; ?>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input required type="password" name="password" class="form-control" value="">
                <?php if (isset($user)) {?>
                <span class="help-block"><?php echo $user->password_err; ?></span>
                <?php }; ?>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input required type="password" name="confirm_password" class="form-control" value="">
                <?php if (isset($user)) {?>
                <span class="help-block"><?php echo $user->confirm_password_err; ?></span>
                <?php }; ?>
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
