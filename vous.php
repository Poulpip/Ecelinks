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
	$id_admin = 0;
	$accueil = "accueil.php?id=" . urlencode($id) . "&pseudo=" . urlencode($pseudo);
	$vous = "vous.php?id=" . urlencode($id) . "&pseudo=" . urlencode($pseudo);
	$emplois = "emplois.php?id=" . urlencode($id) . "&pseudo=" . urlencode($pseudo);
	$messagerie = "messagerie.php?id=" . urlencode($id) . "&pseudo=" . urlencode($pseudo);
	$monreseau = "monreseau.php?id=" . urlencode($id) . "&pseudo=" . urlencode($pseudo);
	$notif = "notif.php?id=" . urlencode($id) . "&pseudo=" . urlencode($pseudo);
	$supprimer = "supprimer.php?id=" . urlencode($id) . "&pseudo=" . urlencode($pseudo). "&id_admin=" . urlencode($id_admin);
    ?>
</head>
<body>
	<div id="logo" class="logo">
		<a href="<?php echo $accueil; ?>">
			<img  src="image\logo.webp" height="100" width="300">
		</a>
	</div>

	<div id="accueil" class="log">
		<a href="<?php echo $accueil; ?>">
			<img  src="image\acceuil.png">
		</a>
	</div>
	<div id="monreseau" class="log">
		<a href="<?php echo $monreseau; ?>">
			<img  src="image\monreseau.png">
		</a>
	</div>
	<div id="vous" class="log">
	 	<a href="<?php echo $vous; ?>">
			<img  src="image\vous.png">
		</a>
	</div>
	<div id="notif" class="log">
	 	<a href="<?php echo $notif; ?>">
			<img  src="image\notif.png">
		</a>
	</div>
	<div id="messagerie" class="log">
	 	<a href="<?php echo $messagerie; ?>">
			<img  src="image\messagerie.png">
		</a>
	</div>
	<div id="emplois" class="log">
	 	<a href="<?php echo $emplois; ?>">
			<img  src="image\emplois.png">
		</a>
	</div>

	<nav>
		<div id="tableau">
	        <h1>INFO:</h1>
	        <div id="content-container">
	            <?php
	            $sql = "SELECT * FROM utilisateurs WHERE id='$id'"; 
	            $result = mysqli_query($db_handle, $sql);
	            if (mysqli_num_rows($result) > 0){
	                echo "<br>";
	                echo "<a>"."Moi"."</a>";
	                echo "<table border=\"1\">";
	                echo "<tr>";
	                echo "<th>" . "ID" . "</th>";
	                echo "<th>" . "Pseudo" . "</th>";
	                echo "<th>" . "Mail" . "</th>";
	                echo "<th>" . "Mot de passe" . "</th>";
	                echo "<th>" . "Nom" . "</th>";
	                echo "<th>" . "Photo" . "</th>";
	                echo "<th>" . "Description" . "</th>";
	                echo "<th>" . "Sentiment" . "</th>";
	                echo "<th>" . "Nombre d'amis" . "</th>";
	                echo "</tr>";

	                while ($data = mysqli_fetch_assoc($result)) {
	                    echo "<tr>";
	                    echo "<td>" . $data['id'] . "</td>";
	                    echo "<td>" . $data['pseudo'] . "</td>";
	                    echo "<td>" . $data['email'] . "</td>";
	                    echo "<td>" . $data['mot_de_passe'] . "</td>";
	                    echo "<td>" . $data['nom_complet'] . "</td>";
	                    echo "<td><img src=\"" . $data['image_profil'] . "\" width=\"100\" height=\"100\"></td>"; 
	                    echo "<td>" . $data['description'] . "</td>";
	                    echo "<td>" . $data['sentiment'] . "</td>";
	                    $sql2 = "SELECT COUNT(*) as nombre_amis FROM amis WHERE id_utilisateur_1='$id' OR id_utilisateur_2='$id' "; 
	            		$result2 = mysqli_query($db_handle, $sql2);
	            		if ($result2) { 
						    $data2 = mysqli_fetch_assoc($result2);
						    $nombre = $data2['nombre_amis'];
							echo  "<td>" .$nombre. "</td>";
						} else {
						  echo "Une erreur s'est produite lors de l'exécution de la requête.";
						}
	                    echo "</tr>";
	                    $id = $data['id'];
	                    $pseudo = $data['pseudo'];
	                }   
	                echo "</table>";
	            }
	            ?>
	        </div>
	    </div>

	    <div id="poster">
	    	<?php
	    	echo '<form action="form_poster.php" method="post">';
	        echo '<input type="hidden" name="id" value="' . $id . '">';
	        echo '<input type="hidden" name="pseudo" value="' . $pseudo . '">';
			echo "<td>" . '<input type="submit" name="bouton" value="Ajouter un post">'."</td>";
			echo '</form>';
			?>
	    </div>
	    <div id="event">
	    	<?php
	    	echo '<form action="form_evenement.php" method="post">';
	        echo '<input type="hidden" name="id" value="' . $id . '">';
	        echo '<input type="hidden" name="pseudo" value="' . $pseudo . '">';
			echo "<td>" . '<input type="submit" name="bouton" value="Ajouter un evenement">'."</td>";
			echo '</form>';
			?>
	    </div>
	    <div id="generer">
	    	<?php
	    	echo '<form action="generer.php" method="GET">';
	        echo '<input type="hidden" name="id" value="' . $id . '">';
	        echo '<input type="hidden" name="pseudo" value="' . $pseudo . '">';
			echo "<td>" . '<input type="submit" name="bouton" value="Generer mon CV">'."</td>";
			echo '</form>';
			?>
	    </div>

	    <div id="event">
	    	<?php
	    	echo '<form action="" method="POST">';
	        echo '<input type="text" name="description" placeholder="Description">';
	        echo '<input type="text" name="sentiment" placeholder="Sentiment">';
			echo "<td>" . '<input type="submit" name="envoyer" value="Envoyer">'."</td>";
			echo '</form>';
			?>
	    </div>

		<?php
		if (isset($_POST['envoyer'])) {
			// Récupérer les valeurs des champs du formulaire
		    $description = $_POST['description'];
		    $sentiment = $_POST['sentiment'];

			$sql = "UPDATE utilisateurs SET description='$description' WHERE id='$id'";
		  	if ($db_handle->query($sql) === TRUE) {
		  	} 
	      	else {
	      		echo "Erreur lors de l'enregistrement des données : " . $db->error;
		    }
		    $sql = "UPDATE utilisateurs SET sentiment='$sentiment' WHERE id='$id'";
		  	if ($db_handle->query($sql) === TRUE) {
		  		$url = "vous.php?id=" . urlencode($id) . "&pseudo=" . urlencode($pseudo);
	            header("Location: " . $url);
	            exit; 
		  	} 
	      	else {
	      		echo "Erreur lors de l'enregistrement des données : " . $db->error;
		    }
		}
		?>

	    <div class="blocs">
	    	<div class="bloc">
		    	<div id="tableau">
			    	<?php
		            $sql = "SELECT * FROM publications WHERE id_utilisateur='$id'"; 
		            $result = mysqli_query($db_handle, $sql);
		            if (mysqli_num_rows($result) > 0){
		                echo "<br>";
		                echo "<a>"."Mes publications:"."</a>";
		                echo "<table border=\"1\">";
		                echo "<tr>";
		                echo "<th>" . "Texte" . "</th>";
		                echo "<th>" . "Sentiment" . "</th>";
		                echo "<th>" . "Photo" . "</th>";
		                echo "<th>" . "Lieu" . "</th>";
		                echo "<th>" . "Lien" . "</th>";
		                echo "</tr>";

		                while ($data = mysqli_fetch_assoc($result)) {
		                    echo "<tr>";
		                    echo "<td>" . $data['texte'] . "</td>";
		                    echo "<td>" . $data['sentiment'] . "</td>";
		                    if($data['photo']==NULL){
		                    	echo "<td>" . "Pas de photo" . "</td>";
		                    }
		                    else{
		                    	echo "<td><img src=\"" . $data['photo'] . "\" width=\"100\" height=\"100\"></td>";
		                    }
		                    echo "<td>" . $data['lieu'] . "</td>";
		                    echo "<td>" . $data['url'] . "</td>";
		                    echo '<form action="supprimer_post.php" method="post">';
						    echo '<input type="hidden" name="id_post" value="' . $data['id'] . '">';
						    echo '<input type="hidden" name="id" value="' . $id . '">';
						    echo '<input type="hidden" name="pseudo" value="' . $pseudo . '">';
							echo "<td>" . '<input type="submit" name="supprimer" value="Supprimer">'."</td>";
							echo '</form>';
		                }   	
		                echo "</table>";
		            }
		            ?>
			    </div>

		    </div>
		    
		    <div class="bloc">
		    	<div id="tableau">
			    	<?php
		            $sql = "SELECT * FROM evenements WHERE id_utilisateur='$id'"; 
		            $result = mysqli_query($db_handle, $sql);
		            if (mysqli_num_rows($result) > 0){
		                echo "<br>";
		                echo "<a>"."Mes evenement:"."</a>";
		                echo "<table border=\"1\">";
		                echo "<tr>";
		                echo "<th>" . "Nom" . "</th>";
		                echo "<th>" . "Description" . "</th>";
		                echo "<th>" . "Photo" . "</th>";
		                echo "<th>" . "Lieu" . "</th>";
		                echo "<th>" . "Date" . "</th>";
		                echo "<th>" . "Heure" . "</th>";
		                echo "</tr>";

		                while ($data = mysqli_fetch_assoc($result)) {
		                    echo "<tr>";
		                    echo "<td>" . $data['nom'] . "</td>";
		                    echo "<td>" . $data['description'] . "</td>";
		                    if($data['image']==NULL){
		                    	echo "<td>" . "Pas de photo" . "</td>";
		                    }
		                    else{
		                    	echo "<td><img src=\"" . $data['image'] . "\" width=\"100\" height=\"100\"></td>";
		                    }
		                    echo "<td>" . $data['lieu'] . "</td>";
		                    echo "<td>" . $data['date_evenement'] . "</td>";
		                    echo "<td>" . $data['heure_evenement'] . "</td>";
		                }   	
		                echo "</table>";
		            }
		            ?>
			    </div>
		    </div>
	    </div>
	    
	    
	</nav>

	<div id="logout">
	 	<a href="login_signin.html">Log out</a>
	</div>

	<div id="sup">
	 	<a href="<?php echo $supprimer; ?>">Supprimer mon compte</a>
	</div>

	<section>
		<p>Vous 
		</p> 
		
		<p class="contact">Linkece <br>
			 67 avenue Marceau<br>
			 75015 Paris<br> <br>
			 (+33) 01 02 03 04 05 06
		</p>
	</section>
	<footer>
		
	</footer>
</body>
</html>
