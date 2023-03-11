<?php

include "admin.php";
ob_clean();
ob_start();

$bdd = new PDO("mysql:host=localhost;dbname=badminton;charset=utf8", "root", "");
$requete = $bdd->query("SELECT * FROM equipe");

?><h5>
    <?php
while($donnees = $requete->fetch()) {
        echo 'Equipe n°';
        echo $donnees['id_equipe'], ' : ', $donnees['Nom'];
        echo '<br>';
}
    ?></h5>
<?php

echo '

<FORM method="POST">

    <TABLE BORDER=0>

		<TR>
            <TD>ID de l\'équipe 1</TD>
            <TD>
                <INPUT class = "text" type="number" name="equipe1">
            </TD>
        </TR>
		
		<TR>
            <TD>Score de l\'équipe 1</TD>
            <TD>
                <INPUT class = "text" type="number" name="score1">
            </TD>
        </TR>
		
		<TR>
            <TD>ID de l\'équipe 2</TD>
            <TD>
                <INPUT class = "text" type="number" name="equipe2">
            </TD>
        </TR>

        <TR>
            <TD>Score de l\'équipe 2</TD>
            <TD>
                <INPUT class = "text" type="number" name="score2">
            </TD>
        </TR>

        <br>

        
    </TABLE>
    <TD COLSPAN=2>
            <INPUT class = "valid" type="submit" value="Valider" name="Valider">
        </TD>
        </TR>
</FORM>
';

if(isset($_POST['Valider'])) {
	
	$equipe1 = $_POST['equipe1'];
	$equipe2 = $_POST['equipe2'];
	$score1 = $_POST['score1'];
	$score2 = $_POST['score2'];
	$requete = $bdd->query("INSERT INTO `match` (`id_match`, `id_equipe1`, `score1`, `id_equipe2`, `score2`) VALUES (NULL, '$equipe1', '$score1', '$equipe2', '$score2')");
}

?>


<a class = "retour" href="../Admin/Admin.php">Retour à l'espace Administrateur</a>
