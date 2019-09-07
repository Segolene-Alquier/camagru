<?php
session_start();
require "../editing/image_class.php";
require "comments_class.php";

$image = new Image;
$comment = new Comment;

if (isset($_POST['file']) || isset($_POST["logged"])) {
	if (isset($_POST['file']) ) {
		if (!isset($_SESSION["username"]))
			echo json_encode("error");
		$filename = $_POST['file'];
		$imageId = $image->getImageId($filename);
		$allComments = $comment->displayComments($imageId);
		echo json_encode($allComments);
	}
	if (isset($_POST["logged"])) {
		if (isset($_SESSION["username"]))
			echo json_encode("logged");
		else
			echo json_encode("error");
	}
}
else {
	if (isset($_POST['src']) && isset($_POST['content'])) {
		$filename = $_POST['src'];
		$imageId = $image->getImageId($filename);
		$userId = $image->findUserFromId($_SESSION["username"]);
		$content = $_POST['content'];
		$comment->addCommentToDB($content, $imageId, $userId);
		// echo json_encode($imageId);
		// echo json_encode($userId);
		// echo json_encode($content);
		// echo json_encode($comment);
	}
	else
		echo json_encode("error");
}


// if (!isset($_SESSION["username"]))
// 	echo json_encode("error");
?>
