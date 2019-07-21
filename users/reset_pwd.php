<?php
session_start();

// Check if the user is logged in, if not then redirect to login page
// if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
//     header("location: login.php");
//     exit;
// }
require "user_class.php";

if (isset($_SESSION['email']))
    $email = $_SESSION['email'];
else
{
    $_SESSION['email'] = $_GET['email'];
    $email = $_SESSION['email'];
}

if (!isset($_SESSION['reset']))
    $_SESSION['reset'] = $_GET['reset'];

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $user = new User();
        var_dump($_POST['new_password']);
        $user->reset_pwd($email, $_POST['new_password'], $_POST['confirm_password']);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Reset Password</h2>
        <p>Please fill out this form to reset your password.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($user->new_password_err)) ? 'has-error' : ''; ?>">
                <label>New Password</label>
                <input required type="password" name="new_password" class="form-control" value="">
                <?php if (isset($user)) {?>
                <span class="help-block"><?php echo $user->new_password_err; ?></span>
                <?php }; ?>
            </div>
            <div class="form-group <?php echo (!empty($user->confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input required type="password" name="confirm_password" class="form-control">
                <?php if (isset($user)) {?>
                <span class="help-block"><?php echo $user->confirm_password_err; ?></span>
                <?php }; ?>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a class="btn btn-link" href="./../index.php">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
