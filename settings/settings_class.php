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

	function findEmail($username) {
		$username = htmlspecialchars(trim($username));
		$sql = "SELECT `Email` FROM `user` WHERE `Username` = :username";
		if ($stmt = $this->bdd->prepare($sql)) {
			$stmt->bindParam(':username', $username, PDO::PARAM_STR);
			if ($stmt->execute()) {
				if ($row = $stmt->fetch()) {
					$email = $row['Email'];
					return ($email);
				}

			}
		}
	}

	function modifyName($username, $old_name, $new_name) {
		$old_name = htmlspecialchars(trim($old_name));
		var_dump($old_name);
		$new_name = htmlspecialchars(trim($new_name));

		if ($username === $old_name) {
			var_dump($new_name);
			$sql = "SELECT COUNT(*) FROM `user` WHERE `username` = :new_name";
			if ($stmt = $this->bdd->prepare($sql)) {
				$stmt->bindParam(':new_name', $new_name, PDO::PARAM_STR);
				if ($stmt->execute())
				{
					var_dump($stmt->rowCount());
					if ($stmt->rowCount() < 1)
					{

						$stmt2 = $this->bdd->prepare("UPDATE `user` SET `username` = :new_name WHERE `Username` = :old_name");
						$stmt2->bindParam(':new_name', $new_name, PDO::PARAM_STR);
						$stmt2->bindParam(":old_name", $old_name, PDO::PARAM_STR);
						$stmt2->execute();
						$_SESSION['username'] = $new_name;
					}
					else
						echo "Oops! Something went wrong. Please try again later.";
				}
			}
		}
	}

	function modifyPassword($username, $old_password, $new_password) {
		$old_password = htmlspecialchars(trim($old_password));
		$new_password = htmlspecialchars(trim($new_password));
		$sql = "SELECT Passwd FROM `user` WHERE `Username` = :username";
		if ($stmt = $this->bdd->prepare($sql)) {
			$stmt->bindParam(":username", $username, PDO::PARAM_STR);
			if ($stmt->execute())
			{
				if ($stmt->rowCount() == 1)
				{
					if ($row = $stmt->fetch())
					{
						$hashed_password = $row["Passwd"];
						if (password_verify($old_password, $hashed_password))
						{
							$stmt = $this->bdd->prepare("UPDATE `user` SET `passwd` = :new_passwd WHERE `Username` = :username");
							$stmt->bindParam(':new_passwd', password_hash($new_password, PASSWORD_DEFAULT), PDO::PARAM_STR);
							$stmt->bindParam(":username", $username, PDO::PARAM_STR);
							$stmt->execute();
						}
					}
				}
			}
		}
	}

	function modifyMail($username, $old_mail, $new_mail) {
		$old_mail = htmlspecialchars(trim($old_mail));
		$new_mail = htmlspecialchars(trim($new_mail));
		$sql = "SELECT * FROM `user` WHERE `Username` = :username AND `email` = :email";
		if ($stmt = $this->bdd->prepare($sql)) {
			$stmt->bindParam(":username", $username, PDO::PARAM_STR);
			$stmt->bindParam(":email", $old_mail, PDO::PARAM_STR);
			if ($stmt->execute())
			{
				if ($stmt->rowCount() == 1)
				{
					if ($row = $stmt->fetch())
					{
						$stmt = $this->bdd->prepare("UPDATE `user` SET `email` = :new_email WHERE `Username` = :username");
						$stmt->bindParam(':new_email', $new_mail, PDO::PARAM_STR);
						$stmt->bindParam(":username", $username, PDO::PARAM_STR);
						$stmt->execute();
					}
				}
			}
		}
	}
}


?>
