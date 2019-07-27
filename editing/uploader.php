<!-- // $target_dir = "../uploads/".$user_id."/";
// 		if (!file_exists($target_dir))
// 			mkdir($target_dir, 0777, true);
// 		$target_file = $target_dir . basename($file_info["name"]);
// 		$uploadOk = 1;
// 		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// 		// Check if image file is a actual image or fake image
// 		if(isset($_POST["submit"])) {
// 			$check = getimagesize($file_info["tmp_name"]);
// 			if($check !== false) {
// 				echo "File is an image - " . $check["mime"] . ".";
// 				$uploadOk = 1;
// 			} else {
// 				echo "File is not an image.";
// 				$uploadOk = 0;
// 			}
// 		}
// 		// Check if file already exists
// 		if (file_exists($target_file)) {
// 			echo "Sorry, file already exists.";
// 			$uploadOk = 0;
// 		}
// 		// Check file size
// 		if ($file_info["size"] > 500000) {
// 			echo "Sorry, your file is too large.";
// 			$uploadOk = 0;
// 		}
// 		// Allow certain file formats
// 		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
// 		&& $imageFileType != "gif" ) {
// 			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
// 			$uploadOk = 0;
// 		}
// 		// Check if $uploadOk is set to 0 by an error
// 		if ($uploadOk === 0) {
// 			echo "Sorry, your file was not uploaded.";
// 		// if everything is ok, try to upload file
// 		} else {
// 			if (move_uploaded_file($file_info["tmp_name"], $target_file)) {
// 				echo "The file ". basename( $file_info["name"]). " has been uploaded.";
// 			} else {
// 				echo "Sorry, there was an error uploading your file.";
// 			}
// 		}
// 	}
 -->

<?php
session_start();
$message = '';
if (isset($_POST['uploadBtn']) && $_POST['uploadBtn'] == 'Upload')
{
  if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK)
  {
    // get details of the uploaded file
	$fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
	var_dump($fileTmpPath);
    $fileName = $_FILES['uploadedFile']['name'];
    $fileSize = $_FILES['uploadedFile']['size'];
    $fileType = $_FILES['uploadedFile']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
    // sanitize file-name
    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
    // check if file has one of the following extensions
    $allowedfileExtensions = array('jpg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc');
    if (in_array($fileExtension, $allowedfileExtensions))
    {
      // directory in which the uploaded file will be moved
      $uploadFileDir = '../uploads/';
	  $dest_path = $uploadFileDir . $newFileName;
	  var_dump($dest_path);

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
  }
  else
  {
    $message = 'There is some error in the file upload. Please check the following error.<br>';
    $message .= 'Error:' . $_FILES['uploadedFile']['error'];
  }
}
$_SESSION['message'] = $message;
// header("Location: index.php");
