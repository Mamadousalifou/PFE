
<?php
session_start();


 include "inc/functions.php";
    $categories = getAllCategories();
    
    if(!empty($_POST)){
      //echo $_POST['Search'];
      $produits = searchProduits($_POST['Search']);
    }else{
      $produits = getAllproduits();
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
      <div class="row col-12 mt-4">
     <!-- #region -->
     <?php 

     foreach($produits as $produit){
      
      
      print '<div class="col-3 mt-2">
      <div class="card" style="width: 18rem;">
          <img src="imag/'.$produit['image'].'" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">'.$produit['nom'].'</h5>
            <p class="card-text">'.$produit['description'].'</p>
            <a href="produit.php?id='.$produit['id'].'" class="btn btn-primary">Afficher</a>
          </div>
        </div>
   </div>';


     }
     
     ?>

      </div>
      
     <?php 
       include "inc/footer.php";
     ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</html>