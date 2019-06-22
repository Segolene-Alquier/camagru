<?php
session_start();

// if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
//     header ("location: ./../index.php");
//     exit;
// }

require_once "../config/database.php";

$login = $_GET['log'];
$cle = $_GET['cle'];

// Récupération de la clé correspondant au $login dans la base de données
$stmt = $bdd->prepare("SELECT cle, confirmed FROM user WHERE Username like :login ");
if ($stmt->execute(array(':login' => $login)) && $row = $stmt->fetch())
{
    $clebdd = $row['cle'];
    $actif = $row['confirmed'];
}

if ($actif == '1')
    echo "Your account is already active!";
else
{
    if ($cle == $clebdd)
    {
    	echo "Your account has been successfully activated!";

        $stmt = $bdd->prepare("UPDATE user SET confirmed = 1 WHERE username like :login ");
        $stmt->bindParam(':login', $login);
        $stmt->execute();
    }
    else
        echo "Erreur ! Votre compte ne peut être activé...";
}
unset($stmt);
unset($bdd);
?>
