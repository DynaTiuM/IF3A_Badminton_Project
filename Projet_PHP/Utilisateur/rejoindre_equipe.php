<html>
<head>
    <meta charset = "UTF-8">
    <link rel="stylesheet" href ="../CSS/rejoindre_equipe.css">
    <title>Rejoindre une équipe</title>
</head>
<body>
<h1>Rejoindre une équipe</h1>
<?php

session_start();

$bdd = new PDO("mysql:host=localhost;dbname=badminton;charset=utf8", "root", "");

$user = $_SESSION['email'];

$requete = $bdd->prepare("SELECT COUNT(*) FROM `contenu-equipe` WHERE email_membre = ?");
$requete->execute([$user]);

$count = $requete->fetchColumn();

if($count == 0) {
    echo "  <FORM method=post>";

    $requete = $bdd->query("SELECT * FROM equipe");




    echo"
		<label for='equipe'>Nom de l'équipe :</label>
		<select class = 'options' id='equipe' name='equipe'>";


    while($donnees = $requete->fetch()) {

        echo "<option  value = ".$donnees["id_equipe"]."> ".$donnees["Nom"]." </option>";
    }

    echo "</select>";


    echo '
		<br>
		<INPUT class = "submit" type="submit" value="Rejoindre une équipe" name="rejoindre">
		</FORM>';


    if(isset($_POST['rejoindre'])) {

        $id = $_POST['equipe'];

        $requete2 = $bdd->prepare("INSERT INTO `contenu-equipe` VALUES (?, ?)");
        $requete2->execute([$id, $user]);

        header("Location: ../Utilisateur/utilisateur.php");
    }

} else {
    echo "Vous ne pouvez pas rejoindre une équipe car vous appartenez deja à une équipe";
}





?>

<a class = "retour" href="../Utilisateur/utilisateur.php">Retour à l'espace Utilisateur</a>
</body>
</html>

