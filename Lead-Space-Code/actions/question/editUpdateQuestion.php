<?php
    // Connexion à la base de données 
    require ('actions/dataBase.php');
    
    // Vérifier si le buton modifié est submit
    if(isset($_POST['updateQuestion'])){
        // Vérifie ci le form est bien remplie 
        if(!empty($_POST['titleUpdate']) && !empty($_POST['themeSelectUpdate']) && !empty($_POST['textDescUpdate'])){
            // Récupération des données 
            $NewquestionTitle = htmlspecialchars($_POST['titleUpdate']);
            $NewquestionTheme = htmlspecialchars($_POST['themeSelectUpdate']);
            //nl2br autorise les sauts de ligne dans le texte de la description 
            $NewquestionDesc  = nl2br(htmlspecialchars($_POST['textDescUpdate']));
            $NewquestionDate = date('d/m/y H:i:s');

            $updateQuestion = $bdd->prepare('UPDATE questions SET title_question = ?, theme_question = ?, content_question = ?, date_alter = ? WHERE id = ?');
            $updateQuestion->execute([$NewquestionTitle,$NewquestionTheme,$NewquestionDesc,$NewquestionDate ,$idQuestion]);
            $updateQuestion->closeCursor();
            // Message sucess
            $successMsg = "Votre question a bien été modifié !"; 
            // Redirection vers la liste des questions
            header("Location: user-question.php" );
        } else {
            // Message d'erreur 
           $errorMsg = "Veuillez compléter le formulaire."; 
        }

    }