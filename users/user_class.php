<?php
Class User {

	private $bdd;
	private $username;
	private $email;
	private $password;
	private $new_password;
	private $confirm_password;
	public $username_err;
	public $email_err;
	public $password_err;
	public $new_password_err;
	public $confirm_password_err;


	function __construct(){
		// if (!include 'config/database.php')
        	include '../config/database.php';
		// session_start();
		try {
			$this->bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch (PDOException $e)
		{
			die('Erreur : ' . $e->getMessage());
		}
	}

	public function __get($property) {
		return $property;
	}

	public function __set($property, $value) {
		$this->property = $value;
	}

	function __destruct() {
		unset($this->bdd);
	}

	function	create_user($username, $email, $password, $confirm_password) {

		$sql = "SELECT UserID FROM user WHERE username= :username";
		if ($stmt = $this->bdd->prepare($sql))
		{
			$stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
			$param_username = trim($username);
			if ($stmt->execute())
			{
				if ($stmt->rowCount() == 1)
					$this->username_err = "This username is already taken.";
				else
					$this->username = trim($username);
			}
			else
				echo "Oops! Something went wrong. Please try again later.";
		}
		unset($stmt);

		if (!filter_var($email, FILTER_VALIDATE_EMAIL))
			$this->email_err = "Email must be a valid email.";
		else
		{
			$sql = "SELECT UserID FROM user WHERE email=:email";
			if ($stmt = $this->bdd->prepare($sql))
			{
				$stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
				$param_email = trim($email);
				if ($stmt->execute())
				{
					if ($stmt->rowCount() >= 1)
						 $this->email_err = "This email is alrady taken.";
					else
						$this->email = trim($email);
				}
				else
					echo "Oops! Something went wrong. Please try again later.";
			}
			unset($stmt);
		}

		if (!preg_match ("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $password))
			$this->password_err = "Password must have at least 8 characters, one uppercase letter, one lowercase letter and one number.";
		else
			$this->password = trim($password);

		$this->confirm_password = trim($confirm_password);
		if (empty($this->password_err) && ($this->password != $this->confirm_password))
			$this->confirm_password_err = "Password did not match.";

		if (empty($this->username_err) && empty($this->email_err) && empty($this->password_err) && empty($this->confirm_password_err))
		{
			$sql = "INSERT INTO user (Username, Passwd, Email, Cle) VALUES (:username, :password, :email, :cle)";
			if ($stmt = $this->bdd->prepare($sql))
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
			unset($stmt);
		}
	}

	function	validation($login, $cle) {
		$stmt = $this->bdd->prepare("SELECT cle, confirmed FROM user WHERE Username like :login ");
		if ($stmt->execute(array(':login' => $login)) && $row = $stmt->fetch())
		{
			$clebdd = $row['cle'];
			$actif = $row['confirmed'];
		}
		if ($actif == '1')
			echo "Your account is already active!";
		else
		{
			if ($cle == $clebdd)
			{
				echo "Your account has been successfully activated!";
				$stmt = $this->bdd->prepare("UPDATE user SET confirmed = 1 WHERE username like :login ");
				$stmt->bindParam(':login', $login);
				$stmt->execute();
			}
			else
				echo "Error ! Your account cannot be activated...";
		}
		unset($stmt);
	}

	function	login($username, $password) {
    	$this->username = htmlspecialchars(trim($username));
        $this->password = htmlspecialchars(trim($password));

		if (empty($this->username_err) && empty($this->password_err))
		{
			$sql = "SELECT UserID, Username, Passwd, Confirmed FROM user WHERE Username = :username";
			if ($stmt = $this->bdd->prepare($sql))
			{
				$stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
				$param_username = trim($this->username);
				if ($stmt->execute())
				{
					if ($stmt->rowCount() == 1)
					{
						if ($row = $stmt->fetch())
						{
							$id = $row["UserID"];
							$this->username = $row["Username"];
							$hashed_password = $row["Passwd"];
							if (password_verify($this->password, $hashed_password) && $row["Confirmed"] == 1)
							{
								session_start();
								$_SESSION["loggedin"] = true;
								$_SESSION["id"] = $id;
								$_SESSION["username"] = $username;
								header("location: ./../index.php");
							}
							else
							{
								if ($row["Confirmed"] == 0)
									echo "Oops! You haven't activated your account yet, please check your emails.";
								else
									$this->password_err = "The password you entered was not valid.";
							}
						}
					}
					else
						$this->username_err = "No account found with that username.";
				}
				else
					echo "Oops! Something went wrong. Please try again later.";
			}
			unset($stmt);
		}
	}

	function	logout($username) {
		unset($username);
		session_destroy();
		header("location: ../index.php");
		exit;
	}

	function	reset_pwd_pending($email) {
		$sql = "SELECT Email FROM user WHERE Email = :email";
		if ($stmt = $this->bdd->prepare($sql))
		{
			$stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
			$param_email = trim($email);

			if ($stmt->execute())
			{
				if ($stmt->rowCount() >= 1)
					$this->email = trim($email);
				else
					$this->email_err = "The email address dosen't have an account yet.";
			}
			else
				echo "Oops! Something went wrong. Please try again later.";
		unset($stmt);
		}
		$sql = "UPDATE user SET `Reset`= :reset WHERE Email = :email";
		if (!$this->email_err && $stmt = $this->bdd->prepare($sql))
		{
			$this->email_sent = "Please check your email box, we sent you the link to reset your password";
			$stmt->bindParam(":reset", $reset, PDO::PARAM_STR);
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$reset = md5(microtime(TRUE)*100000);
			if ($stmt->execute())
			{
				$sujet = "Reset your password on Camagru" ;
				$message = 'Hello,

				Looks like you forgot your password... It happens, no worries!
				You can click on the following link in order to choose a new password:

				http://localhost:8080/camagru/users/reset_pwd.php?email='.urlencode($email).'&reset='.urlencode($reset).'

				---------------
				Ceci est un mail automatique, Merci de ne pas y répondre.';
				$message = wordwrap($message, 70, "\n");
				$headers = 'From: camagru@42.fr' . "\r\n" .
						'Reply-To: camagru@42.fr' . "\r\n" .
						'X-Mailer: PHP/' . phpversion();
				mail($email, $sujet, $message, $headers) ;
			}
			else
				echo "Something went wrong. Please try again later.";
		}
		unset($stmt);
	}

	function	reset_pwd($email, $new_password, $confirm_password) {
		$this->email = $email;
		$resetbdd = "";

		// checking if email and reset match
		$stmt = $this->bdd->prepare("SELECT `reset`, email FROM user WHERE email = :email");
		if ($stmt->execute(array(':email' => $this->email)) && $row = $stmt->fetch())
			$resetbdd = $row['reset'];

		// Validate new password
		if (!preg_match ("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $new_password))
			$this->new_password_err = "Password must have at least 8 characters, one uppercase letter, one lowercase letter and one number.";
		else
			$this->new_password = trim($new_password);
		// Validate confirm password
		$this->confirm_password = trim($confirm_password);

		if (empty($this->new_password_err) && ($this->new_password != $this->confirm_password))
			$this->confirm_password_err = "Password did not match.";

		// Check input errors before updating the database
		if(empty($this->new_password_err) && empty($this->confirm_password_err) && $resetbdd)
		{
			// Prepare an update statement
			$sql = "UPDATE user SET passwd = :password WHERE Email = :email";
			if($stmt = $this->bdd->prepare($sql))
			{
				// Bind variables to the prepared statement as parameters
				$stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
				$stmt->bindParam(":email", $email, PDO::PARAM_INT);
				// Set parameters
				$param_password = password_hash($this->new_password, PASSWORD_DEFAULT);
				$email = $this->email;

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

	function wantsNotif($username) {
		$sql = "SELECT `notification` FROM `user` WHERE `username` = :username";
		if ($stmt = $this->bdd->prepare($sql)) {
			$stmt->bindParam(":username", $username, PDO::PARAM_STR);
			$stmt->execute();
			$result = $stmt->fetch();
			return ($result[0]);
		}

	}

	function changeNotif($boolean, $username) {
		$sql = "UPDATE `user` SET `notification` = :bool WHERE `username` = :username";
		if ($stmt = $this->bdd->prepare($sql)) {
			$stmt->bindParam(":bool", $boolean, PDO::PARAM_STR);
			$stmt->bindParam(":username", $username, PDO::PARAM_STR);
			if (!$stmt->execute()) {
				echo "Oops! Something went wrong. Please try again later.";

			}
		}

	}
}
?>
