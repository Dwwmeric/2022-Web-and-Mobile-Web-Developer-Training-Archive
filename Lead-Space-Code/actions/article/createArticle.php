<?php
// Connexion à la base de données
require('actions/dataBase.php');

if (isset($_POST['submitArticle'])) {

  // Vérification de si les champs sont bien remplie
  if (!empty($_POST['titleArticle']) && !empty($_POST['themeSelectA']) && !empty($_POST['textArticle'])) {

    $articleTitle = htmlspecialchars($_POST['titleArticle']);
    $articleTheme = htmlspecialchars($_POST['themeSelectA']);
    $articleDesc = nl2br(htmlspecialchars($_POST['textArticle']));
    $articleDate = date('d/m/y H:i:s');
    $articleIdAuthor = $_SESSION['id'];;
    $articlePseudo = $_SESSION['pseudo'];

    // L'insertion de l'article dans la table articles.
    $insertArticleWeb = $bdd->prepare('INSERT INTO articles(title_article, theme_article, text_article, date_article, pseudo_article, author_article)VALUES(?,?,?,?,?,?)');
    $insertArticleWeb->execute(
      [
        $articleTitle,
        $articleTheme,
        $articleDesc,
        $articleDate,
        $articlePseudo,
        $articleIdAuthor
      ]
    );
    $insertArticleWeb->closeCursor();

    // Message de réussite pour la publication 
    $successMsg = "Votre article a bien été publié !";
  } else {
    // Message d'erreur lors d'un formulaire incomplet 
    $errorMsg = "Veuillez compléter l'article.";
  }
}
