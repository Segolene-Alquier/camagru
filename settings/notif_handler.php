<?php
session_start();
require "../users/user_class.php";

$user = new User;
if (isset($_POST['notif']) && $_POST['notif'] == 1) {
	$bool = $user->wantsNotif($_SESSION['username']);
	echo json_encode($bool);
}
elseif (isset($_POST['clic'])) {
	$boolean = $_POST['clic'];
	$user->changeNotif($boolean, $_SESSION['username']);

	// echo json_encode($boolean);
}
?>
