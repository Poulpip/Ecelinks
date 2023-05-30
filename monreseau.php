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
	<a href="accueil.html">Accueil</a>
	 <a href="monreseau.html">Mon reseau</a>
	 <a href="vous.html">Vous</a>
	 <a href="notif.html">Notifications</a>
	 <a href="messagerie.html">Messagerie</a>
	 <a href="emplois.html">Emplois</a>
	</nav>

	<?php
	echo "Mon ID: " . $id . "<br>";
	echo "Mon pseudo: " . $pseudo. "<br>";
	echo "Autre utilisateur de Linkece que vous pouuriez connaitre: ";
    $sql = "SELECT * FROM utilisateurs WHERE id !='$id'"; 
    $result = mysqli_query($db_handle, $sql);
    if (mysqli_num_rows($result) > 0){
        echo "<br>";
        echo "<table border=\"1\">";
        echo "<tr>";
        echo "<th>" . "ID" . "</th>";
        echo "<th>" . "Pseudo" . "</th>";
        echo "<th>" . "Nom" . "</th>";
        echo "</tr>";

        while ($data = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $data['id'] . "</td>";
            echo "<td>" . $data['pseudo'] . "</td>";
            echo "<td>" . $data['nom_complet'] . "</td>";
            $id2 = $data['id'];

            echo '<form action="ajouter.php" method="post">';
            echo '<input type="hidden" name="id2" value="' . $id2 . '">';
            echo '<input type="hidden" name="id" value="' . $id . '">';
            echo '<input type="hidden" name="pseudo" value="' . $pseudo . '">';
			echo "<td>" . '<input type="submit" name="bouton" value="Ajouter">'."</td>";
			echo '</form>';
            echo "</tr>";
            
        }   
        echo "</table>";
    }
    echo "Mes amis: ";
    $sql = "SELECT * FROM amis WHERE id_utilisateur_1 ='$id' OR id_utilisateur_2 ='$id'"; 
    $result = mysqli_query($db_handle, $sql);
    if (mysqli_num_rows($result) > 0){
        echo "<br>";
        echo "<table border=\"1\">";
        echo "<tr>";
        echo "<th>" . "ID" . "</th>";
        echo "<th>" . "Pseudo" . "</th>";
        echo "<th>" . "Nom" . "</th>";
        echo "</tr>";

        while ($data = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $data['id_utilisateur_2'] . "</td>";
            $id_amis=$data['id_utilisateur_2'];
            $sql_amis = "SELECT * FROM utilisateurs WHERE id = '$id_amis'";
            $result_amis = mysqli_query($db_handle, $sql_amis);
            while($data_amis = mysqli_fetch_assoc($result_amis)){
	            echo "<td>" . $data_amis['pseudo'] . "</td>";
	            echo "<td>" . $data_amis['nom_complet'] . "</td>";
            }
            echo "</tr>";
            
        }   
        echo "</table>";
    }
    ?>
	<section>
		<p>
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