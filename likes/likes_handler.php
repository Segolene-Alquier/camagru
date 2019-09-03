<?php
session_start();
require "../editing/image_class.php";
require "likes_class.php";

// header("Content-Type: text/plain");

$image = new Image;
$like = new Like;
if (isset($_POST['filename'])) {
	$filename = $_POST['filename'];
	echo json_encode(json.parse($filename));
	$imageId = $image->getImageId($filename); // NULL
	$userId = $image->findUserFromId($_SESSION["username"]);
	if (isset($imageId))
		$like->likeImage($userId, $imageId);
	var_dump($imageId);
	var_dump($userId);

}
?>
