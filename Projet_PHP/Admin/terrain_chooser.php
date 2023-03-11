<html lang ="fr">
<head>
    <meta charset = "UTF-8">
    <link rel="stylesheet" href ="../CSS/terrain_chooser.css">
    <title>Terrain</title>
</head>
<body>
<?php

include '../Admin/admin.php';
ob_clean();

?>
<h2>Choisissez votre terrain</h2>
<?php

$email = $_SESSION['email'];
$bdd = new PDO("mysql:host=localhost;dbname=badminton;charset=utf8", "root", "");

$number_terrain = 0;

$requete = $bdd->query("SELECT * FROM terrain");

while($donnees = $requete->fetch()) {
    $button_name = "Terrain " . $donnees['ID'];
    echo '    <TR>
                 <TD>
                ';

    if(isset($_GET['action']) && $_GET['action'] == "bloquer") {
        echo '<a class="button" href="../Utilisateur/horaire_chooser.php?id=' . $donnees['ID'] . '">'.$button_name.'</a>';
    } else {
        echo '<a class="button" href="../Admin/acheter.php?id=' . $donnees['ID'] . '">'.$button_name.'</a>';
    }

    echo '</TD>
        </TR>
        <br>';

    $number_terrain = $number_terrain+1;
}

echo         '</TABLE>
                </FORM>';
?>

<a class = "retour" href="../Admin/admin.php">Retour à l'espace Administrateur</a>
</body>
</html>



