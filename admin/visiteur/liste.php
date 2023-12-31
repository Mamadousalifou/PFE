<?php 
session_start();

include "../../inc/functions.php";
$visiteurs= getAllUsers();

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
            <h1 class="h2">Liste des visiteurs</h1>
            

            <div>
            </div>
</div>
<!-- liste start-->
<div>
<!-- confirmation de l'ajout-->
  <?php if(isset($_GET['valider']) && $_GET['valider'] ='ok') {
    print '<div class=" alert alert-success">
    visiteur valider avec succée
  </div>';
  }?>


            <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nom et prenom</th>
      <th scope="col">email</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
  
  
     foreach($visiteurs as $i => $visiteur){
     $i++;    

          print '<tr>
          <th scope="row">'.$i.'</th>
          <td>'.$visiteur['nom'].' '.$visiteur['prenom'].'</td>
          <td>'.$visiteur['email'].'</td>
          <td>
          <a  href="valider.php?id='.$visiteur['id'].'" class="btn btn-success" >Valider</a>
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
