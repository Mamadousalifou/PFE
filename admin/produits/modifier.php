<?php 
Session_start();

//recuperation des données du formulaire
$id = $_POST['idp'];
$nom = $_POST['nom'];
$prix = $_POST['prix'];
$image = $_POST['image'];
$description = $_POST['description'];

$date_modification = date("Y-m-d");

//la chaine de connexion

include "../../inc/functions.php";
$conn = connect();

// creation de la resqutte
$requette = "UPDATE produits SET nom='$nom',prix='$prix',image='$image',description='$description',date_modification='$date_modification' WHERE id='$id '";

// execution de la requette

$resultat = $conn->query($requette);

if($resultat){
header('location:liste.php?modif=ok');

}


?>