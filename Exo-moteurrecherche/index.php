<?php
$bdd = new PDO('mysql:host=localhost;dbname=exo_carnet', 'root','');
$allusers = $bdd->query('SELECT * FROM carnet ORDER BY ID DESC');
if(isset($_GET['s'])AND !empty($_GET['s'])){
    $recherche = htmlspecialchars($_GET['s']);
    $allusers = $bdd->query('SELECT NOM,PRENOM FROM carnet WHERE NOM LIKE"%'.$recherche.'%"ORDER BY ID DESC');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche des utilisateurs </title>
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
                  <p><?= $user['NOM'] ?>
                  <?= $user['PRENOM'] ?></p>
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