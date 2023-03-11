<html lang="fr">
<head>
    <meta charset = "UTF-8">
    <link rel="stylesheet" href ="../CSS/admin.css">
    <title>Espace Aministrateur</title>
</head>
<body>
<h1>Espace Administrateur</h1>

<?php

session_start();

$email = $_SESSION['email'];

$bdd = new PDO("mysql:host=localhost;dbname=badminton;charset=utf8", "root", "");
$requete = $bdd->prepare("SELECT count(*) FROM utilisateur WHERE utilisateur.email = ? AND utilisateur.est_administrateur = 1");
$requete->execute([$email]);

$count = $requete->fetchColumn();

if($count == 0) {
    echo "Acces refusé, vous n'êtes pas administrateur !";
} else {
    ob_start();
    echo '  <FORM method="post">
				<TABLE BORDER=0>

				<TR>
				    <TD>
				        <INPUT class ="donnees" type="submit" value="Consulter la liste des membres" name="listeMembres">
				    </TD>
				</TR>
				<TR>
 				    <TD>
				        <INPUT class ="donnees" type="submit" value="Modifier un terrain" name="changeTerrain">
 				    </TD>
 				    <TD>
				        <INPUT class ="donnees" type="submit" value="Ajouter un terrain" name="ajtTerrain">
 				    </TD>
 				    <TD>
				        <INPUT class ="donnees" type="submit" value="Supprimer un terrain" name="supprTerrain">
 				    </TD>
				</TR>

				<TR>
				    <TD>
				        <INPUT class ="donnees" type = submit value ="Consulter les réservations" name ="consultReservation">
                    </TD>
 				    <TD>
				        <INPUT class ="donnees" type="submit" value="Modifier les réservations" name="changeReservation">
 				    </TD>
		        <TR>
 				    <TD>
				        <INPUT class ="donnees" type="submit" value="Acheter des équipements" name="acheterObjets">
 				    </TD>
 				</TR>    
				</TR>
				<TR>
 				    <TD>
				        <INPUT class ="donnees" type="submit" value="Bloquer un horaire" name="bloqueHoraire">
 				    </TD>
				</TR>
				
				
				<TR>
 				    <TD>
				        <INPUT class ="donnees" type="submit" value="Entrer les résultats d\'un match" name="match">
 				    </TD>
				</TR>

				</TABLE>
			</FORM>';
}

if(isset($_POST['consultReservation'])){
    header('Location: ../Utilisateur/consult_reservation.php');
}

if(isset($_POST['changeReservation'])){
    header('Location: modif_reservation.php');
}

if(isset($_POST["bloqueHoraire"])) {
    header("Location: terrain_chooser.php?action=bloquer");
}

if(isset($_POST["acheterObjets"])) {
    header("Location: terrain_chooser.php");
}

if(isset($_POST["match"])) {
    header("Location: match.php");
}

$num = 0;

if(isset($_POST["listeMembres"])) {
    ob_end_clean();

    $requete = $bdd->query("SELECT * FROM `utilisateur` ORDER BY `utilisateur`.`nom`, `utilisateur`.`prenom` ASC");
?>
<h2>Liste des membres</h2>
<h3>
    <?php
    while($donnees = $requete->fetch()) {
        echo $donnees['nom'] ." " .$donnees['prenom'];
        echo '<br>';
    }
}?>
</h3>

<?php
if(isset($_POST["ajtTerrain"])) {
ob_end_clean();
ob_start();

?>
    <h2>Ajout d'un Terrain</h2>
    
<FORM method="post" action ="ajouter_terrain.php">
				<TABLE BORDER=0>
				<TR>
 				<TD>Nom du terrain</TD>
 				<TD>
 				<INPUT class ="donnees_entrer" type=text name="nom_terrain" required>
 				</TD>
				</TR>	
				
				<TR>
 				<TD>Adresse du terrain</TD>
 				<TD>
 				<INPUT class ="donnees_entrer" type=text name="adresse_terrain" required>
 				</TD>
				</TR>

				<TR>
 				<TD class="donnees">
				<INPUT class ="donnees_cliquer" type="submit" value="Ajouter un terrain" name = "ajtTerrain2">
 				</TD>
				</TR>

				</TABLE>
				</FORM>
<?php
}
?>

<?php
if(isset($_POST["supprTerrain"])) {
    ob_end_clean();
    ob_start();

    ?>
    <h2>Suppression d'un Terrain</h2>
    <h3>
        <?php
        $requete = $bdd->query("SELECT * FROM terrain");
        while($donnees = $requete->fetch()) {
            echo 'Terrain n°';
            echo $donnees['ID'], ' : ', $donnees['nom'];
            echo '<br>';
        }?>
    </h3>
    <FORM method="post" action ="supprimer_terrain.php">
        <TABLE BORDER=0>
            <TR>
                <TD>ID du terrain</TD>
                <TD>
                    <INPUT class ="donnees_entrer" type=text name="id_terrain" required>
                </TD>
            </TR>
                <TD class="donnees">
                    <INPUT class ="donnees_cliquer" type="submit" value="Supprimer un terrain" name = "supprTerrain2">
                </TD>
            </TR>

        </TABLE>
    </FORM>
    <?php
}
?>

<?php
if(isset($_POST["changeTerrain"])) {
    ob_end_clean();
    ob_start();

    $requete = $bdd->query("SELECT * FROM terrain");
    ?>
<h2>Modification des Terrains</h2>
<h3>
<?php
    while($donnees = $requete->fetch()) {
        echo 'Terrain n°';
        echo $donnees['ID'], ' : ', $donnees['nom'];
        echo '<br>';
    }?>
</h3>

<h4>
    <?php
    echo '<br> Quel terrain souhaitez-vous modifier ?';
    ?>
</h4>

<?php
    echo '  <FORM method="post">
		
				<TABLE BORDER=0>

				<TR>
 				<TD>Numéro du terrain</TD>
 				<TD>
 				<INPUT class ="donnees_entrer" type=text name="terrain" required minlength="1" maxlength="12" required>
 				</TD>
				</TR>
				<TR>

				<TR>
 				<TD class="donnees_cliquer">
				<INPUT  class ="donnees" type="submit" value="Consulter un terrain" name="consulterTerrain">
 				</TD>
				</TR>

				</TABLE>
				</FORM>';
}

if(isset($_POST["consulterTerrain"])) {
    ob_clean();

    $_SESSION['terrain'] = $_POST['terrain'];
    $num = $_SESSION['terrain'];

    $requete = $bdd->prepare("SELECT count(*) FROM terrain WHERE ID = ?");
    $requete->execute([$num]);

    $count = $requete->fetchColumn();

    if($count == 0) {
        ?>
<h4>
    <?php
    echo "Mauvais ID de terrain, veuillez recommencer ! ";
    ?>
</h4>
        <?php
    } else {
        ?>
<Form method ="post" action ="../Admin/modifier_terrain.php">
<TABLE BORDER=0>
				<TR>
 				<TD>Nouveau nom du terrain</TD>
 				<TD>
 				<INPUT class ="donnees_entrer" type=text name="nom_terrain" required>
 				</TD>
				</TR>

				<TR>
 				<TD>Nouvelle adresse du terrain</TD>
 				<TD>
 				<INPUT class ="donnees_entrer" type=text name="adresse_terrain" required>
 				</TD>
				</TR>

				<TR>
 				<TD>Est-t'il à l'intérieur ?</TD>
 				<TD>
 				<input type="checkbox" id="estInt" name="estInt" value="estInterieur" checked>
 				</TD>
				</TR>

				<TR>
 				<TD class="donnees">
				<INPUT class ="donnees_cliquer" type="submit" value="Modifier le terrain" name = "modifterrain">
 				</TD>
				</TR>
				</TABLE>
				</FORM>
<?php
    }

}
?>
<FORM method="post" action="admin.php">
    <TABLE BORDER=0>
        <TR>
            <TD>
                <INPUT class="donnees"  type="submit" value="Retour" name="back">
            </TD>
        </TR>
    </TABLE>
</FORM>

<a class = "retour" href="../Utilisateur/utilisateur.php">Retour à l'espace Utilisateur</a>
</body>
</html>

