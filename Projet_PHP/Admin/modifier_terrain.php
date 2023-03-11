<?php
		include('../Admin/admin.php');

		$bdd = new PDO("mysql:host=localhost;dbname=badminton;charset=utf8", "root", "");

        $num = $_SESSION['terrain'];
        $nom = $_POST['nom_terrain'];
        $adresse = $_POST['adresse_terrain'];
        $alInterieur = $_POST['estInt'];
		
		if(isset($_POST['estInt'])) {
			$alInterieur = 1;
		}
        else{
            $alInterieur = 0;
        }

		$requete = $bdd->prepare("UPDATE terrain SET nom = ?, adresse = ?, est_a_l_interieur = ?, est_ouvert = ?  WHERE ID = ?");
		
		$result = $requete->execute([$nom, $adresse, $alInterieur, $num]);

        header('Location: ../Admin/admin.php');
		
		?>