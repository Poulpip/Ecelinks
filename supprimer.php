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
        $sql = "DELETE FROM utilisateurs WHERE id = '$id'"; 
    if ($db_handle->query($sql) === TRUE) {
        echo "Votre compte a été supprimé avec succès.";
        echo "<br>";
        $lien = "login_signin.html";
        echo "<a href=\"$lien\">SINGIN/LOGIN</a>";

    } else {
        echo "Erreur lors de la suppression du compte : " . $db->error;
    }
    ?>
    

    <footer>
        
    </footer>
</body>
</html>