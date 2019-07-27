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
	// 	$target_dir = "../uploads/".$user_id."/";
	// 	if (!file_exists($target_dir))
	// 		mkdir($target_dir, 0777, true);
	// 	$target_file = $target_dir . basename($file_info["name"]);
	// 	$uploadOk = 1;
	// 	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	// 	// Check if image file is a actual image or fake image
	// 	if(isset($_POST["submit"])) {
	// 		$check = getimagesize($file_info["tmp_name"]);
	// 		if($check !== false) {
	// 			echo "File is an image - " . $check["mime"] . ".";
	// 			$uploadOk = 1;
	// 		} else {
	// 			echo "File is not an image.";
	// 			$uploadOk = 0;
	// 		}
	// 	}
	// 	// Check if file already exists
	// 	if (file_exists($target_file)) {
	// 		echo "Sorry, file already exists.";
	// 		$uploadOk = 0;
	// 	}
	// 	// Check file size
	// 	if ($file_info["size"] > 500000) {
	// 		echo "Sorry, your file is too large.";
	// 		$uploadOk = 0;
	// 	}
	// 	// Allow certain file formats
	// 	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	// 	&& $imageFileType != "gif" ) {
	// 		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	// 		$uploadOk = 0;
	// 	}
	// 	// Check if $uploadOk is set to 0 by an error
	// 	if ($uploadOk === 0) {
	// 		echo "Sorry, your file was not uploaded.";
	// 	// if everything is ok, try to upload file
	// 	} else {
	// 		if (move_uploaded_file($file_info["tmp_name"], $target_file)) {
	// 			echo "The file ". basename( $file_info["name"]). " has been uploaded.";
	// 		} else {
	// 			echo "Sorry, there was an error uploading your file.";
	// 		}
	// 	}
			$message = '';
			$user_id = $_SESSION['user_id'];
			// get details of the uploaded file
			$fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
			// var_dump($fileTmpPath);
			$fileName = $_FILES['uploadedFile']['name'];
			$fileSize = $_FILES['uploadedFile']['size'];
			$fileType = $_FILES['uploadedFile']['type'];
			$fileNameCmps = explode(".", $fileName);
			$fileExtension = strtolower(end($fileNameCmps));
			// sanitize file-name
			$newFileName = md5(time() . $fileName) . '.' . $fileExtension;
			// check if file has one of the following extensions
			$allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg');
			if (in_array($fileExtension, $allowedfileExtensions))
			{
			// directory in which the uploaded file will be moved
			$uploadFileDir = "../uploads/".$user_id."/";
			$dest_path = $uploadFileDir . $newFileName;
			if (!file_exists($dest_path))
				mkdir($uploadFileDir, 0777, true);
				// var_dump($fileTmpPath);

			// var_dump($dest_path);

				if(move_uploaded_file($fileTmpPath, $dest_path))
				{
					$message ='File is successfully uploaded.';
				}
				else
				{
					$message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
				}
			}
			else
			{
			$message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
			}

		// $_SESSION['message'] = $message;
	}

}

?>
