<html lang = "fr">
<head>
    <meta charset = "UTF-8">
    <link rel="stylesheet" href ="../CSS/search_adherent.css">
    <title>Recherche d'un adhérent</title>
</head>
<body>
<h1>Recherche d'un adhérent</h1>
<?php

$bdd = new PDO("mysql:host=localhost;dbname=badminton;charset=utf8", "root", "");

if(isset($_POST['tri'])){
    header('Location: ../Utilisateur/search_adherent.php?tri');
}

if(isset($_POST['search'])){
    $valeur = $_POST['search'];
    $requete = $bdd->query("SELECT * FROM `utilisateur` WHERE prenom = '$valeur' OR nom ='$valeur'");
    ?><h2>Liste des membres</h2>
    <h3>
        <?php
        while($donnees = $requete->fetch()) {
            echo $donnees['nom'] ." " .$donnees['prenom'];
            echo '<br>';
        }?>
    </h3>
    <?php
}
else{
    if(isset($_GET['tri'])){

        $requete = $bdd->query("SELECT * FROM `utilisateur` ORDER BY `utilisateur`.`nom`, `utilisateur`.`prenom` ASC");
        ?><h2>Liste des membres</h2>

        <h3>
            <?php
            while($donnees = $requete->fetch()) {
                echo $donnees['nom'] ." " .$donnees['prenom'];
                echo '<br>';
            }?>
        </h3>
        <h4>Trié avec succès !</h4>
    <?php }
    else {
        $requete = $bdd->query("SELECT * FROM `utilisateur`");
        ?>
        <h2>Liste des membres</h2>
        <h3>
            <?php
            while($donnees = $requete->fetch()) {
                echo $donnees['nom'] ." " .$donnees['prenom'];
                echo '<br>';
            }?>
        </h3>

        <form method = "post">
            <input class = "valider" type = "submit" value ="Trier par ordre alphabétique" name ="tri">
        </form>
    <?php }

    ?>



<?php } ?>

<form method = "post">
    <input class = "valider" type = "text" value = "Rechercher un adhérent" name = "search">
</form>

<a class = "retour" href="../Utilisateur/utilisateur.php">Retour à l'espace Utilisateur</a>
</body>
</html>
