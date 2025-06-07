<?php
// Connexion à la base de données
require('actions/dataBase.php');

// Vérifier si le buton modifié est validé
if (isset($_POST['updateArticle'])) {

    // Vérifie si le formulaire est bien rempli 
    if (!empty($_POST['titleUpdate']) && !empty($_POST['themeSelectUpdate']) && !empty($_POST['textDescUpdate'])) {
        // Récupération des données 
        $NewArticleTitle = htmlspecialchars($_POST['titleUpdate']);
        $NewArticleTheme = htmlspecialchars($_POST['themeSelectUpdate']);
        // nl2br autorise les sauts de ligne dans le texte la description. 
        $NewArticleDesc  = nl2br(htmlspecialchars($_POST['textDescUpdate']));
        $NewArticleDate = date('d/m/y H:i:s');

        $updateArticle = $bdd->prepare('UPDATE articles SET title_article = ?, theme_article = ?, text_article = ?, article_alter = ? WHERE id = ?');
        $updateArticle->execute([$NewArticleTitle, $NewArticleTheme, $NewArticleDesc, $NewArticleDate, $idArticle]);
        $updateArticle->closeCursor();
        // Message de réussite  
        $successMsg = "Votre article a bien été modifié !";
        // Redirection 
        header("Location: user-article.php");
    } else {
        // Message d'erreur lors d'un formulaire incomplet
        $errorMsg = "Veuillez compléter le formulaire.";
    }
}
