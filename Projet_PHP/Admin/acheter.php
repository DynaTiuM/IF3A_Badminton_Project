<html lang ="fr">
<head>
    <meta charset = "UTF-8">
    <link rel="stylesheet" href ="../CSS/acheter.css">
    <title>Espace Aministrateur</title>
</head>

<h1>Achat d'équipements</h1>
<body>
<?php

session_start();

$email = $_SESSION['email'];

$bdd = new PDO("mysql:host=localhost;dbname=badminton;charset=utf8", "root", "");
$requete = $bdd->prepare("SELECT count(*) FROM utilisateur WHERE utilisateur.email = ? AND utilisateur.est_administrateur = 1");
$requete->execute([$email]);


$count = $requete->fetchColumn();

$inventaire = array();
$inventaire_terrain = array();

if($count == 0) {
    echo "Acces refusé, vous n'etes pas administrateur !";
} else {

    ob_start();


    echo '<p class = "Liste">';
    echo "Liste des objets disponibles :";
    echo '</p>';
    $requete = $bdd->query("SELECT * FROM objet");
    echo "</br>";


    echo '<p class ="objets">';
    while($donnees = $requete->fetch()) {
        echo $donnees['Nom'];
        echo "</br>";
        $inventaire[] = $donnees['Nom'];
    }

    echo '</p>';

    echo "</br>";
    echo "</br>";
    echo '<p class = "Liste">';
    echo "Liste des objets du terrain :";
    echo '</p>';
    $requete = $bdd->prepare("SELECT objet.Nom, inventaire.quantite FROM objet INNER JOIN inventaire ON objet.ID_Objet = inventaire.ID_Objet WHERE inventaire.ID_terrain = ?");
    $requete->execute([$_GET['id']]);

    echo "</br>";

    echo '<p class = "objets">';
    while($donnees = $requete->fetch()) {
        echo "Il y a ". $donnees['Nom'] . " en " . $donnees['quantite'] . " exemplaires";
        echo "</br>";
        $inventaire_terrain[] = $donnees['Nom'];
    }

    echo '</p>';


    $nom_objet = $bdd->query("SELECT Nom FROM objet");

    echo "  <FORM method=post name ='Objet_nom'>
		<label class = 'Liste' for='Objet_nom'>Objet :</label>
		<select class = 'objets' id='Objet_nom' name='Objet_nom'>";

    while($donnees = $nom_objet->fetch()) {
        echo '<option>'.$donnees['Nom'].'</option>';
    }
    echo "</select>";
    echo '<br/>';
    echo '<FORM method="post">
            <p class = "Liste">
            <TR>
			<TD>Entrez la quantité à acheter</TD>
			<TD>
			<INPUT class = "nb" type=number name="quantite" required>
			</TD>
			</TR>
			</p>
			
			<TR>
 			<TD>
			<INPUT class ="confirmer" type="submit" value="Confirmer l\'achat" name="achat">
 			</TD>
			</TR>

			</TABLE>
			</FORM>';
}


if(isset($_POST['achat'])) {
    $validite = 0;
    $deja_dans_terrain = 0;

    $objet = $_POST['Objet_nom'];

    foreach ($inventaire as $iterateur){

        if($objet == $iterateur) {
            $validite = 1;
            break;
        }
    }

    foreach ($inventaire_terrain as $iterateur){

        if($objet == $iterateur) {
            $deja_dans_terrain = 1;
            break;
        }
    }

    if($_POST['quantite'] <= 0){
        ob_clean();
        echo'<p class = "non">';
        echo "La quantité doit être supérieure ou égale à 1 !";
        echo'</p>';

        ?>
        <FORM method ="post">
            <TR>
                <TD>
                    <INPUT class ="Liste" type="submit" value="Réessayer" name="reessayer">
                </TD>
            </TR>

        </FORM>
        <?php
        if(isset($_POST['reessayer'])){
            header('Location: ../Admin/acheter?id='&$_GET['id']);
        }

    } else {

        $requete = $bdd->prepare("SELECT ID_objet FROM objet WHERE Nom = ?");
        $requete->execute([$objet]);

        $donnee = $requete->fetch();
        $id = $donnee['ID_objet'];

        if($deja_dans_terrain == 0) {

            $requete = $bdd->prepare("INSERT INTO `inventaire` (`ID_terrain`, `ID_Objet`, `quantite`) VALUES (?, ?, ?)");
            $requete->execute([$_GET['id'], $id, $_POST['quantite']]);

        } else {

            $requete = $bdd->prepare("SELECT quantite FROM inventaire WHERE inventaire.ID_Objet = ? AND inventaire.ID_terrain = ?");
            $requete->execute([$id, $_GET['id']]);
            $donnee = $requete->fetch();


            $quantite = $donnee['quantite'] + $_POST['quantite'];

            $requete = $bdd->prepare("UPDATE `inventaire` SET `quantite` = ? WHERE `inventaire`.`ID_terrain` = ? AND `inventaire`.`ID_Objet` = ?");
            $requete->execute([$quantite, $_GET['id'], $id]);
        }

        ob_clean();
        echo '<p class = "confirmer">';
        echo "L'achat a été réalisé avec succès !";
        echo '</p>';
		
		header("Location: ../Admin/admin.php");
    }
}
?>

<a class = "retour" href="../Admin/admin.php">Retour à l'espace Administrateur</a>
</body>
</html>


