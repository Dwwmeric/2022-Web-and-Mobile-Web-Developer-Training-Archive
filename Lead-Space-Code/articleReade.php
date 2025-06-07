<?php
session_start();
require('actions/article/showArticle.php');
require_once('actions/article/articleAnswers.php');
require_once('actions/article/allRemarkArticle.php');
?>
<!DOCTYPE html>
<html lang="en">
<!-- En-tête  -->
<?php include_once('includes/head.php'); ?>

<body>
    <!-- NavBar -->
    <?php require_once('includes/navBar.php'); ?>
    <br /><br />

    <div class="container">
        <!-- Message d'erreur si le formulaire n'est pas rempli -->
        <?php
        if (isset($errorMsg)) {
            echo '<p>' . $errorMsg . '</p>';
        } elseif (isset($successMsg)) {
            echo '<p>' . $successMsg . '</p>';
        }
        ?>
        <!-- Section de la question  -->
        <?php if (isset($articleInfo['id'])) {
        ?>
            <section id="articleShow">
                <!-- Titre de la question -->
                <h2><?= $articleInfo['title_article']; ?></h2>
                <p>Publié par: <?= $articleInfo['pseudo_article']; ?>.</p>
                <p>Publié le: <?= $articleInfo['date_article']; ?>.</p>
                <p>Théme: <?= $articleInfo['theme_article']; ?>.</p>
                <!-- Condition si modifier -->
                <?php if (!empty($articleInfo['article_alter'])) {
                ?><p>Modifié le: <?= $articleInfo['article_alter']; ?>. </p>
                <?php
                } ?>
                <p><?= $articleInfo['text_article']; ?></p>
            </section>
            <br />
            <!-- Affichage des réponses dans l'ordre de publication  -->
            <section id="getAnswersArticle">
                <?php
                while ($remark = $getAllRemark->fetch()) {
                ?>
                    <div class="card">
                        <div class="card-header">
                            <p>Publié par: <?= $remark['pseudo_author']; ?>, le <?= $remark['date_remark'] ?>.</p>
                        </div>
                        <div class="class-body">
                            <p><?= $remark['content_remark']; ?></p>
                        </div>
                    </div>
                    <br />
                <?php
                }
                $getAllRemark->closeCursor();
                ?>
            </section>
            <!-- Réponse à la question  -->
            <section id="comentaireArticle">
                <?php
                if (isset($_SESSION["auth"])) {
                ?>
                    <div class="mb-3">
                        <form class="form-group" method="POST">
                            <label class="form-label">Laissez un commentaire: </label>
                            <textarea class="form-control" name="textCommentaire" rows="3"></textarea>
                            <br />
                            <button type="submit" name="submitCom" class="btn btn-info">Publié !</button>
                        </form>
                    </div>
                <?php
                } else {
                ?>
                    <h3>Pour laisser un commentaire, connectez-vous:</h3>
                    <a href="login.php" class="btn btn-primary">Connexion</a>
                    <a href="signup.php" class="btn btn-primary">Inscription</a>
                <?php } ?>
            </section>
        <?php
        } else {
        ?>
        <?php
        }
        ?>

    </div>
</body>

</html>