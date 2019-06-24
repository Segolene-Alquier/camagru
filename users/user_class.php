<?php
Class User {

	private $bdd;
	private $username;
	private $email;
	private $password;
	private $confirm_password;
	public $username_err;
	public $email_err;
	public $password_err;



	function __construct(){
		// if (!include 'config/database.php')
            include '../config/database.php';
		session_start();
		try {
			$this->bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch (PDOException $e)
		{
			die('Erreur : ' . $e->getMessage());
		}
	}

	public function __get($property)
	{
		return $this->property;
	}

	public function __set($property, $value)
	{
		$this->property = $value;
	}

	function __destruct(){
		unset($this->bdd);
	}

	function	create_user($username, $email, $password, $confirm_password){

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
			$password_err = "Password must have at least 8 characters, one uppercase letter, one lowercase letter and one number.";
		else
			$this->password = trim($password);

		$this->confirm_password = trim($confirm_password);
		if (empty($password_err) && ($this->password != $this->confirm_password))
			$this->confirm_password_err = "Password did not match.";

		// Check input errors before inserting in database
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
}
?>
