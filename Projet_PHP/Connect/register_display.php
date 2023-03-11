<!DOCTYPE html>
<html lang = "fr">

<head>
    <meta charset = "UTF-8">
    <link rel="stylesheet" href ="../CSS/register.css">
    <title>Inscription</title>

</head>

<body>


<?php
ob_start();
?>

<h1><strong>Bienvenue au club de Badminton !</strong></h1>

<FORM method="post">

    <h2><strong>Enregistrement d'un nouvel utilisateur</strong></h2>

    <TABLE BORDER=0>
        <TR>
            <TD>Nom</TD>
            <TD>
                <input class = "donnees" type="text" name = "nom" required>
            </TD>
        </TR>

        <TR>
            <TD>Prénom</TD>
            <TD>
                <INPUT class = "donnees" type=text name="prenom" required>
            </TD>
        </TR>

        <TR>
            <TD>Date Naissance</TD>
            <TD>
                <input class = "donnees" type="date" id="start" name="trip-start"
                       min="1900-01-01" required>
            </TD>
        </TR>

        <TR>
        <TR>
            <TD>Adresse</TD>
            <TD>
                <INPUT class = "donnees" type=text name="Adresse" required>
            </TD>
        </TR>
        <TR>

        <TR>
        <TR>
            <TD>Numéro de Téléphone</TD>
            <TD>
                <INPUT class = "donnees" type=text name="num_tel" required minlength="10" maxlength="10" required>
            </TD>
        </TR>
        <TR>

        <TR>
            <TD>Email</TD>
            <TD>
                <INPUT class = "donnees" type=text name="email" required>
            </TD>
        </TR>

        <TR>
            <TD>Mot De passe (minimun 8 caractères)</TD>
            <TD>
                <input class = "donnees" type="password" id="pass" name="password"
                       minlength="8" required>
            </TD>
        </TR>

        <TD class="valider" COLSPAN=2>
            <INPUT  class = "donnees_valider" type="submit" value="Valider" name="change">
        </TD>
    </TABLE>
</FORM>

<br>



<?php
if(isset($_POST['change'])) {
    ob_end_clean();
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $adresse = $_POST['Adresse'];
    $tel = $_POST['num_tel'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $date = $_POST['trip-start'];

    $bdd = new PDO("mysql:host=localhost;dbname=badminton;charset=utf8", "root", "");

    $count = $bdd->exec("INSERT INTO `utilisateur` (`email`, `nom`, `prenom`, `date_de_naissance`, `num_telephone`, `adresse`, `mot_de_passe`,`est_administrateur`) 
	VALUES ('$email', '$nom', '$prenom', '$date', '$tel', '$adresse', '$password', '0')");

    header("Location: connect_display.php");
}

?>

</body>



</html>

