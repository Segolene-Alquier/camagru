<?php

Class Setting {

	private $bdd;
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

	function modifyName() {


	}

	function modifyPassword($username, $old_password, $new_password) {
//  on verifique que le old password est bien celui enregistre

			if (!preg_match ("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $new_password))
				$this->new_password_err = "Password must have at least 8 characters, one uppercase letter, one lowercase letter and one number.";
			else
				$old_password = trim($old_password);
			$new_password = trim($new_password);

			if (empty($this->new_password_err) && ($old_password != $new_password))
				$this->confirm_password_err = "Password did not match.";

			if(empty($this->new_password_err) && empty($this->confirm_password_err))
			{
				$sql = "UPDATE user SET passwd = :password WHERE Username = :username";
				if($stmt = $this->bdd->prepare($sql))
				{
					$stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
					$stmt->bindParam(":username", $username, PDO::PARAM_INT);
					// Set parameters
					$param_password = password_hash($old_password, PASSWORD_DEFAULT);

					if($stmt->execute())
						echo "Your password was successfully modified!";
					else
						echo "Oops! Something went wrong. Please try again later.";
				}
			}

	}

	function modifyMail() {


	}
}


?>
