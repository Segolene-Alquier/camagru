<?php
	require_once 'database.php';

	$reponse = $bdd->query('SELECT * FROM user');
	while ($donnees = $reponse->fetch())
	{
		echo $donnees['UserID'];
		echo $donnees['Username'];
		echo $donnees['Passwd'];
		echo $donnees['Email'];

	}
	$reponse->closeCursor();
?>
