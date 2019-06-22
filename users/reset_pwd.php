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
$stmt = $bdd->prepare("SELECT `reset`, email FROM user WHERE email = :email");
if ($stmt->execute(array(':email' => $email)) && $row = $stmt->fetch())
{
    $resetbdd = $row['reset'];
}
if ($_SESSION['reset'] === $resetbdd)
{
    // Processing form data when form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // Validate new password
        if (empty(trim($_POST["new_password"])))
            $password_err = "Please enter a password.";
        elseif (!preg_match ("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $_POST["new_password"]))
            $password_err = "Password must have at least 8 characters, one uppercase letter, one lowercase letter and one number.";
        else
            $password = trim($_POST["new_password"]);

        // Validate confirm password
        if (empty(trim($_POST["confirm_password"])))
            $confirm_password_err = "Please confirm password.";
        else
        {
            $confirm_password = trim($_POST["confirm_password"]);
            if (empty($password_err) && ($password != $confirm_password))
                $confirm_password_err = "Password did not match.";
        }
        // Check input errors before updating the database
        if(empty($new_password_err) && empty($confirm_password_err))
        {
            // Prepare an update statement
            $sql = "UPDATE user SET passwd = :password WHERE Email = :email";

            if($stmt = $bdd->prepare($sql))
            {
                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
                $stmt->bindParam(":email", $email, PDO::PARAM_INT);

                // Set parameters
                $param_password = password_hash($password, PASSWORD_DEFAULT);
                $email = $_SESSION['email'];

                if($stmt->execute())
                {
                    header("location: login.php");
                    exit();
                }
                else
                    echo "Oops! Something went wrong. Please try again later.";
            }
            unset($stmt);
        }
    }
    unset($bdd);
}
else
    echo "Oops! Something went wrong. Please try again later.";
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
