<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="projet.css">
	<?php
    $database = "reseau_social";
    $db_handle = mysqli_connect('localhost', 'root', '', $database);
    $db_found = mysqli_select_db($db_handle, $database);
    $id = isset($_GET['id']) ? $_GET['id'] : '';
	$pseudo = isset($_GET['pseudo']) ? $_GET['pseudo'] : '';
	$accueil = "accueil.php?id=" . urlencode($id) . "&pseudo=" . urlencode($pseudo);
	$vous = "vous.php?id=" . urlencode($id) . "&pseudo=" . urlencode($pseudo);
	$emplois = "emplois.php?id=" . urlencode($id) . "&pseudo=" . urlencode($pseudo);
	$messagerie = "messagerie.php?id=" . urlencode($id) . "&pseudo=" . urlencode($pseudo);
	$monreseau = "monreseau.php?id=" . urlencode($id) . "&pseudo=" . urlencode($pseudo);
	$notif = "notif.php?id=" . urlencode($id) . "&pseudo=" . urlencode($pseudo);
    ?>
</head>

<body>
	<div id="logo" class="logo">
		<a href="<?php echo $accueil; ?>">
			<img src="image\logo.webp" height="100" width="300">
		</a>
		<br>

		<a href="<?php echo $accueil; ?>">
			<img src="image\acceuil.png">
		</a>

		<a href="<?php echo $monreseau; ?>">
			<img src="image\monreseau.png">
		</a>

		<a href="<?php echo $vous; ?>">
			<img src="image\vous.png">
		</a>

		<a href="<?php echo $notif; ?>">
			<img src="image\notif.png">
		</a>

		<a href="<?php echo $messagerie; ?>">
			<img src="image\messagerie.png">
		</a>

		<a href="<?php echo $emplois; ?>">
			<img src="image\emplois.png">
		</a>
	</div>

	<?php
	echo "<a>" . "Mon ID: " . $id . "</a>";
	echo "<br>";
	echo "<a>" . "Mon pseudo: " . $pseudo. "</a>";
	echo "<br>";
	?>
	<div id="tableau">
		<?php
		$sql = "SELECT * FROM amis WHERE id_utilisateur_1 ='$id'"; 
	    $sql2 = "SELECT * FROM amis WHERE id_utilisateur_2 ='$id'"; 	
	    $result = mysqli_query($db_handle, $sql);
	    $result2 = mysqli_query($db_handle, $sql2);
	    if (mysqli_num_rows($result) > 0 || mysqli_num_rows($result2) > 0){
	    	echo "Mes amis: ";
	        echo "<br>";
	        echo "<table border=\"1\">";
	        echo "<tr>";
	        echo "<th>" . "Photo" . "</th>";
	        echo "<th>" . "Pseudo" . "</th>";
	        echo "<th>" . "Nom" . "</th>";
	        echo "<th>" . "Premier contact" . "</th>";
	        echo "<th>" . "ID" . "</th>";
	        echo "<th>" . "Amis depuis" . "</th>";
	        echo "</tr>";

	        while ($data = mysqli_fetch_assoc($result)) {
	            echo "<tr>";
	            $id2=$data['id_utilisateur_2'];
	            $sql_amis = "SELECT * FROM utilisateurs WHERE id = '$id2'";
	            $result_amis = mysqli_query($db_handle, $sql_amis);
	            while($data_amis = mysqli_fetch_assoc($result_amis)){
	            	echo '<td><a href="profil.php?id=' . $id . '&id2=' . $id2 .'&pseudo=' . $pseudo . '"><img src="' . $data_amis['image_profil'] . '" width="125" height="75"></a></td>'; 
		            echo "<td>" . $data_amis['pseudo'] . "</td>";
		            echo "<td>" . $data_amis['nom_complet'] . "</td>";
	            }
	            echo "<td>" . "J'ai fait le premier pas" . "</td>";
	            echo "<td>" . $data['id_utilisateur_2'] . "</td>";
	            echo "<td>" . $data['date_amitie'] . "</td>";
	            echo '<form action="message.php" method="post">';
	            echo '<input type="hidden" name="id2" value="' . $id2 . '">';
	            echo '<input type="hidden" name="id" value="' . $id . '">';
	            echo '<input type="hidden" name="pseudo" value="' . $pseudo . '">';
				echo "<td>" . '<input type="submit" name="bouton" value="Converser">'."</td>";
				echo '</form>';
	            echo "</tr>";
	            
	        }
	        while ($data2 = mysqli_fetch_assoc($result2)) {
	            echo "<tr>";
	            $id2=$data2['id_utilisateur_1'];
	            $sql_amis2 = "SELECT * FROM utilisateurs WHERE id = '$id2'";
	            $result_amis2 = mysqli_query($db_handle, $sql_amis2);
	            while($data_amis2 = mysqli_fetch_assoc($result_amis2)){
	            	echo '<td><a href="profil.php?id=' . $id . '&id2=' . $id2 .'&pseudo=' . $pseudo . '"><img src="' . $data_amis2['image_profil'] . '" width="125" height="75"></a></td>'; 
		            echo "<td>" . $data_amis2['pseudo'] . "</td>";
		            echo "<td>" . $data_amis2['nom_complet'] . "</td>";
		            echo "<td>" . $data_amis2['pseudo'] . " a fait le premier pas" . "</td>";
	            }
	            echo "<td>" . $data2['id_utilisateur_1'] . "</td>";
	            echo "<td>" . $data2['date_amitie'] . "</td>";
	            echo '<form action="message.php" method="post">';
	            echo '<input type="hidden" name="id2" value="' . $id2 . '">';
	            echo '<input type="hidden" name="id" value="' . $id . '">';
	            echo '<input type="hidden" name="pseudo" value="' . $pseudo . '">';
				echo "<td>" . '<input type="submit" name="bouton" value="Converser">'."</td>";
				echo '</form>';
	            echo "</tr>";
	            
	        }  
	        echo "</table>";
	    }
		?>
	</div>
	

	<footer>
<p class="contact">Linkece <br>
			67 avenue Marceau<br>
			75015 Paris<br> <br>
			(+33) 01 02 03 04 05 06
		</p>
	</footer>
</body>

</html>
