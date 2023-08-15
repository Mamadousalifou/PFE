<?php 
Session_start();

//recuperation des données du formulaire
$id = $_POST['idstock'];
$quantite = $_POST['quantite'];


//la chaine de connexion

include "../../inc/functions.php";
$conn = connect();

// creation de la resqutte
$requette = "UPDATE stock SET quantite='$quantite' WHERE id='$id '";

// execution de la requette

$resultat = $conn->query($requette);

if($resultat){
header('location:liste.php?modif=ok');

}


?>