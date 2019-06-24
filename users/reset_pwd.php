<?php
session_start();

// Check if the user is logged in, if not then redirect to login page
// if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
//     header("location: login.php");
//     exit;
// }

require_once "../config/database.php";

$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";

if (isset($_SESSION['email']))
$email = $_SESSION['email'];
else
{
$_SESSION['email'] = $_GET['email'];
$email = $_SESSION['email'];
}
if (!isset($_SESSION['reset']))
$_SESSION['reset'] = $_GET['reset'];

// checking if email and reset match
$stmt = $this->bdd->prepare("SELECT `reset`, email FROM user WHERE email = :email");
if ($stmt->execute(array(':email' => $email)) && $row = $stmt->fetch())
{
$resetbdd = $row['reset'];
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
            <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                <label>New Password</label>
                <input type="password" name="new_password" class="form-control" value="<?php echo $new_password; ?>">
                <span class="help-block"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a class="btn btn-link" href="./../index.php">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
