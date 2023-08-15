<?php 

Session_start();

//recuperation des données du formulaire

$nom = $_POST['nom'];
$description = $_POST['description'];
$prix = $_POST['prix'];
$createur = $_POST['createur'];
$categorie = $_POST['categorie'];
$quantite =$_POST['quantite'];
$date_creation= date('Y-m-d');
//upload image 

$target_dir = "../../imag/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);

if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    $image = $_FILES["image"]["name"];

} else {
    echo "Sorry, there was an error uploading your file.";
  }
$date = date ('Y-m-d');  

//la chaine de connexion

include "../../inc/functions.php";
$conn = connect();

// creation de la resqutte
$requette = "INSERT INTO produits(nom,description,prix,image,createur,categorie, date_creation ) VALUES  ('$nom','$description','$prix','$image','$createur','$categorie','$date')";

// execution de la requette

$resultat = $conn->query($requette);


if($resultat){

  $prduit_id= $conn->lastInsertId();

$requette2 = "INSERT INTO stock(produit,quantite,createur,date_creation ) VALUES  ('$prduit_id','$quantite','$createur','$date_creation')";

    if($conn->query($requette2)){
       header('location:liste.php?ajout=ok');
     }else{

  echo "impossible d'ajouter le stock du produit";
}


}

?>