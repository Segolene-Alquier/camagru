<?php
// session_start();
require "user_class.php";

$user = new User();
$user->validation($_GET['log'], $_GET['cle']);
?>
