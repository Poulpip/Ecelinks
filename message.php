<head>
    <meta charset="utf-8">
    <title>Message</title>
    <style>
        .message {
            background-color: #f2f2f2;
            border-radius: 10px;
            margin-bottom: 10px;
            padding: 10px;
            word-wrap: break-word;
            display: inline-block;

        }

        .message-envoye {
            background-color: #DCF8C6;
            align-self: flex-end;
        }

        .message-recu {
            background-color: #ECECEC;
            align-self: flex-start;
        }

        .message-texte {
            font-weight: bold;
        }

        .message-date {
            font-size: 12px;
            color: gray;
        }

        .delete-button {
            background-color: transparent;
            border: none;
            color: black;
            font-size: 16px;
            cursor: pointer;
            float: right;
            margin-top: -10px;
        }
    </style>
    
    <?php
    $database = "id20830431_reseau_social";
    $db_handle = mysqli_connect('localhost', 'id20830431_ecelinks', 'Ecelink1!', $database);
    $db_found = mysqli_select_db($db_handle, $database);
    if ($id = isset($_GET['id']) ? $_GET['id'] : '' != "" ) {
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $pseudo = isset($_GET['pseudo']) ? $_GET['pseudo'] : '';
        $id_amis = isset($_GET['id_amis']) ? $_GET['id_amis'] : '';
    } else {
        $id = $_POST['id'];
        $id_amis = $_POST['id_amis'];
        $pseudo = $_POST['pseudo'];
    }
    $messagerie = "messagerie.php?id=" . urlencode($id) . "&pseudo=" . urlencode($pseudo);
    ?>
</head>

<body>
<div id="messagerie"    >
	 	<a href="<?php echo $messagerie; ?>">
			<img  src="image\messagerie.png">
		</a>
	</div>
    <?php
    
    

    echo "Mon ID: " . $id . "<br>";
    $message = isset($_POST["message"]) ? $_POST["message"] : "";
    if ($message != "" ) {
        $sqlInsert = "INSERT INTO messages (id_expediteur, id_destinataire, texte, date_message, lu) VALUES ('$id', '$id_amis', '$message', NOW(), 0)";
        if (mysqli_query($db_handle, $sqlInsert)) {
        } else {
            echo "Erreur lors de l'envoi du message" . mysqli_error($db_handle);;
        }$srop=1;
    }

    $sql = "SELECT * FROM messages ORDER BY date_message DESC";
    $result = mysqli_query($db_handle, $sql);

    if (mysqli_query($db_handle, $sql)) {
        while ($data = mysqli_fetch_assoc($result)) {

            $id_expediteur = $data['id_expediteur'];
            $id_destinataire = $data['id_destinataire'];
            $texte = $data['texte'];
            $date_message = $data['date_message'];
            $lu = $data['lu'];
            $id_message = $data['id'];
            if($id_expediteur==$id)
            {
                $pseudoV = $pseudo;
            }
            else{
                $sql = "SELECT pseudo FROM utilisateurs WHERE id ='$id_expediteur'";
                if ($result = mysqli_query($db_handle, $sql) ) {
                        $dataV = mysqli_fetch_assoc($result);
                        $pseudoV = $dataV['pseudo'];
                }
            }
            $classe_css = ($id_expediteur == $id) ? 'message-envoye' : 'message-recu';

            // Afficher les détails du message avec la classe CSS correspondante
            echo '<div class="message ' . $classe_css . '">';
            echo '<div class="message-header">';
            echo '<span class="message-sender">' . $pseudoV . '</span>';
            echo '</div>';
            echo '<div class="message-content">';
            echo '<span class="message-texte">' . $texte . '</span>';
            echo '</div>';
            echo '<div class="message-footer">';
            echo '<span class="message-date">' . $date_message . '</span>';
            echo '</div>';
            echo '<div class="message-options">';
            echo '<form method="post" action="supprimer_message.php">';
            echo '<input type="hidden" name="id_message" value="' . $id_message . '">';
            echo '<input type="hidden" name="id" value="' . $id . '">';
            echo '<input type="hidden" name="id_amis" value="' . $id_amis . '">';
            echo '<input type="hidden" name="pseudo" value="' . $pseudo . '">';
            echo '<button type="submit" name="supprimer" class="delete-button">Supprimer</button>';
            echo '</form>';
            echo '</div>';
            echo '</div>'."<br>";
            
        }
    } 
    
    echo '<form method="POST" action="message.php">';
    echo '<label for="message">Message:</label><br>';
    echo '<textarea id="message" name="message" rows="4" cols="50"></textarea><br>';
    echo '<input type="hidden" name="id" value="' . $id . '">';
    echo '<input type="hidden" name="id_amis" value="' . $id_amis . '">';
    echo '<input type="hidden" name="pseudo" value="' . $pseudo . '">';
    echo '<input type="submit" value="Envoyer">';
    echo '</form>';


    ?>

</body>