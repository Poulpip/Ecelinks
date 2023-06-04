
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="projet.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <?php
    $database = "reseau_social";
    $db_handle = mysqli_connect('localhost', 'root', '', $database);
    $db_found = mysqli_select_db($db_handle, $database);
    $id = isset($_GET["id"]) ? $_GET["id"] : "";
    $pseudo = isset($_GET["pseudo"]) ? $_GET["pseudo"] : "";

    $accueil =
      "accueil.php?id=" . urlencode($id) . "&pseudo=" . urlencode($pseudo);
    $vous = "vous.php?id=" . urlencode($id) . "&pseudo=" . urlencode($pseudo);
    $emplois =
      "emplois.php?id=" . urlencode($id) . "&pseudo=" . urlencode($pseudo);
    $messagerie =
      "messagerie.php?id=" . urlencode($id) . "&pseudo=" . urlencode($pseudo);
    $monreseau =
      "monreseau.php?id=" . urlencode($id) . "&pseudo=" . urlencode($pseudo);
    $notif = "notif.php?id=" . urlencode($id) . "&pseudo=" . urlencode($pseudo);
    ?>
   

    <script>

    function affichermesg(id2) {
            var id_dernier_message = 0;
            var rafraichir_btn=0;
          

        function ajoutermessage(texte,id2) {
           
            var data = {
                message: texte,
                id: '<?php echo $id; ?>',
                id2: id2,
                pseudo: '<?php echo $pseudo; ?>'
            };
            $.ajax({
                url: "message.php",
                type: "POST",
                data: data,

                success: function(recep) {
                    console.log(recep);
                                        
                },
                error: function(xhr, status, error) {
                    // Gestion des erreurs
                    console.log("Erreur AJAX : " + error);
                }
            });
        }
        function supprimerMessage(id_message, chatRoom, conversationDiv) {
            
            chatRoom.removeChild(conversationDiv);
           

            var data = {
                id_message: id_message,
                id: '<?php echo $id; ?>',
                pseudo: '<?php echo $pseudo; ?>'
            };
            $.ajax({
                url: "supprimer_message.php",
                type: "POST",
                data: data,
                dataType: "json",
                success: function(recep) {
                    console.log("SUPPR:", recep);


                },
                error: function(xhr, status, error) {
                    // Gestion des erreurs
                    console.log("Erreur AJAX : " + error);
                }
            });
        }
            
            function chargerMessages(id_dernier_message,rafraichir_btn) {
                var data = {
                    id: '<?php echo $id; ?>',
                    pseudo: '<?php echo $pseudo; ?>',
                    id2: id2,
                    id_dernier_message: id_dernier_message
                };
                   console.log("der:", id_dernier_message);
                $.ajax({
                    url: "message.php",
                    type: "POST",
                    data: data,
                    dataType: "json", // Spécifiez le type de données attendu (JSON)
                    success: function(recep) {
                        texte = recep.texte;
                        id_expediteur = recep.id_expediteur;
                        id_destinataire = recep.id_destinataire;
                        date_message = recep.date_message;
                        lu = recep.lu;
                        id_message = recep.id_message;
                        pseudoV = recep.pseudo;
                        console.log(recep);

                        if (id_message != id_dernier_message) {


                            for (var i = 0; i < id_message.length; i++) {


                                var conversationDiv = document.createElement("div");
                                var divDetails = document.createElement("div");
                                conversationDiv.classList.add("conversation");
                                
                                // Créer un élément <p> pour afficher le texte du message
                                var texteElement = document.createElement("p");
                                if (id_expediteur[i] == '<?php echo $id; ?>') {
                                    texteElement.classList.add("message-envoye");
                                } else {
                                    texteElement.classList.add("message-recu");
                                }
                                
                                texteElement.textContent = texte[i];

                                // Créer un élément <span> pour afficher les détails du message
                                var detailsElement = document.createElement("span");
                                detailsElement.classList.add("message-details");
                                if(lu[i]==1)
                                { detailsElement.textContent = pseudoV[i] + " • " + date_message[i]+" •  lu   • "; }
                                else
                                { detailsElement.textContent =  pseudoV[i] + " • " + date_message[i];
                                }    
                                
                                
                                var Garde_id_msg = function(id, chatRoom, conversationDiv) {
                                    return function() {
                                        supprimerMessage(id, chatRoom, conversationDiv);
                                    };
                                };


                                var deleteButton = document.createElement("button");
                                deleteButton.textContent = "Supprimer";

                                
                                deleteButton.dataset.messageId = id_message[i];
                                divDetails.appendChild(detailsElement);
                                divDetails.appendChild(deleteButton);
                                // Ajouter les éléments à l'élément <div> de la conversation
                                conversationDiv.appendChild(texteElement);
                                conversationDiv.appendChild(divDetails);
                                

                                conversationDiv.style.display = "block";
                                // Ajouter l'élément <div> à l'élément avec l'ID "chatRoom"
                                var chatRoomId = "chatRoom" + id2;
                                var chatRoom = document.getElementById(chatRoomId);
                                
                                chatRoom.appendChild(conversationDiv);
                                deleteButton.addEventListener("click", Garde_id_msg(id_message[i], chatRoom, conversationDiv));
                                
                                

                                // Définir la position de défilement du div pour afficher les nouveaux éléments en bas
                                

                            };
                            console.log("sort recep");

                                utiliserDernierIdMessage(id_message[id_message.length - 1]);
                                
                            
                            

                        } else {
                            //console.log("dernier id message : " + id_message);
                            utiliserDernierIdMessage(id_message);
                            
                        }

                    },

                    error: function(xhr, status, error) {
                        // Gestion des erreurs
                        if (xhr.responseJSON && xhr.responseJSON.error) {
                            console.log("Erreur AJAX : " + xhr.responseJSON.error);
                        } else {
                            console.log("Erreur AJAX : " + error);
                        }

                    },

                });

            }

        function utiliserDernierIdMessage(id_dernier_message) { //permet d'utiliser la valeur obtenu dans la fonction chargerMessages



                setTimeout(function() {
                    chargerMessages(id_dernier_message);
                }, 500);




            };
    

            supprbouton(id2,0);
            var inputText = document.createElement("input");
            inputText.type = "text";
            var textRoom = document.getElementById("textRoom"+id2);  
            var chatRoom = document.getElementById("chatRoom"+id2);
            chatRoom.classList.add("chatRoom");
            var btnsuppr=document.createElement("button");
            btnsuppr.textContent="Fermer le chat";
            btnsuppr.addEventListener("click", function() {
                
                chatRoom.innerHTML="";
                textRoom.innerHTML="";
                chatRoom.classList.remove("chatRoom");
                RemettreBtn(id2);
          
            });
            
            // Créer un bouton pour envoyer les données
            var boutonEnvoyer = document.createElement("button");
            boutonEnvoyer.id="btn_envoyer";
            boutonEnvoyer.textContent = "Envoyer";
            boutonEnvoyer.addEventListener("click", function() {
                // Récupérer la valeur du champ de texte
                var texte = inputText.value;
                // Envoyer les données au serveur
                
                ajoutermessage(texte,id2);
                console.log("input texte");
                
                    
            });
            textRoom.appendChild(inputText);
            textRoom.appendChild(boutonEnvoyer);
            textRoom.appendChild(btnsuppr);
            chargerMessages(id_dernier_message);
            
            
            
            
            
            
        }
        function supprbouton(id2,lequel)
        {
            var boutonEnvoyer = document.getElementById("btn_envoyer"+id2);
            if(boutonEnvoyer!=null && lequel==0) 
            {
                 boutonEnvoyer.remove();
            }
            var btn=document.getElementById("btn_visio"+id2);
            if(btn!=null &&  lequel==1)
            {
                btn.remove();
            }
   
        }
        function RemettreBtn(id2)
        { 
            var chatRoom = document.getElementById("chatRoom"+id2);
            var visioRoom=document.getElementById("visioRoom"+id2);
            if(document.getElementById("btn_envoyer"+id2)==null)
            {
                var BtnMsg = document.createElement("Button");
                BtnMsg.id="btn_envoyer"+id2;
                BtnMsg.textContent = "Converser";
                BtnMsg.addEventListener("click", function() {
                
                affichermesg(id2);
     
                });
                chatRoom.appendChild(BtnMsg);
            }
            
            if(document.getElementById("btn_visio"+id2)==null)
            {
                var BtnVisio = document.createElement("Button");
                BtnVisio.id="btn_visio"+id2;
                BtnVisio.textContent = "Appelez";
                BtnVisio.addEventListener("click", function() {
    
                visio(id2);
     
                });
                visioRoom.appendChild(BtnVisio);
            }
                 
        }
        function supprimerVisio(id2)
        {
            
            var visioRoom=document.getElementById("visioRoom"+id2);
            visioRoom.innerHTML="";
            
            var handle = document.createElement("div");
            handle.id = "handle"+id2;
            handle.classList.add("hidden");
            handle.classList.add("resize-handle");
            visioRoom.appendChild(handle);
            
        }
        
        function visio(id2) {
            
        // Créer l'élément iframe
        supprbouton(id2,1);
        divTaille(id2);
        var iframe = document.createElement("iframe");
        iframe.allow = "camera; microphone; fullscreen; display-capture; autoplay";
        iframe.src = "https://meet.jit.si/moderated/1b32bf375290ca78533659c3e3e0fdeaa58ad5da7742775a1265c805ed2db8ee";
        iframe.style.height = "100%";
        iframe.style.width = "100%";
        iframe.style.border = "0px";

        // Ajouter l'iframe au conteneur
        var container = document.getElementById("visioRoom"+id2);
        container.classList.add("visio");
        
        if (container) {
                container.appendChild(iframe);
            } else {
                console.error("Le conteneur visioRoom n'existe pas");
            }
            var btnsuppr=document.createElement("button");
            btnsuppr.textContent="Fermer";
            btnsuppr.id="btn_fermer"+id2;
            btnsuppr.addEventListener("click", function() {
                
                supprimerVisio(id2);
                
                RemettreBtn(id2);
                   
                    
            });
            container.appendChild(btnsuppr);
            
            
        }
        function divTaille(id2) {
        var resizable = document.getElementById("visioRoom"+id2);

        var handle = document.getElementById("handle"+id2);
        
        handle.classList.remove("hidden"); 
        var startX, startY, startWidth, startHeight;

        handle.addEventListener('mousedown', function(event) {
            event.preventDefault();
            startX = event.clientX;
            startY = event.clientY;
            startWidth = parseInt(document.defaultView.getComputedStyle(resizable).width, 10);
            startHeight = parseInt(document.defaultView.getComputedStyle(resizable).height, 10);
            document.documentElement.addEventListener('mousemove', resize);
            document.documentElement.addEventListener('mouseup', stopResize);
        });

        function resize(event) {
            var newWidth = startWidth + event.clientX - startX;
            var newHeight = startHeight + event.clientY - startY;
            resizable.style.width = newWidth + 'px';
            resizable.style.height = newHeight + 'px';
        }

        function stopResize() {
            document.documentElement.removeEventListener('mousemove', resize);
            document.documentElement.removeEventListener('mouseup', stopResize);
        }
    }
        
                
    
        // Appeler la fonction chargerMessages() périodiquement à intervalles réguliers
    </script>
</head>

<body>

    <div id="logo" class="logo">
        <a href="<?php echo $accueil; ?>">
            <img src="image\logo.webp" height="100" width="300">
        </a>
        <br>

        <a href="<?php echo $accueil; ?>">
            <img src="image\acceuil.png">
        </a>

        <a href="<?php echo $monreseau; ?>">
            <img src="image\Monreseau.png">
        </a>

        <a href="<?php echo $vous; ?>">
            <img src="image\Vous.png">
        </a>

        <a href="<?php echo $notif; ?>">
            <img src="image\Notif.png">
        </a>

        <a href="<?php echo $messagerie; ?>">
            <img src="image\Messagerie.png">
        </a>

        <a href="<?php echo $emplois; ?>">
            <img src="image\Emplois.png">
        </a>
    </div>
    <div id="tableau">
        <?php
        $sql = "SELECT * FROM amis WHERE id_utilisateur_1 ='$id'";
        $sql2 = "SELECT * FROM amis WHERE id_utilisateur_2 ='$id'";
        $result = mysqli_query($db_handle, $sql);
        $result2 = mysqli_query($db_handle, $sql2);
        if (mysqli_num_rows($result) > 0 || mysqli_num_rows($result2) > 0) {
          echo "Mes amis: ";
          echo "<br>";
          echo "<table border=\"1\">";

          while ($data = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            $id2 = $data["id_utilisateur_2"];
            $sql_amis = "SELECT * FROM utilisateurs WHERE id = '$id2'";
            $result_amis = mysqli_query($db_handle, $sql_amis);
            while ($data_amis = mysqli_fetch_assoc($result_amis)) {
              echo '<td><a href="profil.php?id=' .
                $id .
                "&id2=" .
                $id2 .
                "&pseudo=" .
                $pseudo .
                '"><img src="' .
                $data_amis["image_profil"] .
                '" width="125" height="75"></a></td>';
              echo "<td>" . $data_amis["pseudo"] . "</td>";
            }
            echo "<td>" .
                ' <div id="chatRoom' .$id2 .'" ><br><input type="button" id="btn_envoyer' .$id2 .'" onclick="affichermesg(' .$id2 .')" value="Converser"></div>' .
                '<br><div id="textRoom' .$id2 .'" class="textRoom"></div>'.'<br> <div id="visioRoom' .$id2 .'" " class="visioROOM"> <input type="button" id="btn_visio' .$id2 .'" onclick="visio(' .$id2 .')" value="Appelez"> <div id="handle' .$id2 .'" class="resize-handle hidden"></div></div>'.
                "</td>" ;
  
            echo "</tr>";
          }
          while ($data2 = mysqli_fetch_assoc($result2)) {
            echo "<tr>";
            $id2 = $data2["id_utilisateur_1"];
            $sql_amis2 = "SELECT * FROM utilisateurs WHERE id = '$id2'";
            $result_amis2 = mysqli_query($db_handle, $sql_amis2);
            while ($data_amis2 = mysqli_fetch_assoc($result_amis2)) {
              echo '<td><a href="profil.php?id=' .$id ."&id2=" .$id2 ."&pseudo=" . $pseudo .'"><img src="' .$data_amis2["image_profil"] .'" width="125" height="75"></a></td>';
              echo "<td>" . $data_amis2["pseudo"] . "</td>"; 

            }
            echo "<td>" .
                '<div id="chatRoom' .$id2 .'" > <br><input type="button" id="btn_envoyer' .$id2 .'" onclick="affichermesg(' .$id2 .')" value="Converser"></div>' .
                '<br><div id="textRoom' .$id2 .'" class="textRoom"></div>'.'<br> <div id="visioRoom' .$id2 .'" class="visioROOM">  <input type="button" id="btn_visio' .$id2 .'"  onclick="visio(' .$id2 .')" value="Appelez"><div id="handle' .$id2 .'"class="resize-handle hidden"></div></div>'.
                
                "</td>";
            echo "</tr>";
          }
          echo "</table>";
        }
        ?>
    </div>
    
    <footer>
        <p class="contact">Linkece <br>
            67 avenue Marceau<br>
            75015 Paris<br> <br>
            (+33) 01 02 03 04 05 06
        </p>
    </footer>




</body>

</html>
