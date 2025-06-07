<!-- Appel les éléments php -->
<?php
require('actions/security/securitiAction.php');
require('actions/article/createArticle.php');
?>

<!-- Début HTML -->
<!DOCTYPE html>
<html lang="en">
<!-- en tête -->
<?php include_once('includes/head.php'); ?>

<body class="bgEdtArt">
    <!-- NavBar -->
    <?php require_once('includes/navBar.php'); ?>
    </br></br>
    <section id="SectionArt">
        <h1 id="titleArt">Écrivez votre article ! </h1>
        <form id="FormArt" method="POST" ENCTYPE="multipart/form-data">
            <!-- Message d'erreur si le formulaire n'est pas rempli -->
            <?php
            if (isset($errorMsg)) {
                echo '<p id="errorArt">' . $errorMsg . '</p>';
            } elseif (isset($successMsg)) {
                echo '<p id="sucessArt">' . $successMsg . '</p>';
            }
            ?>
            <!-- Titre de la question -->
            <div class="mb-3">
                <label class="form-label textArt">Titre de l'article</label>
                <input type="text" class="form-control" name="titleArticle">
            </div>
            <!-- Selected  sujet -->
            <select class="form-select" name="themeSelectA">
                <option selected>Sélectionnez un thème: </option>
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
            <br>
            <!-- image -->
            <!-- <label class="form-label">Partager un pdf ou un docx :</label>
        <input type="file" id="articleFiel" name="articleFiel" accept=".doc,.docx,.pdf">
        <br><br> -->
            <!-- Description des questions -->
            <div class="mb-3">
                <label for="areaArt" class="form-label textArt">Votre article :</label>
                <textarea class="form-control" id="areaArt" rows="8" name="textArticle"></textarea>
            </div>
            <!-- Boutton valider  -->
            <button type="submitArticle" class="btn btn-primary" id="artButton" name="submitArticle">🦾 Publier</button>
        </form>
    </section>

</body>

</html>