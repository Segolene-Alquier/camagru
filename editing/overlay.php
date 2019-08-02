<?php
session_start();
require "image_class.php";
if (isset($_POST['filter']))
{
	$namejs = json_decode($_POST['filter']);
	var_dump($namejs);
	echo "Data is :".$namejs->data;
}
else
	echo "nope";


// if (isset($_POST['chosen']))
// {
// 	$filter = $_POST['chosen'];
// 	echo $filter;
// }
// else
// 	echo "nothing";
// $src = $_POST['data']; // upload ou webcam
// $dest = "montage.jpg";
// $filter = $_POST['filter'];
// $image = new Image;
// $image->findUserFromId($_SESSION["username"]);
// $image->overlay($src, $dest, $filter);
?>
