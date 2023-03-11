<html>
<head>

</head>
<body>

<?php
include('admin.php');

$bdd = new PDO("mysql:host=localhost;dbname=badminton;charset=utf8", "root", "");

$requete = $bdd->query("SELECT * FROM terrain");

if(isset($_POST['supprTerrain2'])){
    $id = $_POST['id_terrain'];

    $supprimer = $bdd->prepare("DELETE FROM `terrain`
WHERE `id` = ?");
    $supprimer->execute([$id]);

    header("Location: ../Admin/admin.php");

}
?>
</body>
</html>
