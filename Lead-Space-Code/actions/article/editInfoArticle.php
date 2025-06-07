<?php
// Connexion à la base de données
require('actions/dataBase.php');

// Condition pour la modification de l'article
if (isset($_GET['id']) && !empty($_GET['id'])) {

    // Variable pour la requête sql
    $idArticle = $_GET['id'];
    // Requête pour la récupération des données  
    $updateArticle = $bdd->prepare('SELECT * FROM articles WHERE id = ?');
    $updateArticle->execute([$idArticle]);

    // Vérification si la requête est pleine 
    if ($updateArticle->rowCount() > 0) {

        // Récupération des données
        $infoArticle = $updateArticle->fetch();
        $updateArticle->closeCursor();
        // Vérifie l'auteur de l'article 
        if ($infoArticle['author_article'] == $_SESSION['id']) {

            // Variable pour les différentes données 
            $articleTitle = $infoArticle['title_article'];
            $articleTheme = $infoArticle['theme_article'];
            $articleDesc  = $infoArticle['text_article'];
            $articleDate = $infoArticle['date_article'];

            // Enlève les sauts à la ligne de la fonction php nl2br pour l'affichage des données 
            $articleDesc = str_replace("<br />", "", $articleDesc);
        } else {
            // Message d'erreur si vous n'etes pas l'auteur
            $errorMsg = "Attention, vous n'êtes pas l'auteur de l'article!";
        }
    } else {
        // Message d'erreur si pas d'article a cet identifiant
        $errorMsg = "Attention pas d'article trouvé !";
    }
} else {
    // Message d'erreur si pas d'article a cet identifiant
    $errorMsg = "Attention pas d'article trouvé !";
}
