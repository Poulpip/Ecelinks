<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="projet.css">
    <?php
    $database = "id20830431_reseau_social";
    $db_handle = mysqli_connect('localhost', 'id20830431_ecelinks', 'Ecelink1!', $database);
    $db_found = mysqli_select_db($db_handle, $database);
    $id = isset($_GET['id']) ? $_GET['id'] : '';
    $pseudo = isset($_GET['pseudo']) ? $_GET['pseudo'] : '';
    
    ?>
</head>
<body>
    <?php 
    if (isset($_POST['id']) && isset($_POST['id2'])) {
        $id = $_POST['id'];
        $id2 = $_POST['id2'];
        $pseudo = $_POST['pseudo'];
        
        $sql = "INSERT INTO amis (id_utilisateur_1,id_utilisateur_2,date_amitie) VALUES ('$id','$id2',NOW())";

        if (mysqli_query($db_handle, $sql)) {
             $url = "monreseau.php?id=" . urlencode($id) . "&pseudo=" . urlencode($pseudo);
             echo "<script>window.location.href = '" . $url . "';</script>";
                    exit;   
        } 
        else {
            echo "Erreur lors de l'insertion de la nouvelle ligne : " . mysqli_error($db_handle);
        }
    }
    ?>
    

    <footer>
        
    </footer>
</body>
</html>