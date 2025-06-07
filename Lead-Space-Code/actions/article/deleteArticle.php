<?php
// Connexion à la batabase
require('../security/securitiAction.php');
require('../dataBase.php');

// Condition pour vérifier si l'article existe
if (isset($_GET['id']) && !empty($_GET['id'])) {

    // id de l'article 
    $idArticle = $_GET['id'];

    // Paramètre route
    $routeId = $_GET['section'];

    // Récupération des données de l'article
    $bddArticle = $bdd->prepare('SELECT * FROM articles WHERE id = ?');
    $bddArticle->execute([$idArticle]);


    // Vérifie si la requête existe
    if ($bddArticle->rowCount() > 0) {

        // Récupérations des données
        $infoArticle = $bddArticle->fetch();
        $bddArticle->closeCursor();
        // Vérifie l'auteur de l'article
        if ($infoArticle['author_article'] == $_SESSION['id']) {

            // Requeste de delete 
            $destroyArticle = $bdd->prepare('DELETE FROM articles WHERE id = ?');
            $destroyArticle->execute([$idArticle]);
            $destroyArticle->closeCursor();
            // Message de suces
            $successMsg = "Votre article a bien été supprimée !";
            // Redirection vers la liste des articles
            switch ($routeId) {
                case 'profil':
                    header("Location: ../../profil.php?id= ".$_SESSION['id']."&msg=".$successMsg);
                    break;
                default:
                    header("Location: ../../user-article.php");
            }
            
        } else {
            // Message d'erreur
            $errorMsg = "Vous n'etes pas l'auhteur de l'article !";
            // Redirection vers la liste des articles
            header("Location: ../../user-article.php");
        }
    } else {
        // Message d'erreur
        $errorMsg = "Aucun article n'a été trouvée !";
        // Redirection vers la liste des articles
        header("Location: ../../user-article.php");
    }
} else {
    // Message d'erreur
    $errorMsg = "Aucun article n'a été trouvée !";
    // Redirection vers la liste des articles
    header("Location: ../../user-article.php");
}
