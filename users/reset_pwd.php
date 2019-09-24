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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password</title>
    <link rel="stylesheet" type="text/css" href="../camagru.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css">
    <script src="https://kit.fontawesome.com/82e513fc69.js"></script></head>
<body>
    <?php include_once '../navigation.php'; ?>
        <div class="container form-container">
            <div class="column is-half form-wrapper">
                <div class="box card-title">
                    <h2 class="form-title title">Reset Password</h2>
                </div>
                <div class="box">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="control">
                        <div class="field <?php echo (!empty($user->new_password_err)) ? 'has-error' : ''; ?>">
                            <label class="label">New Password</label>
                            <div class="control has-icons-left has-icons-right">
                                <input required type="password" name="new_password" class="input" value="">
                                <span class="icon is-small is-left">
                                <i class="fas fa-key"></i>
                                </span>
                            </div>
                            <?php if (isset($user)) {?>
                            <span class="help-block"><?php echo $user->new_password_err; ?></span>
                            <?php }; ?>
                        </div>
                        <div class="field <?php echo (!empty($user->confirm_password_err)) ? 'has-error' : ''; ?>">
                            <label class="label">Confirm Password</label>
                            <div class="control has-icons-left has-icons-right">
                                <input required type="password" name="confirm_password" class="input">
                                <span class="icon is-small is-left">
                                <i class="fas fa-key"></i>
                                </span>
                            </div>
                            <?php if (isset($user)) {?>
                            <span class="help-block"><?php echo $user->confirm_password_err; ?></span>
                            <?php }; ?>
                        </div>
                        <div class="field">
                            <input type="submit" class="button is-link" value="Submit">
                            <a class="btn btn-link" href="./../index.php">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php include_once '../footer.php'; ?>
</body>
</html>
