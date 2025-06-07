<!-- Appel au PHP-->
<?php
require('actions/security/securitiAction.php');
require('actions/article/userArticle.php');
require ('actions/article/editUpdateArticle.php');
?>
<!DOCTYPE html>
<html lang="en">
<!-- En-tête -->
<?php include_once('includes/head.php'); ?>

<body>
    <!-- NavBar -->
    <?php require_once('includes/navBar.php'); ?>
    </br>
    <!-- Card d'article -->
    <div class="container">
        <!-- Message d'erreur si le formulaire n'est pas remplie -->
        <?php
        if (isset($errorMsg)) {
            echo '<p>' . $errorMsg . '</p>';
        } elseif (isset($successMsg)) {
            echo '<p>' . $successMsg . '</p>';
        }
        ?>

        <?php
        while ($article = $getArticle->fetch()) {
        ?>
            <div class="card">
                <div class="card-header">
                    <!-- Title article -->
                    <a href="questionReade.php?id=<?= $article['id'] ?>"><?= $article['title_article']; ?></a>
                </div>
                <div class="card-body">
                    <p class="card-text"> <?= $article['theme_article']; ?> </p>
                    <p class="card-text"><?= $article['text_article']; ?></p>
                    <p class="card-text"><?= "Date: " . $article['date_article'] . " " . $article['pseudo_article'] . "."; ?></p>
                    <a href="articleReade.php?id=<?= $article['id']; ?>" class="btn btn-primary">Accéder</a>
                    <a href="updateArticle.php?id=<?= $article['id']; ?>" class="btn btn-primary">Modifier</a>
                    <a href="actions/article/deleteArticle.php?id=<?= $article['id']; ?>" class="btn btn-primary">Supprimer</a>
                </div>
            </div>
            </br>
        <?php
        }
        $getArticle->closeCursor();
        ?>
    </div>

</body>

</html>