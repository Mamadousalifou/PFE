<?php 
Session_start();

//recuperation des données du formulaire

$nom = $_POST['nom'];
$description = $_POST['description'];
$createur = $_SESSION['id'];
$date_creation = date("Y-m-d");

//la chaine de connexion

include "../../inc/functions.php";
$conn = connect();

// creation de la resqutte
$requette = "INSERT INTO categories(nom,description,createur,date_creation ) VALUES  ('$nom','$description','$createur','$date_creation')";

// execution de la requette

$resultat = $conn->query($requette);

if($resultat){
header('location:liste.php?ajout=ok');

}


?>