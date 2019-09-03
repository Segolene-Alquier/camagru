<?php

Class Like {
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

	function isLiked($user_id, $image_id) {
		$sql = "SELECT id FROM liked_photos WHERE user_id = :user_id AND image_id = :image_id";
		if ($stmt = ($this->bdd->prepare($sql))) {
			$stmt->bindParam(":user_id", $userId, PDO::PARAM_STR);
			$stmt->bindParam(":image_id", $imageId, PDO::PARAM_STR);
			if ($stmt->execute()) {
				if ($stmt->fetch())
					return (true);
				else
					return (false);
			}
		}
	}

	function likeImage($userId, $imageId) {
		$sql = "INSERT INTO `liked_photos` (user_id, image_id) VALUES (:user_id, :image_id)";
		if ($stmt = $this->bdd->prepare($sql))
		{
			$stmt->bindParam(":user_id", $userId, PDO::PARAM_STR);
			$stmt->bindParam(":image_id", $imageId, PDO::PARAM_STR);
			// $stmt->bindParam(":date", $creationDate, PDO::PARAM_STR);
			if (!$stmt->execute())
				echo "oooops";
		}
	}

}
?>
