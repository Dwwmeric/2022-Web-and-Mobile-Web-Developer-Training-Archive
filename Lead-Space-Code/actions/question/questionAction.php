<?php
    // Connexion à la base de données 
    require ('actions/dataBase.php');
    
    // Vérification du bouton submit 
    if(isset($_POST['submitQuestion'])){
    
        // Vérification de si les champs sont bien remplie
        if(!empty($_POST['titleQuestion'])&& !empty($_POST['themeSelect']) && !empty($_POST['textDesc'])){

            $questionTitle = htmlspecialchars($_POST['titleQuestion']);
            $questionTheme = htmlspecialchars($_POST['themeSelect']);
            //nl2br autorise les sauts de ligne dans le texte de la description  
            $questionDesc  = nl2br(htmlspecialchars($_POST['textDesc']));
            $questionDate = date('d/m/y H:i:s');
            $questionIdAuthor = $_SESSION['id'];
            $questionPseudo = $_SESSION['pseudo'];

            // Insertion de la question dans la table question
            $insertQuestionWeb = $bdd->prepare('INSERT INTO questions(title_question, theme_question, content_question, date_question, id_author, pseudo_author)VALUES(?,?,?,?,?,?)');
            $insertQuestionWeb->execute(
                [
                $questionTitle,
                $questionTheme,
                $questionDesc,
                $questionDate,
                $questionIdAuthor,
                $questionPseudo
                ]
            );
            $insertQuestionWeb->closeCursor();

            // Message de success
            $successMsg = "Votre question a bien été publié !"; 
            
        }else{
           // Message d'erreur
           $errorMsg = "Veuillez compléter la question."; 
        }
    } 