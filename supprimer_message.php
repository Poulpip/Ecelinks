<?php

$database = "id20830431_reseau_social";
$db_handle = mysqli_connect('localhost', 'id20830431_ecelinks', 'Ecelink1!', $database);
$db_found = mysqli_select_db($db_handle, $database);

// Vérifier si le formulaire a été soumis
if (isset($_POST['supprimer'])) {
    // Récupérer l'ID du message à supprimer depuis le champ caché
    $id_message = $_POST['id_message'];
    $id = $_POST['id'];
    $id_amis = $_POST['id_amis'];
    $pseudo = $_POST['pseudo'];
    // Effectuer la suppression du message dans la base de données
    $sqlDelete = "DELETE FROM messages WHERE id = '$id_message'";
    if (mysqli_query($db_handle, $sqlDelete)) {
        $url = "message.php?id=" . urlencode($id) . "&pseudo=" . urlencode($pseudo). "&id_amis=" . urlencode($id_amis). "&id_amis=" . urlencode($id_amis);
        echo "<script>window.location.href = '" . $url . "';</script>";
        exit;  
        
    } else {
        echo "Erreur lors de la suppression du message : " . mysqli_error($db_handle);
    }
}
?>
