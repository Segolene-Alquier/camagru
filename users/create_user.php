<?php
require "user_class.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $user = new User();
    $user->create_user($_POST['username'], $_POST['email'], $_POST['password'], $_POST['confirm_password']);
    // var_dump($user);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="../camagru.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css">
    <script src="https://kit.fontawesome.com/82e513fc69.js"></script>
</head>
<body>
    <?php include_once '../navigation.php'; ?>
    <div class="block">
        <div class="container ">
            <div class="columns">
                <div class="column is-half form-wrapper">
                    <div class="box card-title">
                        <h2 class="form-title title">Sign Up</h2>
                    </div>
                    <div class="box">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="control">
                            <div class="field <?php echo (!empty($user->username_err)) ? 'has-error' : ''; ?>">
                                <label class="label">Username</label>
                                <div class="control has-icons-left has-icons-right">
                                    <input required type="text" name="username" class="input" value="">
                                    <!-- <input class="input is-success" type="text" placeholder="Text input" value="bulma"> -->
                                    <span class="icon is-small is-left">
                                    <i class="fas fa-user"></i>
                                    </span>
                                </div>
                                <?php if (isset($user)) {?>
                                <span class="help-block"><?php echo $user->username_err; ?></span>
                                <?php }; ?>
                            </div>
                            <div class="field <?php echo (!empty($user->email_err)) ? 'has-error' : ''; ?>">
                                <label class="label">Email</label>
                                <div class="control has-icons-left has-icons-right">
                                    <input required type="text" name="email" class="input" value="">
                                    <span class="icon is-small is-left">
                                    <i class="fas fa-envelope"></i>
                                    </span>
                                </div>
                                <?php if (isset($user)) {?>
                                <span class="help-block"><?php echo $user->email_err; ?></span>
                                <?php }; ?>
                            </div>
                            <div class="field <?php echo (!empty($user->password_err)) ? 'has-error' : ''; ?>">
                                <label class="label">Password</label>
                                <div class="control has-icons-left has-icons-right">
                                    <input required type="password" name="password" class="input" value="">
                                    <span class="icon is-small is-left">
                                    <i class="fas fa-key"></i>
                                    </span>
                                </div>
                                <?php if (isset($user)) {?>
                                <span class="help-block"><?php echo $user->password_err; ?></span>
                                <?php }; ?>
                            </div>
                            <div class="field <?php echo (!empty($user->confirm_password_err)) ? 'has-error' : ''; ?>">
                                <label class="label">Confirm Password</label>
                                <div class="control has-icons-left has-icons-right">
                                    <input required type="password" name="confirm_password" class="input" value="">
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
                                <input type="reset" class="button is-text" value="Reset">
                            </div>
                            <p>Already have an account? <a href="login.php">Login here</a>.</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
   	</div>
</body>
</html>
