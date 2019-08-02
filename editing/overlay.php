<?php
session_start();
require "image_class.php";
// $namejs = $_GET["name"];
// var_dump($namejs);

if (isset($_POST['chosen']))
{
	$filter = $_POST['chosen'];
	echo $filter;
}
else
	echo "nothing";
// $src = $_POST['data']; // upload ou webcam
// $dest = "montage.jpg";
// $filter = $_POST['filter'];
// $image = new Image;
// $image->findUserFromId($_SESSION["username"]);
// $image->overlay($src, $dest, $filter);
?>
