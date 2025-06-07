<?php
session_start();
require('actions/users/usersEdit.php');
?>

<!DOCTYPE html>
<html lang="en">
<!-- En-tête -->
<?php include_once('includes/head.php'); ?>

<body class="bgProfil">
    <!-- NavBar -->
    <?php require_once('includes/navBar.php'); ?>
    <br /><br />
    <!-- Message  -->
    <div class="container">
        <?php
        $successMsg = $_GET['msg'];

        if (isset($errorMsg)) {
            echo '<p class="errorProf">' . $errorMsg . '</p>';
        } elseif (isset($successMsg) ) {
            echo '<p class="successProf">' . $successMsg . '</p>';
        }

        if (isset($userQuestion)) {
        ?>
            <!-- Carte user -->
            <div class="card profil offset-5" style="width: 20rem;">
                <img src="/assets/image/robot.png" class="card-img-top" alt="...">
                <div class="card-body bgCardProfil">
                    <h5 class="card-title titlteCard"><?= $userInfo['pseudo'] ?></h5>
                    <h5 class="titlteCard"><?= $userInfo['firts_name'] ?> <?= $userInfo['name'] ?></h5>
                    <!-- Modifier le mot de passe -->
                    <?php
                    if (isset($_SESSION['id']) == $userInfo['id']) {
                    ?>
                        <a href="#" class="btn btn-outline-info updatePwd">Modifier le Mot de passe</a>
                        <a href="#" class="btn btn-outline-danger deleteUser">Supprimer le compte</a>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="questionPorfil">
                <h5 class = "titlteEdit">Questions:</h5>
                <?php
                // Boucle pour affichage des questions 
                while ($questions = $userQuestion->fetch()) {
                ?>
                    <p><a href="updateQuestion.php?id=<?= $questions['id']; ?>"><?= $questions['title_question'] ?></a>
                        <?php
                        if (isset($_SESSION['id']) == $questions['id_author']) {
                        ?>
                            <a href="actions/question/deleteQuestion.php?id=<?= $questions['id']; ?>&section=profil" class="btn btn-danger">Supprimer</a>
                    </p>
                <?php
                        }
                ?>
            <?php
                }
                $userQuestion->closeCursor();
            ?>
            </div>
            <div class="articlePorfil">
                <h5 class = "titlteEdit">Articles:</h5>
                <?php
                // Boucle pour affichage des articles 
                while ($articles = $userArticle->fetch()) {
                ?>
                    <p><a href="updateQuestion.php?id=<?= $articles['id']; ?>"><?= $articles['title_article'] ?></a>
                        <?php
                        if (isset($_SESSION['id']) == $articles['author_article']) {
                        ?>
                            <a href="actions/article/deleteArticle.php?id=<?= $articles['id']; ?>&section=profil" class="btn btn-danger">Supprimer</a>
                    </p>
                <?php
                        }
                ?>
        <?php
                }
                $userArticle->closeCursor();
                ?>
                </div>
                <?php
            }
        ?>
            </div>

</body>

</html>