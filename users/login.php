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
    <link rel="stylesheet" type="text/css" href="../camagru.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css">
    <script src="https://kit.fontawesome.com/82e513fc69.js"></script>
</head>
<body>
    <?php include_once '../navigation.php'; ?>
    <div class="block">
        <div class="container">
            <div class="columns">
                <div class="column is-half form-wrapper" >
                    <div class="box card-title">
                        <h2 class="form-title title">Login</h2>
                    </div>
                    <div class="box">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="control">
                            <div class="field <?php echo (!empty($user->username_err)) ? 'has-error' : ''; ?>">
                                <label class="label">Username</label>
                                <div class="control has-icons-left has-icons-right">
                                    <input required type="text" name="username" class="input" value="">
                                    <span class="icon is-small is-left">
                                    <i class="fas fa-user"></i>
                                    </span>
                                </div>
                                <?php if (isset($user)) {?>
                                <span class="help-block"><?php echo $user->username_err; ?></span>
                                <?php }; ?>
                            </div>
                            <div class="field <?php echo (!empty($user->password_err)) ? 'has-error' : ''; ?>">
                                <label class="label">Password</label>
                                <div class="control has-icons-left has-icons-right">
                                    <input required type="password" name="password" class="input">
                                    <span class="icon is-small is-left">
                                    <i class="fas fa-envelope"></i>
                                    </span>
                                </div>
                                <?php if (isset($user)) {?>
                                <span class="help-block"><?php echo $user->password_err; ?></span>
                                <?php }; ?>
                            </div>
                            <div class="field">
                                <input type="submit" class="button is-link" value="Login">
                            </div>
                            <p>Can't remember your password? <a href="reset_pwd_pending.php">Change it</a>.</p>
                            <p>Don't have an account? <a href="create_user.php">Sign up now</a>.</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>

</body>
</html>
