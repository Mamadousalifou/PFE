<?php
session_start();

if(isset($_SESSION['nom'])){
  header('location:profile.php');
}


 include "inc/functions.php";
    $categories = getAllCategories();
    $showRegistrationAlert = 0;

    if(!empty($_POST)){//clik sur le button sauvgarder 
      
      if(Addvisiteur($_POST)) {
        $showRegistrationAlert = 1;
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.5/sweetalert2.min.css" integrity="sha512-InYSgxgTnnt8BG3Yy0GcpSnorz5gxHvT6OEoRWj91Gg+RvNdCiAharnBe+XFIDS754Kd9TekdjXw3V7TAgh6Vw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php
       include "inc/header.php"
    ?>
      <!--fin navbar-->

      <div class="col-12 p-5">
        <h1 class="text-center">Registre</h1>
        <form action= "registre.php" method= "post">
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Email address</label>
              <input type="email" name="email" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
              <div id="emailHelp" class="form-text">l'email est obligatoire</div>
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Nom</label>
              <input type="text" name="nom" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Prénom</label>
                <input type="text" name="prenom" class="form-control" id="exampleInputPassword1">
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Téléphone</label>
                <input type="text" name="telephone"class="form-control" id="exampleInputPassword1">
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" required   class="form-label">Mot de passe</label>
                <input type="password" name="mp" class="form-control" id="exampleInputPassword1">
              </div>
           
            <button type="submit" class="btn btn-primary">Sauvgarder</button>
          </form>
      </div>

     <!--footer-->
      </div>
      
      <?php 
       include "inc/footer.php";
     ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.5/sweetalert2.all.min.js" integrity="sha512-2JsZvEefv9GpLmJNnSW3w/hYlXEdvCCfDc+Rv7ExMFHV9JNlJ2jaM+uVVlCI1MAQMkUG8K83LhsHYx1Fr2+MuA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php 
if(  $showRegistrationAlert == 1){
  print "
  <script>
  Swal.fire({
    title: 'Success!',
    text: 'creation de compte effectué avec succes',
    icon: 'success',
    confirmButtonText: 'ok',
    timer : 2000
  })
  </script>
  ";
  

}

?>



</html>