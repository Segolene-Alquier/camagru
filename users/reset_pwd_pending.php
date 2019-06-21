<?php
	session_start();
	echo "<h1>Please check your emails, we sent you a link to reset your password.</h1>";
	echo "<p>If you changed your mind, <a href='login.php'>return to login page.</a></p>";

	// Préparation du mail contenant le lien d'activation
	$sujet = "Activation de votre compte sur Camagru" ;
	// $entete = "From: inscription@camagru.com" ;
	$message = 'Bienvenue sur Camagru,

	Pour activer votre compte, veuillez cliquer sur le lien ci dessous
	ou copier/coller dans votre navigateur internet.

	http://localhost:8080/camagru/users/validation.php?log='.urlencode($username).'&cle='.urlencode($cle).'

	---------------
	Ceci est un mail automatique, Merci de ne pas y répondre.';
	$message = wordwrap($message, 70, "\n");
	$headers = 'From: camagru@42.fr' . "\r\n" .
			'Reply-To: camagru@42.fr' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();
	mail($email, $sujet, $message, $headers) ;
?>
