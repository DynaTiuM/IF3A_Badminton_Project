<html lang="fr">
<head>
    <meta charset = "UTF-8">
    <link rel="stylesheet" href ="../CSS/consulter_tournois.css">
    <title>Consulter tournoi</title>
</head>
<body>
<h1>Consultation tournoi</h1>
</body>
</html>

<?php

$bdd = new PDO("mysql:host=localhost;dbname=badminton;charset=utf8", "root", "");
$requete = $bdd->query(
"SELECT Nom, SUM(Win) As Victoires, SUM(Loss) as Defaites, SUM(Ties) as Egalites, SUM(Win)*3 +  SUM(Ties) as Score
FROM
( SELECT Nom, id_equipe1, 
     CASE WHEN score1 > score2 THEN 1 ELSE 0 END as Win,  
     CASE WHEN score1 < score2 THEN 1 ELSE 0 END as Loss, 
     CASE WHEN score1 = score2 THEN 1 ELSE 0 END as Ties
  FROM `match` INNER JOIN equipe on `match`.id_equipe1 = equipe.id_equipe
  UNION ALL
  SELECT NOM, id_equipe2, 
     CASE WHEN score2 > score1 THEN 1 ELSE 0 END as Win,     
     CASE WHEN score2 < score1 THEN 1 ELSE 0 END as Loss, 
     CASE WHEN score1 = score2 THEN 1 ELSE 0 END as Ties
  FROM `match` INNER JOIN equipe on `match`.id_equipe2 = equipe.id_equipe
) requete
GROUP BY Nom
ORDER BY Score DESC");

$i = 1;

?><p><?php
while($donnees = $requete->fetch()) {
	echo $i . "e place : ";
	
	echo $donnees['Nom'] . " avec ". $donnees['Victoires'] . " victoires, ". $donnees['Egalites'] . " matchs nuls et ". $donnees['Defaites']. " défaites.";
	echo " Score final : " . $donnees['Score'];
	
	echo "<br>";
	
	$i++;
}
?></p><?php

?>



<a class = "retour" href="../utilisateur/utilisateur.php">Retour à l'espace Utilisateur</a>
