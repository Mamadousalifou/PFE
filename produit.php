
<?php
session_start();
 include "inc/functions.php";
    $categories = getAllCategories();
    
    if(isset($_GET['id'])){

      $produits=  getProduitById($_GET['id']);

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
      <?php if(isset($_SESSION['etat']) && $_SESSION['etat'] == 0){//utilisateur non valider
      print ' <div class="alert alert-danger">
     
             compte non validee
      </div>';

     }  ?>
    
       <div class="card col-8 offset-2" >
            <img src="imag/<?php echo $produits['image']?>" class="card-img-top" alt="...">
            <div class="card-body">
             <h5 class="card-title"><?php echo $produits['nom']?></h5>
             <p class="card-text"><?php echo $produits['description']?></p>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><?php echo $produits['prix']?> DH</li>
              <?php  
              foreach($categories as $index=> $c){
                
                if($c['id'] == $produits['categorie']){
print '<button class="btn btn-success mb-2">'. $c['nom'].'</li>';

                }

              }
              ?>
           
             
            </ul>
            <div class= "col-12 m-2">
      <form class= "d-flex" action="actions/commander.php" method="POST">

      <input type="hidden" value="<?php echo $produits['id']?>" name="produit" >
      <input type="number" clas="form-control" name="quantite" step="1" placeholder="Quantité de produit....." >
      <button type="submit" <?php if(isset($_SESSION['etat']) && $_SESSION['etat'] == 0 || !isset($_SESSION['etat'])){echo "disabled";}  ?> class="btn btn-primary">Commander</button>
      </form>
    </div>

      </div>
 
    </div>
      
    <?php 
       include "inc/footer.php";
     ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</html>