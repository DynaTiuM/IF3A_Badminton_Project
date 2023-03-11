<?php
include('admin.php');

$bdd = new PDO("mysql:host=localhost;dbname=badminton;charset=utf8", "root", "");

if(isset($_POST['ajtTerrain2'])){
    $nom = $_POST['nom_terrain'];
    $adresse_terrain = $_POST['adresse_terrain'];

    $ajouter = $bdd->prepare("INSERT INTO terrain VALUES (NULL,?,?,1)");
    $ajouter->execute([$nom, $adresse_terrain]);
	
	$requete = $bdd->prepare("SELECT ID FROM terrain WHERE nom = ?");
	$requete->execute([$nom]);
	$donnees = $requete->fetch();
	
	$id = $donnees['ID'];

$requete = $bdd->query("INSERT INTO `horaire` (`ID_horaire`, `jour`, `debut`, `fin`, `ID_terrain`, `est_bloque`, `est_disponible`) VALUES
(NULL, 'Lundi', '08:00', '09:00', $id, 1, 1),
(NULL, 'Lundi', '09:01', '10:00', $id, 0, 0),
(NULL, 'Lundi', '10:01', '11:00', $id, 0, 1),
(NULL, 'Lundi', '11:01', '12:00', $id, 0, 1),
(NULL, 'Lundi', '12:01', '13:00', $id, 0, 1),
(NULL, 'Lundi', '14:00', '15:00', $id, 0, 1),
(NULL, 'Lundi', '15:01', '16:00', $id, 0, 1),
(NULL, 'Lundi', '16:01', '17:00', $id, 0, 1),
(NULL, 'Lundi', '17:01', '18:00', $id, 0, 1),
(NULL, 'Lundi', '18:01', '19:00', $id, 0, 1),
(NULL, 'Lundi', '20:00', '21:00', $id, 0, 1),
(NULL, 'Lundi', '21:01', '22:00', $id, 0, 1),
(NULL, 'Mardi', '08:00', '09:00', $id, 0, 1),
(NULL, 'Mardi', '09:01', '10:00', $id, 0, 1),
(NULL, 'Mardi', '10:01', '11:00', $id, 0, 1),
(NULL, 'Mardi', '11:01', '12:00', $id, 0, 1),
(NULL, 'Mardi', '12:01', '13:00', $id, 0, 1),
(NULL, 'Mardi', '14:00', '15:00', $id, 0, 1),
(NULL, 'Mardi', '15:01', '16:00', $id, 0, 1),
(NULL, 'Mardi', '16:01', '17:00', $id, 0, 1),
(NULL, 'Mardi', '17:01', '18:00', $id, 0, 1),
(NULL, 'Mardi', '18:01', '19:00', $id, 0, 1),
(NULL, 'Mardi', '20:00', '21:00', $id, 0, 1),
(NULL, 'Mardi', '21:01', '22:00', $id, 0, 1),
(NULL, 'Mercredi', '08:00', '09:00', $id, 0, 1),
(NULL, 'Mercredi', '09:01', '10:00', $id, 0, 1),
(NULL, 'Mercredi', '10:01', '11:00', $id, 0, 1),
(NULL, 'Mercredi', '11:01', '12:00', $id, 0, 1),
(NULL, 'Mercredi', '12:01', '13:00', $id, 0, 1),
(NULL, 'Mercredi', '14:00', '15:00', $id, 0, 1),
(NULL, 'Mercredi', '15:01', '16:00', $id, 0, 1),
(NULL, 'Mercredi', '16:01', '17:00', $id, 0, 1),
(NULL, 'Mercredi', '17:01', '18:00', $id, 0, 1),
(NULL, 'Mercredi', '18:01', '19:00', $id, 0, 1),
(NULL, 'Mercredi', '20:00', '21:00', $id, 0, 1),
(NULL, 'Mercredi', '21:01', '22:00', $id, 0, 1),
(NULL, 'Vendredi', '08:00', '09:00', $id, 0, 1),
(NULL, 'Vendredi', '09:01', '10:00', $id, 0, 1),
(NULL, 'Vendredi', '10:01', '11:00', $id, 0, 1),
(NULL, 'Vendredi', '11:01', '12:00', $id, 0, 1),
(NULL, 'Vendredi', '12:01', '13:00', $id, 0, 1),
(NULL, 'Vendredi', '14:00', '15:00', $id, 0, 1),
(NULL, 'Vendredi', '15:01', '16:00', $id, 0, 1),
(NULL, 'Vendredi', '16:01', '17:00', $id, 0, 1),
(NULL, 'Vendredi', '17:01', '18:00', $id, 0, 1),
(NULL, 'Vendredi', '18:01', '19:00', $id, 0, 1),
(NULL, 'Vendredi', '20:00', '21:00', $id, 0, 1),
(NULL, 'Vendredi', '21:01', '22:00', $id, 0, 1)");
	
header("Location: ../Admin/admin.php");

}
?>