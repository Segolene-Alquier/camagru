<?php
	$DB_DSN = 'mysql:dbname=camagru;host=127.0.0.1';
	$DB_USER = 'root';
	$DB_PASSWORD = 'Rootmysql';
	try {
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch (PDOException $e)
	{
		die('Erreur : ' . $e->getMessage());
	}
?>
