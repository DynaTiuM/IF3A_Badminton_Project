<!DOCTYPE html>

<html lang = "fr">

<head>
    <meta charset = "UTF-8">
    <link rel="stylesheet" href ="../CSS/connect_display.css">
    <title>Connexion</title>

</head>

<body>
<h1><strong>Connexion</strong></h1>

<FORM method="POST" class ="formulaire">

    <TABLE BORDER=0>
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

        <br>

        <TD class = "valider" COLSPAN=2>
            <INPUT class = "donnees_valider" type="submit" value="Valider" name="Valider">
        </TD>
        </TR>
    </TABLE>
</FORM>

<br>
<br>
<a href="register_display.php">Vous n'avez pas de compte ? Alors c'est par là !</a><br/>

</body>

</html>



<?php

session_start();


if(isset($_GET['deconnexion'])){
    if(session_status()==PHP_SESSION_ACTIVE){
        session_destroy();
        header('Location: connect_display.php');
    }
}

if(isset($_POST['Valider'])){

    $_SESSION['email'] = $_POST['email'];
    $_SESSION['password'] = md5($_POST['password']);

    header('Location: ../Utilisateur/utilisateur.php');
}

?>