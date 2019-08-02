<?php
session_start();
require "image_class.php";
$src = $_POST['data']; // upload ou webcam
$dest = "montage.jpg";
$filter = $_POST['filter'];
$image = new Image;
$image->findUserFromId($_SESSION["username"]);
$image->overlay($src, $dest, $filter);
?>
