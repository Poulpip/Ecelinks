<?php



		$servername = "localhost";
        $username = "id20830431_ecelinks@2a02:4780:bad:c0de::14";
        $password = "Ecelink1!";
        $database = "id20830431_reseau_social";
        
        $db_handle = new mysqli($servername, $username, $password, $database);
        
        // Vérification de la connexion
        if ($db_handle->connect_error) {
            die("Erreur de connexion à la base de données: " . $db_handle->connect_error);
        }
        $db_found = mysqli_select_db($db_handle, $database);
        $sql="SELECT * FROM utilisateurs ";
        $result = mysqli_query($db_handle, $sql);
        echo "<th>" . "id" . "</th>";
        echo "<th>" . "pseudo" . "</th>";
        echo "<th>" . "email" . "</th>";
        echo "<th>" . "mot_de_passe" . "</th>";
        echo "<th>" . "nom_complet" . "</th>";
        

        while ($data = mysqli_fetch_assoc($result)) {
        echo "<p>Requête: " . $sql . "<br>";
        echo "<td>" . $data['id'] . "</td>";
        echo "<td>" . $data['pseudo'] . "</td>";
        echo "<td>" . $data['email'] . "</td>";
        echo "<td>" . $data['mot_de_passe'] . "</td>";
        echo "<td>" . $data['nom_complet'] . "</td>";
    }
        
        $db_handle->close();
?>