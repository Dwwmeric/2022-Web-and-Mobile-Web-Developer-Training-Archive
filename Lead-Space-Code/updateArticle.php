<!-- Appel des fichiers php -->
<?php
require('actions/security/securitiAction.php');
require('actions/article/editInfoArticle.php');
require('actions/article/editUpdateArticle.php');
?>
<!DOCTYPE html>
<html lang="en">
<!-- En-tête -->
<?php include_once('includes/head.php'); ?>

<body>
    <!-- NavBar -->
    <?php require_once('includes/navBar.php'); ?>
    </br></br>
    <div class="container">
        <!-- Message d'erreur -->
        <?php
        if (isset($errorMsg)) {
            echo '<p>' . $errorMsg . '</p>';
        } elseif (isset($successMsg)) {
            echo '<p>' . $successMsg . '</p>';
        }
        ?>

        <!-- Condition pour afficher le formulaire -->
        <?php if (isset($articleDate)) {
        ?>
            <!-- Formulaire de modification d'un article -->
            <form method="POST">
                <!-- Titre de la article -->
                <div class="mb-3">
                    <label class="form-label">Titre de l'article</label>
                    <input type="text" class="form-control" name="titleUpdate" value="<?= $articleTitle; ?>">
                </div>
                <!-- Selected  sujet -->
                <select class="form-select" name="themeSelectUpdate">
                    <option selected><?= $articleTheme; ?> </option>
                    <option value="Sql">Sql</option>
                    <option value="Mongodb">Mongodb</option>
                    <option value="Html-Css">Html-Css</option>
                    <option value="PHP">PHP</option>
                    <option value="NodeJs">NodeJs</option>
                    <option value="JavaScript">JavaScript</option>
                    <option value="jQuery">jQuery</option>
                    <option value="Bootstrap">Bootstrap</option>
                    <option value="Symfony">Symfony</option>
                    <option value="Laravel">Laravel</option>
                    <option value="ReactJs">ReactJs</option>
                    <option value="ReactNative">ReactNative</option>
                    <option value="Drupal">Drupal</option>
                    <option value="Git">Git</option>
                    <option value="Java">Java</option>
                    <option value="Autre">Autre...</option>
                </select>
                <!-- Texte article -->
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Votre article :</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="textDescUpdate"><?= $articleDesc; ?> </textarea>
                </div>
                <!-- Boutton valider  -->
                <button type="submit" class="btn btn-primary" name="updateArticle">Modifier</button>
            </form>
        <?php
        } ?>
    </div>
</body>

</html>