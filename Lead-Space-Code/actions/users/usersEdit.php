<?php
    require ('actions/dataBase.php');

    if (isset($_GET['id']) && !empty($_GET['id'])){
        // Récupération de l'id 
        $idUser = $_GET['id'];

        $userExit = $bdd->prepare('SELECT * FROM users WHERE id = ? ORDER BY id DESC');
        $userExit->execute([$idUser]);

        // Vérifie la requête 
        if ($userExit->rowCount() > 0){

            // Récupération des données
            $userInfo = $userExit->fetch();
            $userExit->closeCursor();

            // Récupération des questions
            $userQuestion = $bdd->prepare('SELECT * FROM questions WHERE id_author = ?');
            $userQuestion->execute([$idUser]);

            // Récupération des articles
            $userArticle = $bdd->prepare('SELECT * FROM articles WHERE author_article = ?');
            $userArticle->execute([$idUser]);

        } else {
            $errorMsg = "Aucun utilisateur trouver !";
        }

    } else {
        $errorMsg = "Aucun utilisateur trouver !";
    }