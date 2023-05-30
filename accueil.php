<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="projet.css">
	<?php
    // Identifier le nom de base de données
	$database = "id20830431_reseau_social";
    $db_handle = mysqli_connect('localhost', 'id20830431_ecelinks', 'Ecelink1!', $database);
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

	<nav >
	<a href="index.html">Accueil</a>
	 <a href="monreseau.html">Mon reseau</a>
	 <a href="vous.html">Vous</a>
	 <a href="notif.html">Notifications</a>
	 <a href="messagerie.html">Messagerie</a>
	 <a href="emplois.html">Emplois</a>
	</nav>
	<?php

		echo "ID: " . $id . "<br>";
		echo "Pseudo: " . $pseudo;
	?>
	<section>
		<p>Accueil 
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