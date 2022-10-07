<?php
$bdd = new PDO('mysql:host=localhost;dbname=corbillard', 'root','');
$allusers = $bdd->query('SELECT * FROM corbillard ORDER BY Id_Corbillard DESC');
if(isset($_GET['s'])AND !empty($_GET['s'])){
    $recherche = htmlspecialchars($_GET['s']);
    $allusers = $bdd->query('SELECT Marque, Année_modèle, Mise_en_circulation, Nom, Lien FROM corbillard NATURAL JOIN Photo WHERE Marque LIKE"%'.$recherche.'%"ORDER BY Id_Corbillard DESC');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche des utilisateurs </title>
    <link rel="stylesheet" href="style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    
</head>
<body>
    <form method="GET">
        <input type="search" name="s" placeholder="Rechercher un utilisateur">
        <input type="submit" name="envoyer" >

        <section class="afficher_utilisateur">


         <?php
               if($allusers->rowCount()> 0){

                  while($user = $allusers->fetch()){
                  ?>


                      <div class="container">
                    <div class="row">
    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4"> Corbillard <br /><?= $user['Marque'] ?>  </div>
    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4"> Année <br /><?= $user['Année_modèle'] ?> </div> 
     <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4"> Mise en circulation <br /><?= $user['Mise_en_circulation'] ?></div>
      <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4"> Photo <br />
    <img src="<?= $user['Lien'] ?>">
      </div>
                  </div>
                </div>
                                 
                  <?php
               }
               }
            
               
               else{
                ?>
                <p> Aucun Utilisateur trouvé </p>
                <?php
               }


         ?>

        </section>
    </form>
</body>
</html>