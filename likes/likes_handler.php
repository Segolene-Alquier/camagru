<?php
session_start();
require "../editing/image_class.php";
require "likes_class.php";

$image = new Image;
$like = new Like;
if (isset($_POST['filename']) && isset($_SESSION["username"])) {
	$filename = $_POST['filename'];
	$imageId = $image->getImageId($filename); // NULL
	$userId = $image->findUserFromId($_SESSION["username"]);
	$isLiked = $like->isLiked($userId, $imageId);
	var_dump($isLiked);
	if (isset($imageId)) {
		if ($like->isLiked($userId, $imageId)){
			echo "deja like";
			$like->unlikeImage($userId, $imageId);
		}
		else {
			echo "pas deja like";
			$like->likeImage($userId, $imageId);
		}

	}
	// var_dump($imageId);
	// var_dump($userId);
	echo json_encode("true");
}
else
	echo json_encode("error");

?>
