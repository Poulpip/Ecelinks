<!DOCTYPE html>
<html>

<head>
    <title>Exercice 2 - Liste des joueurs</title>
    <meta charset="utf-8">
    <link href="projet.css" rel="stylesheet" type="text/css" />
    <?php
    $database = "id20830431_reseau_social";
    $db_handle = mysqli_connect('localhost', 'id20830431_ecelinks', 'Ecelink1!', $database);
    
    $mail = isset($_POST["mail"])? $_POST["mail"] : "";
    $mdp = isset($_POST["mdp"])? $_POST["mdp"] : "";
    if (empty($mail)) {
        $mail = 0;
    }
    if (empty($mdp)) {
        $mdp = 0;
    }

    $db_found = mysqli_select_db($db_handle, $database);

    ?>
</head>

<body>
    <div id="container">
        <h1>INFO:</h1>
        <div id="content-container">
            <?php
            $sql = "SELECT * FROM utilisateurs WHERE email ='$mail' AND mot_de_passe='$mdp'"; 
            $result = mysqli_query($db_handle, $sql);
            if (mysqli_num_rows($result) > 0){
                echo "<p>Requête: " . $sql . "<br>";
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
                $redirectUrl = "vous.php?id=" . urlencode($id) . "&pseudo=" . urlencode($pseudo);
                header("Location: " . $redirectUrl);
                exit;

            }
            else{
                echo "<p>Le mail: " . $mail ."<p>et le mot de passe: " . $mdp ."<p>ne sont associés à aucun compte: " . "<br>"; 
                echo "Cliquez <a href=\"login.html\">ici</a>: pour réésayer";
            }
            
            


            ?>
        </div>
    </div>
</body>

<?php
// On ferme la connexion à la base de données
mysqli_close($db_handle);
?>

</html>
