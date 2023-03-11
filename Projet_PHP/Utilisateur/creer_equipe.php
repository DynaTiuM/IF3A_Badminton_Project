<html>
<head>
    <meta charset = "UTF-8">
    <link rel="stylesheet" href ="../CSS/creer_equipe.css">
    <title>Créer une équipe</title>
</head>
<body>
<h1>Créer une équipe</h1>
<?php

session_start();

$bdd = new PDO("mysql:host=localhost;dbname=badminton;charset=utf8", "root", "");

$user = $_SESSION['email'];

$requete = $bdd->prepare("SELECT COUNT(*) FROM `contenu-equipe` WHERE email_membre = ?");
$requete->execute([$user]);

$count = $requete->fetchColumn();

if($count != 0) {
    echo "Vous ne pouvez pas creer une équipe car vous appartenez deja à une équipe";
} else {
    echo '<FORM method="post">
			<TABLE BORDER=0>

			<TR>
			<TD class = "options">Entrez le nom de l\'équipe</TD>
			<TD>
			<INPUT class = "options" type=text name="equipe" required>
			</TD>
			</TR>

			<TR>
 			<TD>
			<INPUT class = "submit" type="submit" value="Créer" name="creer_equipe">
 			</TD>
			</TR>

			</TABLE>
			</FORM>';


    if(isset($_POST['creer_equipe'])) {

        //On detrmine si une équipe porte deja ce nom
        $requete = $bdd->prepare("SELECT COUNT(*) FROM equipe WHERE Nom = ?");
        $requete->execute([$_POST['equipe']]);

        $count = $requete->fetchColumn();

        if($count == 1) {
            echo "===============================================";
            echo "Veuillez saisir le nom d'une equipe inexistante";
            echo "===============================================";
        } else {
            //Insere une nouvelle equipe dans la table equipe
            $requete = $bdd->prepare("INSERT INTO equipe VALUES (NULL, ?)");
            $requete->execute([$_POST['equipe']]);

            //Recupere l'id de l'equipe créée
            $requete = $bdd->prepare("SELECT id_equipe FROM `equipe` WHERE Nom = ?");
            $requete->execute([$_POST['equipe']]);

            $donnee = $requete->fetch();

            $id = $donnee['id_equipe'];


            //On s'insere soi-meme comme membre de l'équipe qu'on vient de créer.
            $requete2 = $bdd->prepare("INSERT INTO `contenu-equipe` VALUES (?, ?)");
            $requete2->execute([$id, $user]);

            header("Location: ../Utilisateur/utilisateur.php");
        }
    }
}


?>

<a class = "retour" href="../Utilisateur/utilisateur.php">Retour à l'espace Utilisateur</a>
</body>
</html>

