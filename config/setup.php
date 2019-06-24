<?php
	require_once 'database.php';

	$reponse = $bdd->query('SELECT * FROM user');
	$reponse->closeCursor();
?>
