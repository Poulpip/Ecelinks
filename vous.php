<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="projet.css">
	<?php
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
	$supprimer = "supprimer.php?id=" . urlencode($id) . "&pseudo=" . urlencode($pseudo);
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
	<div id="container">
        <h1>INFO:</h1>
        <div id="content-container">
            <?php
            $sql = "SELECT * FROM utilisateurs WHERE id='$id'"; 
            $result = mysqli_query($db_handle, $sql);
            if (mysqli_num_rows($result) > 0){
                echo "<br>";
                echo "<table border=\"1\">";
                echo "<tr>";
                echo "<th>" . "ID" . "</th>";
                echo "<th>" . "Pseudo" . "</th>";
                echo "<th>" . "Mail" . "</th>";
                echo "<th>" . "Mot de passe" . "</th>";
                echo "<th>" . "Nom" . "</th>";
               
                echo "</tr>";

                while ($data = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $data['id'] . "</td>";
                    echo "<td>" . $data['pseudo'] . "</td>";
                    echo "<td>" . $data['email'] . "</td>";
                    echo "<td>" . $data['mot_de_passe'] . "</td>";
                    echo "<td>" . $data['nom_complet'] . "</td>";
                    echo "</tr>";
                    $id = $data['id'];
                    $pseudo = $data['pseudo'];
                }   
                echo "</table>";
            }
            ?>
        </div>
    </div>
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