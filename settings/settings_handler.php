<?php
session_start();
require "settings_class.php";

$user = new Setting;
// echo json_encode($_POST['newmail']);
// echo json_encode($_POST['oldmail']);

if (isset($_POST['newmail']) && isset($_POST['oldmail'])) {
	$user->modifyMail($_SESSION['username'], $_POST['oldmail'], $_POST['newmail']);
	// echo json_encode("coucou");
}
elseif (isset($_POST['newname']) && isset($_POST['oldname'])) {
	$user->modifyName($_SESSION['username'], $_POST['oldname'], $_POST['newname']);
// 	$user->changeNotif($boolean, $_SESSION['username']);

	echo json_encode("yo");
}
?>
