<?php 
session_start();
  include "../inc/functions.php";

  //connexion bd
   $conn=connect();
//id visiteur
$visiteur= $_SESSION['id'];
$total= $_SESSION['panier'][1];
$date =date('Y-m-d');

 //creation de panier

$requette_panier ="INSERT INTO panier(visiteur,total,date_creation) VALUES ('$visiteur','$total','$date')";

 // execution requette

$resultat = $conn->query($requette_panier);

 $panier_id=$conn->lastInsertId();


 $commandes = $_SESSION['panier'][3];
 foreach($commandes as $commande){
// //Ajouter commande 
//  // requette
$quantite=$commande[0];
$total=$commande[1];
$id_produit=$commande[4];

 $requette ="INSERT INTO  commandes(quantite,total,panier,produit,date_creation,date_modification) VALUES ('$quantite','$total',$panier_id,'$id_produit','$date','$date') ";

// // execution requette

  $resultat = $conn->query($requette);



 }
 //Suprimer la panier

 $_SESSION['panier']=null;
  //redirection vers la page index
 header('location:../index.php');


?>