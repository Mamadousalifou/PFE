<?php 
function connect(){
    // 1-connexion vers la BD

$servername = "localhost";
$DBuser = "root";
$DBpassword = "";
$DBname = "ms shop";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$DBname", $DBuser, $DBpassword);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
  } catch(PDOException $e) {
    //echo "Connection failed: " . $e->getMessage();
  }

  return $conn;
}




// recuperer toutes les categories
function getAllCategories(){
  
// 1-connexion vers la BD
$conn= connect();

// 2-creation de la requette

$request ="SELECT *FROM categories";

// 3-execution de la requette

$resultat =  $conn->query($request);

// 4-resultat de la requette

$categories =$resultat->fetchAll();

//var_dump($categories);

return $categories;
}


function getAllproduits(){
    // 1-connexion vers la BD

    $conn= connect();

// 2-creation de la requette

$request ="SELECT *FROM produits";

// 3-execution de la requette

$resultat =  $conn->query($request);

// 4-resultat de la requette

$produits =$resultat->fetchAll();

//var_dump($categories);

return $produits;
}

function searchProduits($keywords){
   // 1-connexion vers la BD

$conn= connect();


     // 2 - creation de la requette
     $requette = "SELECT * FROM produits WHERE nom LIKE '%$keywords%'";

      
     // 3 - execution de la requette
     $resultat =$conn->query($requette);

     // 4 - resultat
     $produits=$resultat->fetchAll();
 
     return $produits;


}


function getProduitById($id){

$conn=connect();

// 1 - creation de la requette

$requette = "SELECT * FROM produits WHERE id=$id";

// 3 - execution de la requette
$resultat =$conn->query($requette);

// 4 - resultat
$produit=$resultat->fetch();

return $produit;

}

// Ajouter un visiteur
function Addvisiteur($data){

    $conn=connect();
    $mphash = md5($data['mp']);
    $requette ="INSERT INTO visiteur(nom,prenom,email,telephone,mp) VALUES('".$data['nom']."','".$data['prenom']."','".$data['email']."','".$data['telephone']."','". $mphash."')  ";

    $resultat = $conn->query($requette);

    if($resultat){
        return true;
       }else{
        return false;
       }
    }

    function  ConnectVisiteur($data){
      
        $conn=connect();
        $email= $data['email'] ;
        $mp= md5($data['mp']) ;
        $requette = "SELECT * FROM visiteur WHERE email='$email' AND mp='$mp'";
        
        $resultat = $conn->query($requette); 
        
        $user= $resultat->fetch();
    
     return $user;

    }


    function ConnectAdmin($data){
    
        $conn = Connect();
        $email= $data['email'];
        $mp = $data['mp'];
        $requette = "SELECT * FROM administrateur WHERE email='$email' AND mp='$mp'";
        
        $resultat = $conn->query($requette); 
        
        $user= $resultat->fetch();
    
     return $user;



    }


    function getAllUsers(){
        $conn = Connect();

        $requette = "SELECT * FROM visiteur WHERE etat=0";
        
        $resultat = $conn->query($requette); 
        $user= $resultat->fetchAll();
    
        return $user;
   
      



    }

   function getStocks(){
    $conn = Connect();
    $requette ="SELECT s.id,p.nom,quantite FROM produits p,stock s WHERE p.id=s.produit";
    $resultat = $conn->query($requette); 
    $stocks= $resultat->fetchAll();
 
    return $stocks;
    }

    function getAllPaniers(){
        $conn = Connect();
    $requette ="SELECT v.nom,v.prenom ,p.id,v.telephone,p.total,p.etat ,p.date_creation FROM panier p,visiteur v where p.visiteur=v.id ";
    $resultat = $conn->query($requette); 
    $paniers= $resultat->fetchAll();
 
    return $paniers;
    }
   
    function  getAllCommandes(){
        $conn = Connect();
        $requette ="SELECT p.nom, p.image,c.quantite,c.total,c.panier FROM commandes c , produits p WHERE c.produit= p.id";
        $resultat = $conn->query($requette); 
        $commandes= $resultat->fetchAll();
     
        return $commandes;
    }


    function changerEtatPanier($data){
        $conn = Connect();
        $requette ="Update panier SET etat='".$data['etat']."' Where id='".$data['panier_id'] ."'";
        $resultat = $conn->query($requette); 
    
    }


    function getPanierByEtat($paniers,$etat){
     $paniersEtat =array();
     foreach($paniers as $p){
        if($p['etat']==$etat){
            array_push( $paniersEtat,$p);
          
        }
     }
     return $paniersEtat;
    }

    function EditAdmin($data){
        $conn = Connect();
        if($data['mp']!= ""){
            $requette ="Update administrateur SET nom='".$data['nom']."', email='".$data['email']."' ,mp='".md5($data['mp'])."' Where id='".$data['id_admin'] ."'";

        }else{
            $requette ="Update administrateur SET nom='".$data['nom']."', email='".$data['email']."' Where id='".$data['id_admin'] ."'";

        }
        $resultat = $conn->query($requette); 

        return true;


    }

    function getData(){
        $data = array();
        $conn = Connect(); 

       //calculer les nombre des produits dans la BD 
       $requette = "SELECT COUNT(*) FROM produits ";
       $resultat = $conn->query($requette);
       $nbrPrds =$resultat->fetch(); 

       //calculer les nombre des categories dans la BD 
       $requette1 = "SELECT COUNT(*) FROM categories ";
       $resultat = $conn->query($requette1);
       $nbrCat =$resultat->fetch();
       
       //calculer les nombre des visiteurs dans la BD 
       $requette2 = "SELECT COUNT(*) FROM visiteur ";
       $resultat = $conn->query($requette2);
        $nbrClients =$resultat->fetch(); 

       $data['produits'] =    $nbrPrds[0];
       $data['categories'] =     $nbrCat[0];
       $data['clients'] =    $nbrClients[0];

       return $data;
    }


?>