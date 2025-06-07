<?php 
    // Connexion à la base de données 
    require ('actions/dataBase.php');

    // Vérifie si le bouton est sélectionné.
    if (isset($_GET['id']) && !empty($_GET['id'])){

        // Récupère la variable de la question 
        $idQuestion = $_GET['id'];

        // Récupère la question sélectionnée. 
        $questionShow = $bdd->prepare('SELECT * FROM questions WHERE id = ?');
        $questionShow->execute([$idQuestion]);

        if($questionShow->rowCount() > 0){

            //la question 
            $questionInfo = $questionShow->fetch(); 

        } else {
            $errorMsg = "Aucune question à étais trouvée!";
        }


    } else {
        $errorMsg = "Aucune question à étais trouvée!";
    }