<html lang="fr">
<head>
    <meta charset = "UTF-8">
    <link rel="stylesheet" href ="../CSS/horaire_chooser.css">
    <title>Réservation terrain</title>
</head>
<body>
<h1>Horaires</h1>



<?php

session_start();

$bdd = new PDO("mysql:host=localhost;dbname=badminton;charset=utf8", "root", "");

$email = $_SESSION['email'];

$admin = $bdd->prepare("SELECT count(*) FROM utilisateur WHERE utilisateur.email = ? AND utilisateur.est_administrateur = 1");
$admin->execute([$email]);


$est_admin = $admin->fetchColumn();

$num_members = 0;




//Si admin, cela veut dire qu'on bloque l'horaire
if($est_admin == 1){
    $id_terrain = $_GET['id'];

    echo "  <FORM method=post>
		<br />
		<br />
		<label for='Jours'>Horaires disponibles:</label>
		<select class ='don' id='Jours' name='Jours'>";

    $requete = $bdd->prepare("SELECT ID_horaire, jour, debut, fin from horaire WHERE ID_terrain = ? AND est_bloque = 0 AND est_disponible = 1");

    $result = $requete->execute([$id_terrain]);

    while($donnees = $requete->fetch()) {
        echo '<option value=' .$donnees['ID_horaire']. '>  '.$donnees['jour'].' - '.$donnees['debut'].' -  '.$donnees['fin'].'</option>';
    }

    echo "</select>";
}



//Sinon on reserve un horaire
if($est_admin == 0) {
	
    $nom_terrain = $bdd->query("SELECT ID FROM terrain");

    ob_start();
    echo "  <FORM method=post name ='Terrain'>
		<label for='Terrain'>Numéro du terrain :</label>
		<select class = 'don' id='Terrain' name='Terrain'>";

    while($donnees = $nom_terrain->fetch()) {
        echo '<option>'.$donnees['ID'].'</option>';
    }
    echo "</select>";


echo '

	<TR>
    <TD class="valider">
    <INPUT  class = "valid" type="submit" value="Consulter" name="Consulter">
    </TD>
    </TR>
';

    if(isset($_POST['Consulter'])){
        header('Location: ../Utilisateur/horaire_chooser.php?id='.$_POST['Terrain']);
    }

    if(isset($_POST['ValiderHoraire'])){
        header('Location: ../Utilisateur/horaire_chooser.php?horaire='.$_POST['Jours']);
    }

    if(isset($_GET['id'])){
        ob_clean();
        ob_start();

        $bdd = new PDO("mysql:host=localhost;dbname=badminton;charset=utf8", "root", "");

        $id_terrain = $_GET['id'];
        $_SESSION['Terrain'] = $id_terrain;

        
		echo"
		<FORM method=post>
		<label for='Jours'>Horaires disponibles :</label>
		<select class = 'don' id='Jours' name='Jours'>
		";


        $requete = $bdd->prepare("SELECT ID_horaire, jour, debut, fin from horaire WHERE ID_terrain = ? AND est_bloque = 0 AND est_disponible = 1");

        $result = $requete->execute([$id_terrain]);

        while($donnees = $requete->fetch()) {
            echo '<option value=' .$donnees['ID_horaire']. '>  '.$donnees['jour'].' - '.$donnees['debut'].' -  '.$donnees['fin'].'</option>';

        }

        echo "</select>";



echo '

		<TR>
        <TD class="valider">
        <INPUT class ="valid" type="submit" value="Valider" name="ValiderHoraire">
        </TD>
		</TR>
';

    }
    if(isset($_GET['horaire'])){

        ob_clean();
        ob_start();

        $_SESSION['Jours'] = $_GET['horaire'];


        echo "  <FORM method=post>
		<br />
		<label for='membres'>Avec combien de membres faites-vous la réservation ?</label>
		<select class ='don' id='membres' name='membres'>
		<option>1</option>
		<option>2</option>
		<option>3</option>";


        echo "</select>";
        echo '		
				<br>
				<INPUT type="submit" class = "valid" value="Confirmer le nombre de membres" name="validerMembres">
				</FORM>';

    }

    if(isset($_POST['validerMembres'])) {

        ob_clean();
        ob_start();
            $num_members = $_POST['membres'];

            echo "  <FORM method=post>
					<br />
					<br />";

            for($i = 1; $i <= $num_members; $i = $i + 1) {
                $requete = $bdd->prepare("SELECT email, prenom, nom from utilisateur WHERE email != ?");
				$requete->execute([$_SESSION['email']]);


                echo"
						<label for='membre$i'>Membre $i:</label>
						<select class ='don' id='membre$i' name='membre$i'>
						</br>
						";


                while($donnees = $requete->fetch()) {
                    echo '<option value=' .$donnees['email']. '>  '.$donnees['prenom'].' '.$donnees['nom'].'</option>';
                }

                echo "</select>";
            }

echo "

		<INPUT type='hidden' value='$num_members' name='num_members'>

		<br>
		<INPUT type='submit' class ='valid' value='Valider le contenu de la réservation' name='validerContenu'>
		</FORM>
";


    }
    if(isset($_POST['validerContenu'])) {
		
		$id_reservation = -1;

		$requete = $bdd->prepare("UPDATE horaire SET est_bloque = 1 WHERE ID_horaire = ?");
        $requete->execute([$_SESSION['Jours']]);
        $requete = $bdd->prepare("UPDATE horaire SET est_disponible = 0 WHERE ID_horaire = ?");
        $requete->execute([$_SESSION['Jours']]);
		
        $reservation = $bdd->prepare("INSERT INTO reservation (ID_terrain,ID_horaire,est_en_double,email_reservant) VALUES (?,?,?,?)");
        $reservation->execute([$_SESSION['Terrain'],$_SESSION['Jours'],1,$email]);
		
		
		$getid = $bdd->prepare("SELECT ID_reservation FROM reservation WHERE email_reservant = ? ORDER BY ID_reservation DESC LIMIT 1");
		$getid->execute([$_SESSION['email']]);
		
		$donnees = $getid->fetch();
		$id_reservation = $donnees['ID_reservation'];
		
		$requete = $bdd->query("INSERT INTO `contenu_reservation_users` (`ID_reservation`, `email_membre`) VALUES ('$id_reservation', '$email')");
		
		
		for($i = 1; $i <= $_POST['num_members']; $i = $i + 1) {
			
			$membres = $_POST['membre'.$i];	
			$requete = $bdd->query("INSERT INTO `contenu_reservation_users` (`ID_reservation`, `email_membre`) VALUES ('$id_reservation', '$membres')");
			
		}

        header("Location: ../Utilisateur/utilisateur.php");
   }
}





if($est_admin==1){
    echo '  
			<FORM method="post">
				<TABLE BORDER=0>
				
				<TR>
 				<TD>
				<INPUT class ="valid" type="submit" value="Bloquer un horaire" name="bloqueHoraire">
 				</TD>
				</TR>

				</TABLE>
				</FORM>';


    if(isset($_POST['bloqueHoraire'])) {

        $requete = $bdd->prepare("UPDATE horaire SET est_bloque = 1 WHERE ID_horaire = ?");
        $requete->execute([$_POST['Jours']]);



        header("Location: ../Admin/admin.php");
    }
}

if($est_admin==1){
    echo '<a class = "retour" href="../Admin/admin.php">Retour à l\'espace Administrateur</a>';
}
else{
    echo '<a class = "retour" href="../Utilisateur/utilisateur.php">Retour à l\'espace Utilisateur</a>';
}

?>


</body>
</html>

