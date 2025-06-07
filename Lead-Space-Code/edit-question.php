<!-- Appel des fichiers php  -->
<?php
require('actions/security/securitiAction.php');
require('actions/question/questionAction.php');
?>

<!-- HTML début -->
<!DOCTYPE html>
<html lang="en">
<!-- En-tête-->
<?php include_once('includes/head.php'); ?>

<body class="bgEdtQst">
    <!-- NavBar -->
    <?php require_once('includes/navBar.php'); ?>
    </br></br>
    <section id="SectionQts">
        <h1 id="titleQts">Écrivez votre question ? </h1>
        <!-- Formulaire de création d'une question -->
        <form id="FormQts" method="POST">
            <!-- message d'erreur si le formulaire n'est pas remplie -->
            <?php
            if (isset($errorMsg)) {
                echo '<p id="errorQst">' . $errorMsg . '</p>';
            } elseif (isset($successMsg)) {
                echo '<p id="sucessQst">' . $successMsg . '</p>';
            }
            ?>
            <!-- Titre de la question -->
            <div class="mb-3">
                <label class="form-label textQts">Titre de la question</label>
                <input type="text" class="form-control" name="titleQuestion">
            </div>
            <!-- Selected  sujet -->
            <select class="form-select" name="themeSelect">
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
            <!-- Description des questions -->
            <div class="mb-3">
                <label for="areaQst" class="form-label textQts" >Votre question ?</label>
                <textarea class="form-control" id="areaQst" rows="8" name="textDesc"></textarea>
            </div>
            <!-- Boutton valider  -->
            <button type="submit" class="btn btn-primary" id="qstButton" name="submitQuestion">Publier</button>
        </form>
    </section>

</body>

</html>