<?php

Class Image {

	private $bdd;

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

	function findUserFromId($username) {
		$sql = "SELECT UserID FROM user WHERE Username = :username";
		if ($stmt = $this->bdd->prepare($sql))
		{
			$stmt->bindParam(":username", $username, PDO::PARAM_STR);
			if ($stmt->execute())
			{
				if ($stmt->rowCount() == 1)
				{
					if ($row = $stmt->fetch())
					{
					// session_start();
					$id = $row["UserID"];
					$_SESSION['user_id']= $id;
					// var_dump($_SESSION['user_id']);
					}
				}
			}
			else
				echo "Oops! Something went wrong. Please try again later.";

		}
	}

	function upload() {
		$message = '';
		$user_id = $_SESSION['user_id'];
		// get details of the uploaded file
		$fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
		$fileName = $_FILES['uploadedFile']['name'];
		$fileSize = $_FILES['uploadedFile']['size'];
		$fileType = $_FILES['uploadedFile']['type'];
		$fileNameCmps = explode(".", $fileName);
		$fileExtension = strtolower(end($fileNameCmps));
		// sanitize file-name
		$newFileName = uniqid().".".$fileExtension;
		// $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
		$allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg');
		if (in_array($fileExtension, $allowedfileExtensions))
		{
		// directory in which the uploaded file will be moved
		$uploadFileDir = "../uploads/".$user_id."/tmp/";
		$dest_path = $uploadFileDir . $newFileName;
		if (!file_exists($uploadFileDir))
			mkdir($uploadFileDir, 0777, true);
			if(move_uploaded_file($fileTmpPath, $dest_path))
				$message ='File is successfully uploaded.';
			else
				$message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
		}
		else
		$message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
		header('Location: ./edit.php');
		// $_SESSION['message'] = $message;
	}



	function savePicture($img) {
		$user_id = $_SESSION['user_id'];
		$image_parts = explode(";base64,", $img);
		$image_type_aux = explode("image/", $image_parts[0]);
		$image_type = $image_type_aux[1];
		$image_en_base64 = base64_decode($image_parts[1]);
		$file_name = uniqid().".".$image_type;
		$filepath = "../uploads/".$user_id."/tmp/";
		if (!file_exists($filepath))
			mkdir($filepath, 0777, true);
		$file = $filepath . $file_name;
		$retour['$file']= $file;
		file_put_contents($file, $image_en_base64);
	}
}


?>
