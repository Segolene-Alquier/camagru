<?php
	$DB_DSN = 'mysql:dbname=camagru;host=127.0.0.1';
	$DB_USER = 'root';
	$DB_PASSWORD = 'Rootmysql';
	try {
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	}
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}
	$reponse = $bdd->query('SELECT * FROM user');
	while ($donnees = $reponse->fetch())
	{
		echo $donnees['UserID'];
		echo $donnees['Username'];
		echo $donnees['Passwd'];
		echo $donnees['Email'];

	}
?>
