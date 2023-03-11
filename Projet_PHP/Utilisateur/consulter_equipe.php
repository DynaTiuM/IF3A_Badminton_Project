<html lang ="fr">
<head>
    <meta charset = "UTF-8">
    <link rel="stylesheet" href ="../CSS/consulter_equipe.css">
    <title>Consultation Equipe</title>
</head>
<body>
<h1>Consultation de votre équipe</h1>
<?php
session_start();
$email = $_SESSION['email'];
$bdd = new PDO("mysql:host=localhost;dbname=badminton;charset=utf8", "root", "");

$requete = $bdd->prepare("SELECT Nom FROM `equipe` INNER JOIN `contenu-equipe` on `equipe`.id_equipe = `contenu-equipe`.id_equipe WHERE `contenu-equipe`.email_membre = ?");
$requete->execute([$email]);

$donnee = $requete->fetch();

?><h2><?php
    echo 'Nom de l\'équipe : ';
    ?></h2>
<h2><?php
    echo $donnee['Nom'];
    ?></h2>
<?php
echo "</br>";

$requete = $bdd->prepare("SELECT nom, prenom FROM utilisateur INNER JOIN `contenu-equipe` ON utilisateur.email = `contenu-equipe`.email_membre WHERE id_equipe = (SELECT id_equipe FROM `contenu-equipe` WHERE `contenu-equipe`.email_membre = ?)");
$requete->execute([$email]);
?><h2><?php
    echo 'Membres de l\'équipe : ';
    ?></h2><br/>
<h3><?php
    while($donnees = $requete->fetch()) {

        echo $donnees['prenom'] ." ". $donnees['nom'];


        echo "</br>";
    }
    ?></h3> <?php
echo '<FORM method="post">
			<TABLE BORDER=0>

			<TR>
 			<TD>
			<INPUT class = "submit" type="submit" value="Quitter votre équipe" name="quitter">
 			</TD>
			</TR>

			</TABLE>
			</FORM>';

if(isset($_POST['quitter'])) {


    //On recupere l'id de l'equipe ou le joueur était

    $requete = $bdd->prepare("SELECT id_equipe FROM `contenu-equipe` WHERE `contenu-equipe`.email_membre = ?");
    $requete->execute([$email]);

    $donnee = $requete->fetch();
    $id_equipe = $donnee['id_equipe'];

    //On enleve la personne dans la table contenu_equipe

    $requete = $bdd->prepare("DELETE FROM `contenu-equipe` WHERE email_membre = ?");
    $requete->execute([$email]);

    //Si il n'y a plus personne apres avoir quitté, on supprime l'équipe
    $requete = $bdd->prepare("SELECT COUNT(*) FROM `contenu-equipe` WHERE id_equipe = ?");
    $requete->execute([$id_equipe]);

    $count = $requete->fetchColumn();

    if($count == 0) {
		$delete = $bdd->query("DELETE FROM `equipe` WHERE id_equipe = $id_equipe");
		
    }
	header("Location: ../Utilisateur/utilisateur.php");
}

?>

</body>
</html>

