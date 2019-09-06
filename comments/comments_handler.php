<?php
session_start();
require "../editing/image_class.php";
require "comments_class.php";

$image = new Image;

// echo json_encode("coucou");
if (isset($_POST['src']) && isset($_POST['content'])) {
	$filename = $_POST['src'];
	$imageId = $image->getImageId($filename);
	$userId = $image->findUserFromId($_SESSION["username"]);
	$content = $_POST['content'];
	echo json_encode($filename);
	echo json_encode($content);
}
else
	echo json_encode("error");

?>
