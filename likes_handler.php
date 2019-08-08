<?php
session_start();
require "./editing/image_class.php";
// header("Content-Type: text/plain");

$image = new Image;
if (isset($_POST['filename'])) {
	$filename = $_POST['filename'];
	// $filename =
	var_dump($filename);

	$imageId = $image->getImageId($filename); // NULLL
	$userId = $image->findUserFromId($_SESSION["username"]);
	if (isset($imageId))
		$image->likeImage($userId, $imageId);
	var_dump($imageId);
	var_dump($userId);

}
?>
