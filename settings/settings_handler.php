<?php
session_start();
require "settings_class.php";

$user = new Setting;
if (isset($_POST['newmail']) && isset($_POST['oldmail'])) {
	$user->modifyMail($_SESSION['username'], $_POST['oldmail'], $_POST['newmail']);
	// echo json_encode("coucou");
}
elseif (isset($_POST['newname']) && isset($_POST['oldname'])) {
	$user->modifyName($_SESSION['username'], $_POST['oldname'], $_POST['newname']);

	// echo json_encode("yo");
}
?>
