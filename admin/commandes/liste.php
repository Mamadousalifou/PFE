<?php 
session_start();

include "../../inc/functions.php";

if(isset($_POST['btnSumit'])){

  changerEtatPanier($_POST);
}

$paniers= getAllPaniers();
$commandes= getAllCommandes();

if(isset($_POST['btnSearch'])){

if($_POST['etat']=="tout"){
  $paniers= getAllPaniers();
}else{
  $paniers= getPanierByEtat($paniers,$_POST['etat']);
}

}




?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.1/assets/img/favicons/favicon.ico">

    <title>Admin : profile </title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.1/examples/dashboard/">

    <!-- Bootstrap core CSS -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../../css/dashboard.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Company name</a>
      <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="../../deconnexion.php">Deconnexion</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
      <?php
 include "../template/navigateur.php";  

?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Liste des paniers</h1>
            

            
</div>
<!-- liste start-->
<div>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
  <div class="form-group d-flex">
  <select name="etat" class="form-control">
  <option value="">--Choisir l'etat---</option>
  <option value="tout">Tout</option>
  <option value="en cours">En cours de Traitement</option>
  <option value="en livraison">En cours de livraison</option>
  <option value="livré" >livraison treminé</option>
</select>
  <input type="submit" class="btn btn-primary ml-2" name="btnSearch" value="chercher">
  </div>

</form>


            <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Client</th>
      <th scope="col">Total</th>
      <th scope="col">Date</th>
      <th scope="col">Etat</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

    <?php
     $i=0;

      foreach($paniers as $p){
     $i++;    

           print '<tr>
           <th scope="row">'.$i.'</th>
           <td>'.$p['nom'].' '.$p['prenom'].'</td>
           <td>'.$p['total'].' DTT</td>
           <td>'.$p['date_creation'].'</td>
           <td>'.$p['etat'].'</td>
           <td>
           <a  data-toggle="modal" data-target="#commandes'.$p['id'].'" class="btn btn-success mb-2" >Afficher</a>
       <a  data-toggle="modal" data-target="#traiter'.$p['id'].'" class="btn btn-primary" >Traiter</a>
      </td>
    </tr>';
       
        }

    ?>
    
    
   
  </tbody>
</table>

  

            </div>
         
          
        </main>
      </div>
    </div>

    

  

  <?php 
 
 foreach($paniers as $index => $p ){?>

<!-- Modal Affichage -->
<div class="modal fade" id="commandes<?php echo $p['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Liste des  Commandes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
      <table class="table">
          <thead>
            <tr>
              <th>Nom produit</th>
              <th>Image </th>
              <th>Quantité</th>
              <th>Total</th>
             
            </tr>
          </thead>
          <tbody>
            <?php
            foreach($commandes as $index=> $c){// if commande appartient (panier courant )
               if($c['panier']  == $p['id']){
              print '<tr> 
              <td>'.$c['nom'].'</td>
              <td><img src="../../imag/'.$c['image'].'" with="10"/></td>
              <td>'.$c['quantite'].'</td>
              <td>'.$c['total'].' DTT</td>
             
              
              </tr>';}

            }
            ?>
          </tbody>

      </table>
      </div>
           <div class="modal-footer">
           </div>
     
    </div>
  </div>
</div>

  <?php
 }

 foreach($paniers as $index => $p ){?>

  <!-- Modal Traitement -->
  <div class="modal fade" id="traiter<?php echo $p['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Traiter la Commande</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" >
           <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="hidden" value="<?php echo $p['id']; ?>" name="panier_id">
           <div class="form-group">
            <select name="etat" class="form-control">
                   <option value="en livraison">En cours de livraison</option>
                   <option value="livré">livré</option>
                   
              </select>
            </div>
           <div class="form-group">
           <button type="submit" name="btnSumit" class="btn btn-primary">Sauvgarder</button>

           </div>
           </form>

     
        </div>
             <div class="modal-footer">
             </div>
       
      </div>
    </div>
  </div>
  
    <?php
   }
  
  

?>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../js/popper.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>

    <!-- Graphs -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.1/dist/Chart.min.js"></script>
    <script>
    function  popUpDeleteCategorie(){
   return confirm("Voulez-vous vraiment suprimer la categorie ?");
    }
    </script>
  </body>
</html>
