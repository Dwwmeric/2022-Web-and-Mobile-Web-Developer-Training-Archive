<?php
// Connexion à la base de données
require('actions/dataBase.php');

// Vérifie si le bouton est sélectionné. 
if (isset($_GET['id']) && !empty($_GET['id'])) {

    // Récupère la variable de l'article
    $idArticle = $_GET['id'];

    // Récupère la question sélectionnée. 
    $ArticleShow = $bdd->prepare('SELECT * FROM articles WHERE id = ?');
    $ArticleShow->execute([$idArticle]);

    if ($ArticleShow->rowCount() > 0) {
        // L'article
        $articleInfo = $ArticleShow->fetch();
       
    } else {
        $errorMsg = "Aucun article à étais trouvé!";
    }
} else {
    $errorMsg = "Aucun article à étais trouvé!";
}
