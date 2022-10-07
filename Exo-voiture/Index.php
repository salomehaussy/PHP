<html>
<head>
<title>
Connexion à MySQL avec PDO
</title>
<meta charset="utf-8">
<link rel="stylesheet" href="style.css" />
</head>
<body>
<h1>
Interrogation de la table CARNET avec PDO
</h1>

<?php
require_once('connexion.php');
$connexion=connect_bd();
$sql="SELECT * from voiture";
if(!$connexion->query($sql)) echo "Pb d'accès au voiture";
else{
?>
<table class="centre" id="jolie">
<tr> <td> ID </td> <td> Marques </td> <td> Année Modele </td><td> Mise en circulation </td> </tr>
  <?php
  foreach ($connexion->query($sql) as $row)
echo "<tr><td>".$row['Id_Voiture']."</td>
          <td>".$row['Marques']."</td>
          <td>".$row['Annee_modele']."</td>
          <td>".$row['Mise_en_circulation']."</td></tr><br/>\n";
  ?>
</table>
<?php } ?>
</body>
</html>