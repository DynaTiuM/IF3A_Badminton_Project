<html lang = "fr">
<head>
    <meta charset = "UTF-8">
    <link rel="stylesheet" href ="../CSS/consult_reservation.css">
    <title>Espace utilisateur</title>
</head>

<h1>Consultation Réservations</h1>
<?php
session_start();

$email = $_SESSION['email'];

$bdd = new PDO("mysql:host=localhost;dbname=badminton;charset=utf8", "root", "");
$admin = $bdd->query("SELECT est_administrateur FROM utilisateur WHERE utilisateur.email = '$email'");
$donnees = $admin->fetch();

if( $donnees['est_administrateur'] == 1){
    echo"
		<form method = 'post' name ='membre'>
		<label class = 'membre' for='membre'>Membre :</label>
		<select class = 'membre2' id='membre' name='membre'>";


    $requete = $bdd->query("SELECT email, prenom, nom from utilisateur");
    while($donnees = $requete->fetch()) {
        echo '<option value=' .$donnees['email']. '>' .$donnees['email']. '</option>';
    }

    echo "</select>";

    ?>
    <form method="post"><TR>
            <TD>
                <INPUT class = "consulter" type="submit" value="Consulter les réservations" name="consulter">
            </TD>
        </TR>
        <TD>
            <INPUT class = "reservations" type="submit" value="Membres ayant le plus de réservations" name="reservation">
        </TD>
    </form>


    <?php
    if(isset($_POST['reservation'])){
        $requete = $bdd->query("SELECT nom, prenom, COUNT(id_reservation) FROM reservation INNER JOIN utilisateur ON reservation.email_reservant = utilisateur.email GROUP BY email_reservant ORDER BY COUNT(id_reservation) DESC");
        ?><h3>
        <?php
        while($donnees = $requete->fetch()) {
            if($donnees['COUNT(id_reservation)'] == 1){
                echo $donnees['COUNT(id_reservation)'] . " réservation : ". $donnees['nom'] . " " . $donnees['prenom'];
                echo '<br>';
            }
            else{
                echo $donnees['COUNT(id_reservation)'] . " réservations : ". $donnees['nom'] . " " . $donnees['prenom'];
                echo '<br>';
            }
        }?>
</h3><?php
    }

    if(isset($_POST['consulter'])){
        $membre = $_POST['membre'];
        $terrains_reserves= $bdd->query("SELECT * FROM reservation INNER JOIN terrain INNER JOIN horaire ON reservation.ID_terrain = terrain.ID AND reservation.ID_horaire = horaire.ID_horaire WHERE email_reservant = '$membre'");
        while($donnees_terrains = $terrains_reserves->fetch()) {
            ?>
            <p>Nom du terrain: <?php echo $donnees_terrains['nom'];?>
            <br/>Adresse du terrain : <?php echo $donnees_terrains['adresse'];?>
            <br/>Jour de réservation : <?php echo $donnees_terrains['jour']; echo '<br/>Début : '; echo $donnees_terrains['debut']; echo ' /  Fin : '; echo $donnees_terrains['fin'];?></>
            <br/>Email du réservant : <?php echo $donnees_terrains['email_reservant'];?>
            <br/>Est en double ou non : <?php echo $donnees_terrains['est_en_double'];?>
            <br/>ID du terrain : <?php echo $donnees_terrains['ID_terrain'];?>
            <br/>ID de l'horaire : <?php echo $donnees_terrains['ID_horaire'];?>
            <br/>ID de la réservation : <?php echo $donnees_terrains['ID_reservation'];?>
            </p>
            <?php
            echo'<br/>';
        }
    }
}
else{

    $terrains_reserves= $bdd->query("SELECT * FROM reservation INNER JOIN terrain INNER JOIN horaire ON reservation.ID_terrain = terrain.ID AND reservation.ID_horaire = horaire.ID_horaire WHERE email_reservant = '$email'");
    while($donnees_terrains = $terrains_reserves->fetch()) {
        ?>
        <p>
        ID de la réservation : <?php echo $donnees_terrains['ID_reservation'];?>
        <br/> Nom du terrain: <?php echo $donnees_terrains['nom'];?>
        <br/>Adresse du terrain : <?php echo $donnees_terrains['adresse'];?>
        <br/>Jour de réservation : <?php echo $donnees_terrains['jour']; echo '<br/>Début : '; echo $donnees_terrains['debut']; echo ' /  Fin : '; echo $donnees_terrains['fin'];?></>
        </p>
        <?php
        echo'<br/>';
    }

    $requete = $bdd->query("SELECT ID_reservation FROM `reservation` WHERE email_reservant = '$email'");
    $donnees = $requete->fetch();
    if($donnees != NULL){

        ?><FORM method="post">
            <TD>
                <INPUT class ="annuler" type="submit" value="Annuler une réservation" name="annuler_reservation">
            </TD>
        </FORM>
        <?php
    }
    ?>


<?php

if(isset($_POST['annuler_reservation'])){
    echo "  <FORM method=post>";

    $requete = $bdd->query("SELECT ID_Reservation FROM reservation WHERE email_reservant = '$email'");

    echo"
		<h3><label class = 'text' for='equipe'>ID de la réservation :</label></h3>
		<select class = 'id' name='id'>";


    while($donnees = $requete->fetch()){

        echo "<option  value = ".$donnees["ID_Reservation"]."> ".$donnees["ID_Reservation"]." </option>";
    }

    echo "</select>"; ?>


        <br/>
            <TR>
                <TD class="valider" COLSPAN=2>
                    <INPUT class="succes" type="submit" value="Valider" name="valider">
                </TD>
            </TR>
    </FORM>
    <?php
}
if(isset($_POST['valider'])){
    $id_reservation = $_POST['id'];

    $requete = $bdd->query("UPDATE horaire SET est_bloque = 0, est_disponible = 1 WHERE ID_horaire = (SELECT ID_horaire FROM reservation WHERE ID_reservation = $id_reservation)");


    $requete = $bdd->query("DELETE FROM `contenu_reservation_users` WHERE ID_reservation = '$id_reservation'");
    $requete = $bdd->query("DELETE FROM reservation WHERE ID_reservation = '$id_reservation'");

    ?>
<p class = "succes">Réservation annulée avec succès !</p>
<?php
}
}

?>

<a class = "retour" href="../Utilisateur/utilisateur.php">Retour à l'espace Utilisateur</a>;
</body>
</html>



