<?php
	session_start();
	require "user_class.php";

	$user = new User();
    $user->logout($_SESSION["username"]);
?>
