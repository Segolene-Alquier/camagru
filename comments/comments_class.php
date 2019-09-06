<?php

Class Comment {
	private $bdd;

	function __construct(){
		if (file_exists('config/database.php'))
			include 'config/database.php';
		else
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

	function addCommentToDB($content, $imageId, $userId) {
		// $sql = "INSERT INTO `comment` (`content`, `image`, `user`) WHERE (:content, :image_id, :user_id);";

		$sql = "INSERT INTO `comment` (content, image, user) VALUES (:content, :image_id, :user_id)";
		if ($stmt = $this->bdd->prepare($sql)) {
			$stmt->bindParam(":content", $content, PDO::PARAM_STR);
			$stmt->bindParam(":user_id", $userId, PDO::PARAM_STR);
			$stmt->bindParam(":image_id", $imageId, PDO::PARAM_STR);
			if ($stmt->execute()) {
				// exit();
			}
			else
				echo "Oops! Something went wrong. Please try again later.";
		}
		else
			echo "Oops! Something went wrong. Please try again later.";
	}
}
?>
