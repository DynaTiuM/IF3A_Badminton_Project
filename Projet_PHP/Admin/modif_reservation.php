<html lang = "fr">
<head>
    <meta charset = "UTF-8">
    <link rel="stylesheet" href ="../CSS/modif_reservation.css">
    <title>Espace utilisateur</title>
</head>
<body>
<?php

include 'admin.php';

ob_clean();

$bdd = new PDO("mysql:host=localhost;dbname=badminton;charset=utf8", "root", "");

$requete = $bdd->query("SELECT ID_reservation, jour, debut, fin, email FROM reservation INNER JOIN horaire ON reservation.ID_horaire = horaire.ID_horaire INNER JOIN utilisateur on utilisateur.email = reservation.email_reservant");

?><h2>Liste des réservations</h2>
    <?php
    while($donnees = $requete->fetch()) {
        ?><h4 class = "list"><?php
        echo "ID : ".$donnees['ID_reservation']. " : ".$donnees['jour'] ." " .$donnees['debut'] . " à ". $donnees['fin'];
        echo '<br>';
        echo "Email du réservant : ". $donnees['email'];
        echo '<br>';
        ?>
        </h4><?php
    }

$terrains_reserves= $bdd->query("SELECT * FROM reservation");

echo "  <FORM method=post name ='Reservation'>
    <label class ='id' for='Reservation'>ID de la réservation :</label>
    <select class='name' id='Reservation' name='Reservation'>";

while($donnees = $terrains_reserves->fetch()) {
    echo '<option>'.$donnees['ID_reservation'].'</option>';
}
echo "</select>";
?>
<TD class="valider2" COLSPAN=2>
    <INPUT class="valid" type="submit" value="Valider" name="Valider_res">
</TD>

<?php

if(isset($_POST['Valider_res'])){
    header('Location: ../Admin/modif_reservation.php?reservation='.$_POST['Reservation']);
}
if(isset($_GET['reservation'])){

    ob_clean();
    ob_start();

    $id_reservation = $_GET['reservation'];
    $_SESSION['reservation'] = $id_reservation;
    $requete = $bdd->query("SELECT ID_horaire FROM reservation WHERE ID_reservation = '$id_reservation'");
    $infos = $requete->fetch();
    $_SESSION['requete'] = $infos['ID_horaire'];
    $donnees= $bdd->query("SELECT * FROM reservation INNER JOIN horaire ON reservation.ID_horaire = horaire.ID_horaire WHERE ID_reservation = '$id_reservation'");
    while($donnees_terrains = $donnees->fetch()) {
        ?>
        <FORM method="post">
            <TABLE BORDER=0>
                <tr>
                    <td class = "reservation">Est en double ou non </td>
                    <td class ="reservation">
                        <input class="donnee" value =" <?php echo $donnees_terrains['est_en_double'];?>" name = "double">
                    </td>


                </tr>
            </TABLE>
            <td>
                <input class = "valid" type = "submit" value ="Continuer" name = "valider1">
            </td>
            <td>
                <input class = "suppr" type = "submit" value ="Supprimer la réservation" name = "supprimer">
            </td>
        </FORM>

        <?php
    }
}

if(isset($_POST['valider1'])){
    if($_POST['double'] == 1 || $_POST['double'] == 0){
        $_SESSION['double'] = $_POST['double'];

        ob_end_clean();
        ob_start();

        ?>
        <h2>Ajout d'un Terrain</h2>
        <h3>
            <?php
            $requete = $bdd->query("SELECT * FROM terrain");
            while($donnees = $requete->fetch()) {
                echo 'Terrain n°';
                echo $donnees['ID'], ' : ', $donnees['nom'];
                echo '<br>';
            }?>
        </h3>
        <?php

        ?><form method = "post">
        <table> <tr>
                <td class = "reservation">Terrain :</td>
                <td class = "reservation"><?php
                    echo "  <FORM method='post' name = 'Terrain'>
                            <select class = 'ID2' name='Terrain'>";
                    $infos= $bdd->query("SELECT id FROM terrain");

                    while($donnees_terrains = $infos->fetch()) {
                        echo '<option>'.$donnees_terrains['id'].'</option>';
                    }
                    echo "</select>";
                    ?>
                </td>
            </tr></table>
            <input class = "valid" type = "submit" value ="Continuer" name = "valider2">

        </form>
        <?php
    }
    else{
        ?><h3>Veuillez saisir 1 pour OUI ou 0 pour NON</h3><?php
    }


}

if(isset($_POST['valider2'])){

    $_SESSION['terrain'] = $_POST['Terrain'];
    $id_terrain = $_POST['Terrain'];

    ob_clean();
    ob_start();

    ?>
    <form method = "post">
        <table>
            <td class ="reservation">Jour :</td>
            <td class = "reservation"><?php

                echo"
		                <FORM>
		                <label for='Jours'>Horaires disponibles :</label>
		                <select class = 'horaires' id='Jours' name='Jours'>
		                ";

                $requete = $bdd->prepare("SELECT ID_horaire, jour, debut, fin from horaire WHERE ID_terrain = ? AND est_bloque = 0 AND est_disponible = 1");

                $result = $requete->execute([$id_terrain]);

                while($donnees = $requete->fetch()) {
                    echo '<option value=' .$donnees['ID_horaire']. '>  '.$donnees['jour'].' - '.$donnees['debut'].' -  '.$donnees['fin'].'</option>';

                }

                echo "</select>";
                ?>
            </td>
        </table><td >
            <input class = "valid" type = "submit" value ="Valider" name = "valider3">
        </td>
    </form>
    <?php
}

if(isset($_POST['valider3'])){

    ob_clean();
    ob_start();
    ?><p class = "valid">Réservation modifiée avec succès !</p><?php
    $_SESSION['jour'] = $_POST['Jours'];

    $info = $_SESSION['requete'];
    $reservation = $_SESSION['reservation'];
    $double = $_SESSION['double'];
    $terrain = $_SESSION['terrain'];
    $jour = $_SESSION['jour'];
    $requete = $bdd->query("UPDATE horaire SET est_disponible = 1 WHERE ID_horaire = '$info'");
    $requete = $bdd->query("UPDATE horaire SET est_bloque = 0 WHERE ID_horaire = '$info'");
    $requete = $bdd->query("UPDATE reservation SET est_en_double = '$double' WHERE ID_reservation = '$reservation'");
    $requete = $bdd->query("UPDATE reservation SET ID_terrain = '$terrain' WHERE ID_reservation = '$reservation'");
    $requete = $bdd->query("UPDATE reservation SET ID_horaire = '$jour' WHERE ID_reservation = '$reservation'");
    $requete = $bdd->query("UPDATE horaire SET est_disponible = 0 WHERE ID_horaire = '$jour'");
    $requete = $bdd->query("UPDATE horaire SET est_bloque = 1 WHERE ID_horaire = '$jour'");


}

if(isset($_POST['supprimer'])){
    $id_reservation = $_SESSION['reservation'];
    $horaire = $bdd->query("SELECT ID_horaire FROM reservation WHERE id_reservation = '$id_reservation'");
    $donnees2 = $horaire->fetch();

    $info = $_SESSION['requete'];
    $requete = $bdd->query("UPDATE horaire SET est_disponible = 1 WHERE ID_horaire = '$info'");
    $requete = $bdd->query("UPDATE horaire SET est_bloque = 0 WHERE ID_horaire = '$info'");

    $supprimer = $bdd->query("DELETE FROM contenu_reservation_users WHERE id_reservation = '$id_reservation'");
    $supprimer = $bdd->prepare("DELETE FROM reservation WHERE `id_reservation` = ?");
    $supprimer->execute([$id_reservation]);

    echo 'Réservation supprimée !';
	
	header("Location: ../Admin/admin.php");
}

?>


<a class = "retour" href="admin.php?">Retour à l'espace Administrateur</a>

</body>
</html>

