<?php
// session_start();
require "user_class.php";

// if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
//     header ("location: ./../index.php");
//     exit;
// }

$user = new User();
$user->validation($_GET['log'], $_GET['cle']);
?>
