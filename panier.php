
<?php
session_start();


 include "inc/functions.php";

 //var_dump($_SESSION['panier']);
 $total=0;
 if(isset( $_SESSION['panier'])){
    $total= $_SESSION['panier'][1];
 }

    $categories = getAllCategories();
    
    if(!empty($_POST)){
      //echo $_POST['Search'];
      $produits = searchProduits($_POST['Search']);
    }else{
      $produits = getAllproduits();
    }
   $commandes=array();
    if(isset($_SESSION['panier'])){

        if( count($_SESSION['panier'][3])>0){
            $commandes =$_SESSION['panier'][3];
            
        }
    }

    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>MS-SHOP</title>
</head>
<body>
    <?php
    include "inc/header.php";
    ?>
    <div class="row col-12 mt-4 p-5">
             <h1>Panier utilisateur</h1>
             <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Produit</th>
      <th scope="col">Quantité</th>
      <th scope="col">Total</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
   // var_dump($commandes);
      foreach($commandes as $index=>$commande){


        print'  <tr>
        <th scope="row">'.($index+1).'</th>
        <td>'.$commande[5].'</td>
        <td>'.$commande[0].' pieces</td>
        <td>'.$commande[1].' DTT</td>
        <td><a href="actions/enlever-produit-panier.php?id='.$index.'" class ="btn btn-danger">Suprimer</a></td>
      </tr>
      ';
      }

    ?> 

 
    
  </tbody>
</table>
<div class="text-end mt-3">
    <h3>Total : <?php echo $total ?> DTT</h3>
    <hr/>
    <a href="actions/valider_panier.php" class="btn btn-success" style="width:100px">Valider</a>


</div>
   
      </div>
      
     <?php 
       include "inc/footer.php";
     ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</html>