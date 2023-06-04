<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Emplois</title>
	<link rel="stylesheet" type="text/css" href="projet.css">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">


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
	<style>
		.headerEmplois
		{
			text-align: center;
			padding-top: 30px;
			padding-bottom: 30px;
		}


		/* Couleur bleu ECE : #007179 */

		.navigation
		{
			text-align: center;
			pading:0.5em;text-indent:8em
		}

		#accueil:hover, #emplois:hover, #messagerie:hover, #notif:hover, #monreseau:hover, #vous:hover
		{
			opacity: 50%;
		}

		.prout
		{
			text-align: center;
			color: whitesmoke;
			font-size: xx-large;
			font-family: Calibri light;
			padding-bottom: 25px;
			padding-top: 25px;
		}

		.contact
		{
			font-family: Calibri light;
			text-align: center;
			position: relative;
			color: whitesmoke;
			padding-bottom: 20px;
			padding-top: 20px;
			font-weight: bold;
			background-color: #00A0AB;
		}

		.sectionEmplois
		{
			background-color: #007179;
			text-align: center;
		}

		#profMaths, #Vigile, #Sony, #Armee
		{
			background-color: whitesmoke;
		}


		#CMOmnes, #Airbus, #Ferrari, #Avenir
		{
			background-color: white;
		}

		.page-footer
		{
			background-color: #004045;
			color: white;
			padding-top: 20px;
			padding-bottom: 20px;
		}
		body{
			background: linear-gradient(to right, #0f2027, #2b5876, #4e4376);
		}
		/*
		nav{
			clear: both;
		}

		body{
			color: #003300;
			background-color: whitesmoke;
		}

		.log:hover img{
			opacity: 50%;
		}

		#emplois{
			margin-right: 100px;
		}
		*/
	</style>
	<!-- Logo et 6 images de la barre de navigation -->

	<header class = "headerEmplois">

		<div id="logo" class="logo">
			<a href="<?php echo $accueil; ?>">
				<img  src="image\logo.webp" height="100" width="300">
			</a>
		</div>

	</header>

	<!-- Autre barre de navigation -->

	<nav class = "navEmplois">

		<div class="navigation">

			<a href="<?php echo $accueil; ?>" id = "accueil">
				<img  src="image\acceuil.png">
			</a>

			<a href="<?php echo $monreseau; ?>" id = "monreseau">
				<img  src="image\monreseau.png">
			</a>

			<a href="<?php echo $vous; ?>" id = "vous">
				<img  src="image\vous.png">
			</a>

			<a href="<?php echo $notif; ?>" id = "notif">
				<img  src="image\notif.png">
			</a>

			<a href="<?php echo $messagerie; ?>" id = "messagerie">
				<img  src="image\messagerie.png">
			</a>

			<a href="<?php echo $emplois; ?>" id = "emplois">
				<img  src="image\emplois.png">
			</a>

		</div>

	</nav>

	<br>

	<!-- Section -->

	<section class = "sectionEmplois">

		<h1 class = "prout">Emplois</h1>

		<p class= "contact">Liste des emplois disponibles :</p>

		<div class = "container fluid features" id = "listeEmplois">

			<div class = "row">

				<div class="col-sm-3" id = "profMaths">

					<br>

					<h3 class="feature-title">Professeur de mathématiques</h3>

					<br>

					<img src="image\prof-maths.jpg" class="img-fluid">

					<br><br>

					<p>Deviens prof de maths ! 🤑</p>

				</div>

				<div class="col-sm-3" id = "CMOmnes">

					<br>

					<h3 class="feature-title">Community Manager OMNES</h3>

					<br>

					<img src="image\CM.jpg" class="img-fluid">

					<br><br>

					<p>Développe l'image d'OMNES sur les réseaux !</p>

				</div>

				<div class="col-sm-3" id = "Vigile">

					<br>

					<h3 class="feature-title">Vigile à l'ECE</h3>

					<br>

					<img src="image\Vigile.webp" class="img-fluid">

					<br><br>

					<p>Pour renforcer la sécurité à l'école</p>

				</div>

				<div class="col-sm-3" id = "Airbus">

					<br>

					<h3 class="feature-title">Stage chez Airbus</h3>

					<img src="image\Airbus.jpg" class="img-fluid">
					<p>Stage de 6 mois - Construction avion de chasse</p>

				</div>

			</div>




			<div class = "row">

				<div class="col-sm-3" id = "Ferrari">

					<br>

					<h3 class="feature-title">Alternance chez Ferrari</h3>

					<br>

					<img src="image\Ferrari.jpg" class="img-fluid">

					<br><br>

					<p>Le monde de la F1 t'attend !</p>

				</div>

				<div class="col-sm-3" id = "Sony">

					<br>

					<h3 class="feature-title">CDI chez Sony</h3>

					<br>

					<img src="image\PS6.webp" class="img-fluid">

					<br><br>

					<p>Sur l'énorme projet de la PlayStation 6</p>

				</div>

				<div class="col-sm-3" id = "Avenir">

					<br>

					<h3 class="feature-title">Sous-chef du Concours Avenir</h3>

					<br>

					<img src="image\Avenir.png" class="img-fluid">

					<br><br>

					<p>Pour renforcer le prestige du concours n°1</p>

				</div>

				<div class="col-sm-3" id = "Armee">

					<br>

					<h3 class="feature-title">Ingénieur en cybersécurité à l'armée</h3>

					<img src="image\Armee.png" class="img-fluid">
					<p>Réservé aux plus compétents</p>

				</div>


			</div>

		</div>

		<br>

	</section>

	<!-- Footer -->

	<footer class="page-footer">

 		<div class="container">

 			<div class="row">

 			<div class="col-sm-12">

 				<br>

 				<h6 class="text-uppercase font-weight-bold">Contact</h6>
 				<p>37, quai de Grenelle, 75015 Paris, France <br> info@webDynamique.ece.fr <br> +33 01 02 03 04 05 <br> +33 01 03 02 05 04</p>

 			</div>

 			</div>

 			<div class="footer-copyright text-center">&copy; 2023 Copyright | Droits d'auteur: LinkECE.fr</div>

	</footer>

</body>
</html>
