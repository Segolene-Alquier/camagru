<?php
session_start();
require "../editing/image_class.php";
require "comments_class.php";

$image = new Image;
$comment = new Comment;

// echo json_encode("coucou");
if (isset($_POST['src']) && isset($_POST['content'])) {
	$filename = $_POST['src'];
	$imageId = $image->getImageId($filename);
	$userId = $image->findUserFromId($_SESSION["username"]);
	$content = $_POST['content'];
	$comment->addCommentToDB($content, $imageId, $userId);
	echo json_encode($imageId);
	echo json_encode($userId);

	echo json_encode($content);
	// echo json_encode($comment);
}
else
	echo json_encode("error");

?>
