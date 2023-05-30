<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link href="projet.css" rel="stylesheet" type="text/css" />
    <?php
     $database = "id20830431_reseau_social";
     $db_handle = mysqli_connect('localhost', 'id20830431_ecelinks', 'Ecelink1!', $database);
    $nom = isset($_POST["nom"])? $_POST["nom"] : "";
    $pseudo = isset($_POST["pseudo"])? $_POST["pseudo"] : "";
    $mail = isset($_POST["mail"])? $_POST["mail"] : "";
    $mdp = isset($_POST["mdp"])? $_POST["mdp"] : "";
    $id = isset($_POST["id"])? $_POST["id"] : "";
    $image_profil = isset($_POST["image_profil"])? $_POST["image_profil"] : "";
    $image_fond = isset($_POST["image_fond"])? $_POST["image_fond"] : "";

    $db_found = mysqli_select_db($db_handle, $database);
    if (empty($image_profil)) {
        $age = 0;
    }
    if (empty($image_fond)) {
        $age = 0;
    }

    ?>
</head>

<body>
    <div id="container">
        <h1>SIGN IN:</h1>
        <div id="content-container">
            <?php
            if (!empty($pseudo) && !empty($mail) && !empty($mdp) && !empty($nom)){
                $sql = "INSERT INTO utilisateurs (pseudo,email,mot_de_passe,nom_complet,image_profil,image_fond) VALUES ('$pseudo','$mail','$mdp','$nom','$image_profil','$image_fond')"; 
                if ($db_handle->query($sql) === TRUE) {
                    $sql = "SELECT * FROM utilisateurs ";
                    $result = mysqli_query($db_handle, $sql);
                    if (mysqli_num_rows($result) > 0){
                        while ($data = mysqli_fetch_assoc($result)) {
                            $id = $data['id'];
                        }   
                    }
                        $url = "vous.php?id=" . urlencode($id) . "&pseudo=" . urlencode($pseudo);
                        header("Location: " . $url);
                        exit;
                    } 
                else {
                    echo "Erreur lors de l'enregistrement des données : " . $db->error;
                }
            }
            else{
                echo "Veuillez remplir tous les champs.";
                $lien = "signin.html";
                echo "<a href=\"$lien\">Lien vers le formulaire</a>";
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
