<?php 
session_start();
 //test user connectée
if(!isset($_SESSION['nom'])){
  header('location:../connexion.php');
 exit();
}


// selectionner le produit avec leur id

  include "../inc/functions.php";

//connexion bd
 $conn=connect();


$visiteur=$_SESSON['id'];



 //var_dump($_POST);
$id_produit= $_POST['produit'];
 $quantite= $_POST['quantite'];




// requette
  $requette ="SELECT prix,nom FROM produits WHERE id='$id_produit '";

 // execution requette

  $resultat = $conn->query($requette);

  $produit = $resultat->fetch();

  $total = $quantite * $produit['prix'];

  $date = date('Y-m-d');

  if(!isset($_SESSION['panier'])){//panier n'exite pas 
    $_SESSION['panier'] = array($visiteur , 0 , $date , array() ) ;//creation d'un panier
  }

 $_SESSION['panier'][1]+=  $total;
 $_SESSION['panier'][3][]=array($quantite , $total , $date , $date , $id_produit,  $produit['nom']);

 

header('location:../panier.php');

?> 