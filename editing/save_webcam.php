<?php
	session_start();
	require "image_class.php";
	$data = $_POST['data'];
	$image = new Image;
	$image->findUserFromId($_SESSION["username"]);
	$image->savePicture($data);
?>
