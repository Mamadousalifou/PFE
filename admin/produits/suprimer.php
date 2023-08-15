<?php 
//echo "Id de produit ".$_GET['idp'];

$idproduit = $_GET['idp'];

 include "../../inc/functions.php";

 $conn= connect();

$requette =" DELETE FROM produits WHERE id='$idproduit'";



 $resultat = $conn->query($requette);

 if($resultat){
  //  echo "produit suprimer";
         header('location:liste.php?delete=ok');
}



?>