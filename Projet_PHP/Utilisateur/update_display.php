<!DOCTYPE html>
<html lang = "fr">
<head>
    <meta charset = "UTF-8">
    <link rel="stylesheet" href ="../CSS/update_display.css">
    <title>Modifications utilisateur</title>
</head>

<body>
<?php
session_start();

?>


<h1>Modification des informations</h1>
<h2><strong>Vous pouvez consulter et modifier vos informations ici !</strong></h2>
<h3>Vous modifiez les informations du compte : <?php echo $_SESSION['email'];?></h3>
<FORM method="post">
    <TABLE BORDER=0>


        <TR>
            <TD>Nom</TD>
            <TD>
                <INPUT class="donnees" value="<?php
                $email = $_SESSION['email'];
                $bdd = new PDO("mysql:host=localhost;dbname=badminton;charset=utf8", "root", "");
                $infos = $bdd->query("SELECT * FROM utilisateur WHERE utilisateur.email = '$email'");

                $donnees = $infos->fetch();

                echo $donnees['nom'];

                ?>" type=text name="nom" >
            </TD>
        </TR>

        <TR>
            <TD>Pr&eacute;nom</TD>
            <TD>
                <INPUT class="donnees" value ="<?php echo $donnees['prenom']; ?>" type=text name="prenom" required>
            </TD>
        </TR>

        <TR>
            <TD>Date Naissance</TD>
            <TD>
                <input class="donnees" type="date" id="start" name="trip-start" value="<?php echo $donnees['date_de_naissance'];?>"
                       min="1900-01-01" required>
            </TD>
        </TR>

        <TR>
        <TR>
            <TD>Adresse</TD>
            <TD>
                <INPUT class="donnees" value ="<?php
                echo $donnees['adresse'];
                ?>" type=text name="Adresse" required>
            </TD>
        </TR>
        <TR>

        <TR>
        <TR>
            <TD>Num&eacute;ro de T&eacute;l&eacute;phone</TD>
            <TD>
                <INPUT class="donnees" value ="<?php

                echo $donnees['num_telephone'];
                ?>" type=text name="num_tel" required minlength="10" maxlength="10" required>
            </TD>
        </TR>
        <TR>

        <TR>
            <TD>Mot de passe</TD>
            <TD>
                <input class="donnees" type="password" id="pass" name="password" minlength="8">
            </TD>

        </TR>

        <TD class="valider" COLSPAN=2>
            <INPUT class="donnees_valider" type="submit" value="Valider" name="change">
        </TD>
    </TABLE>
</FORM>
<a class = "retour" href="../Utilisateur/utilisateur.php">Retour &agrave; l'espace Utilisateur</a>

<?php


if(isset($_POST['change'])) {

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $adresse = $_POST['Adresse'];
    $tel = $_POST['num_tel'];
    $date_de_naissance = $_POST['trip-start'];
    $email = $_SESSION['email'];
    

    $bdd = new PDO("mysql:host=localhost;dbname=badminton;charset=utf8", "root", "");
	
	if(!empty($_POST['password'])) {
		$_SESSION['password'] = md5($_POST['password']);
		$requete = $bdd->prepare("UPDATE utilisateur SET nom = ?, prenom = ?, adresse = ?, num_telephone = ?, date_de_naissance = ?, mot_de_passe = ? WHERE utilisateur.email = ?");
		$requete->execute([$nom, $prenom, $adresse, $tel, $date_de_naissance, $_SESSION['password'], $email]);
	} else {
		$requete = $bdd->prepare("UPDATE utilisateur SET nom = ?, prenom = ?, adresse = ?, num_telephone = ?, date_de_naissance = ? WHERE utilisateur.email = ?");
		$requete->execute([$nom, $prenom, $adresse, $tel, $date_de_naissance, $email]);
	}

    header("Location: ../Utilisateur/utilisateur.php");
}
?>

</body>
</html>

