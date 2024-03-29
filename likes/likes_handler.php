<?php
session_start();
require "../editing/image_class.php";
require "likes_class.php";

$image = new Image;
$like = new Like;
if (isset($_POST['isLiked'])) {
	if (!isset($_SESSION["username"])) {
		echo json_encode("error");
		exit();
	}
	$filename = $_POST['isLiked'];
	$imageId = $image->getImageId($filename);
	$userId = $image->findUserFromId($_SESSION["username"]);
	$isLiked = $like->isLiked($userId, $imageId);
	echo json_encode($isLiked);
}
else {
	if (isset($_POST['filename']) && isset($_SESSION["username"])) {
		$filename = $_POST['filename'];
		$imageId = $image->getImageId($filename);
		$userId = $image->findUserFromId($_SESSION["username"]);
		$isLiked = $like->isLiked($userId, $imageId);

		if (isset($imageId)) {
			if ($like->isLiked($userId, $imageId)){
				$like->unlikeImage($userId, $imageId);
			}
			else {
				$like->likeImage($userId, $imageId);
			}
		}
		echo json_encode("true");
	}
	else
		echo json_encode("error");
}
?>
