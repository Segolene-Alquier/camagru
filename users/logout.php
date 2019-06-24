<?php
	require "user_class.php";

	$user = new User();
    $user->logout($_SESSION["username"]);
?>
