<?php 
Session_start();

//recuperation des données du formulaire
$id = $_POST['idc'];
$nom = $_POST['nom'];
$description = $_POST['description'];

$date_modification = date("Y-m-d");

//la chaine de connexion

include "../../inc/functions.php";
$conn = connect();

// creation de la resqutte
$requette = "UPDATE categories SET nom='$nom',description='$description',date_modification='$date_modification' WHERE id='$id '";

// execution de la requette

$resultat = $conn->query($requette);

if($resultat){
header('location:liste.php?modif=ok');

}


?>