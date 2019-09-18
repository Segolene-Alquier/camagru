<?php
session_start();
require "settings_class.php";

$user = new Setting;
if (isset($_POST['mail']) && $_POST['mail'] == 0) {
	$user->modifyMail($_SESSION['username'], $_POST['old_mail'], $_POST['new_mail']);
	echo json_encode($bool);
}
// elseif (isset($_POST['clic'])) {
// 	$boolean = $_POST['clic'];
// 	$user->changeNotif($boolean, $_SESSION['username']);

// 	// echo json_encode($boolean);
// }
?>
