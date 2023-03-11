<html lang="fr">
<head>
    <meta charset = "UTF-8">
    <link rel="stylesheet" href ="../CSS/utilisateur.css">
    <title>Espace utilisateur</title>
</head>
<body>
<h1>Espace Utilisateur</h1>
</body>
</html>

<?php
session_start();

$email = $_SESSION['email'];
$password = $_SESSION['password'];

$bdd = new PDO("mysql:host=localhost;dbname=badminton;charset=utf8", "root", "");

$requete = $bdd->prepare("SELECT count(*) FROM utilisateur WHERE utilisateur.mot_de_passe = ? AND utilisateur.email = ?");
$requete->execute([$password, $email]);

$count = $requete->fetchColumn();

if($count == 0) {
    echo '
        <p class ="mauvais_rouge">Mauvais Utilisateur / Mot de passe</p><br/>
         <a class = "mauvais" href="../Connect/connect_display.php">Réessayer</a>';
} else {

    $admin = $bdd->query("SELECT est_administrateur FROM utilisateur WHERE utilisateur.email = '$email'");
    $donnees = $admin->fetch();

    $requete = $bdd->prepare("SELECT COUNT(*) FROM `contenu-equipe` WHERE email_membre = ?");
    $requete->execute([$email]);

    $est_dans_une_equipe = $requete->fetchColumn();

    if( $donnees['est_administrateur'] == 1){
        echo '<p>
        <br/>
            <a href="../Utilisateur/update_display.php">Modifier les informations de votre compte</a><br/>
            <a href="../Utilisateur/search_adherent.php">Rechercher un adhérent</a><br/>
            <a href="../Utilisateur/consult_reservation.php">Horaires réservés</a><br/>
            <a href="../Utilisateur/consulter_tournoi.php">Consulter les résultats du tournoi</a><br/>
        <a href="../Admin/admin.php">Espace Administrateur</a>
        </p>';
    }
    else{
        echo '
        <p>
        <br/>
            <a href="../Utilisateur/update_display.php">Modifier les informations de votre compte</a><br/>
            <a href="../Utilisateur/search_adherent.php">Rechercher un adhérent</a><br/>
            <a href="../Utilisateur/horaire_chooser.php">Réserver un horaire</a><br/>
            <a href="../Utilisateur/consult_reservation.php">Horaires réservés</a><br/>
			<a href="../Utilisateur/consulter_tournoi.php">Consulter les résultats du tournoi</a><br/>';

        if($est_dans_une_equipe == 0) {
            echo '<a href="../Utilisateur/creer_equipe.php">Créer une équipe</a><br/>
				<a href="../Utilisateur/rejoindre_equipe.php">Rejoindre une équipe</a><br/>';
        } else {
            echo '<a href="../Utilisateur/consulter_equipe.php">Consuter son équipe</a><br/>';
        }
        echo '</p>';
    }

    if($email): ?>
        <a class = "deconnexion" href="../Connect/connect_display.php?deconnexion=deconnecter">Déconnexion</a>;
    <?php endif;
}
?>
