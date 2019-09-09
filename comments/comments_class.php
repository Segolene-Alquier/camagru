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

	function addCommentToDB($content, $imageId, $userId, $username) {
		$sql = "INSERT INTO `comment` (content, image, user, username) VALUES (:content, :image_id, :user_id, :username)";
		if ($stmt = $this->bdd->prepare($sql)) {
			$stmt->bindParam(":content", $content, PDO::PARAM_STR);
			$stmt->bindParam(":user_id", $userId, PDO::PARAM_STR);
			$stmt->bindParam(":image_id", $imageId, PDO::PARAM_STR);
			$stmt->bindParam(":username", $username, PDO::PARAM_STR);
			if (!$stmt->execute())
				echo "Oops! Something went wrong. Please try again later.";
		}
		else
			echo "Oops! Something went wrong. Please try again later.";
	}

	function displayComments($imageId) {
		$sql = "SELECT * FROM `comment` WHERE image = :image_id";

		if ($stmt = $this->bdd->prepare($sql)) {
			$stmt->bindParam(":image_id", $imageId, PDO::PARAM_STR);
		}
		if ($stmt->execute()) {
			$allComments = [];
			while ($data = $stmt->fetch())
				array_push($allComments, $data);
			return ($allComments);
		}
		return (NULL);
	}

	function commentsCounter($imageId) {
		$sql = "SELECT COUNT(*) FROM `comment` WHERE image = :image_id";
		if ($stmt = $this->bdd->prepare($sql)) {
			$stmt->bindParam(":image_id", $imageId, PDO::PARAM_STR);
			$stmt->execute();
			$result = $stmt->fetch();
			return ($result[0]);
		}
	}
}
?>
