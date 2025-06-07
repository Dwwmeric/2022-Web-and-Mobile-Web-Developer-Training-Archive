<!-- Appel élément important php -->
<?php
session_start();
require('actions/question/searchQuestion.php');
require('actions/article/searchArticle.php');
?>
<!-- HTML début -->
<!DOCTYPE html>
<html lang="en">
<!-- En-tête-->
<?php include_once('includes/head.php'); ?>

<body class="bg_login">
    <!-- NavBar -->
    <?php require_once('includes/navBar.php'); ?>
    <br /><br />

    <div class="container-fluid">
        <!-- Message -->
        <?php
        if (isset($errorMsg)) {
            echo '<p>' . $errorMsg . '</p>';
        } elseif (isset($successMsg)) {
            echo '<p>' . $successMsg . '</p>';
        }
        ?>

        <!-- Barre de recherche  -->
        <form method="POST">
            <div class="form-group row">
                <!-- Recherche par texte -->
                <div class="col-6 offset-3 searchIndex">
                    <input type="search" name="searchText" class="form-control" placeholder="Taper votre recherche...">
                </div>
                <!-- Bouton de validation -->
                <div class="col-2">
                    <button type="submit" name="submitSearch" class="btn btn-primary">Rechercher</button>
                </div>
            </div>
        </form>

        <!-- jeu JS -->
        <div id="gameHome" class="row justify-content-around">
            <!-- <div id="jsGame" class="col-6">
                <div id="endScreen"></div>
                <div class="scoreboard justify-content-around ">
                    <button id="start" class="col-2" onclick="start()">Play 🕹</button>
                    <div class="kills col-2" >Score : <span id="score">0</span></div>
                    <div class="confinement col-2">Détruit les Aliens Codeur : <span id="days">60</span></div>
                </div>

                <div id="canvas">
                    <div class="cursor"></div>
                </div>
            </div> -->


            <!-- Texte de présentation accueil -->
            <div id="resume" class="col-6">
                <h2>Bienvenue sur Laed Sapce Code !</h2>
                <p>Ce forum est prévu pour le partage d'idées et le conseil pour la programmation.
                    Priver, il n'en reste pas moins visible pour tous.
                    Actuellement en cours de développement. </p>
            </div>

        </div>

        <!-- Affichage des questions -->
        <div id="qstIndex" class="col-12">
            <h2 class="titleIndex">Top 5 des questions !</h2>
            <?php
            // Affichage des questions d'après la recherche et default
            while ($questions = $allQuestion->fetch()) {
            ?>
                <!-- Création de carte pour les questions par défaut  -->
                <div class="card">
                    <div class="card-header">
                        <a href="questionReade.php?id=<?= $questions['id'] ?>"><?= $questions['title_question']; ?></a>
                    </div>
                    <div class="card-body">
                        <?= $questions['content_question']; ?>
                    </div>
                    <div class="card-footer">
                        <p>Publié par:<a href="profil.php?id=<?= $questions['id_author'] ?>"><?= $questions['pseudo_author']; ?></a>. Date le : <?= $questions['date_question']; ?></p>
                        <?php if (!empty($questions['date_alter'])) {
                        ?>
                            <p>Modifié le : <?= $questions['date_alter']; ?></p>
                        <?php
                        } ?>
                        <p></p>
                    </div>
                </div>
                <br />
            <?php
            }
            $allQuestion->closeCursor();
            ?>
        </div>

        <!-- Affichage des articles -->
        <div id="artIndex" class="col-12">
            <h2 class="titleIndex">Top 5 des articles !</h2>
            <?php
            // Affichage des articles d'après la recherche et default
            while ($articles = $allArticles->fetch()) {
            ?>
                <!-- Création de carte pour les questions par défaut  -->
                <div class="card">
                    <div class="card-header">
                        <a href="articleReade.php?id=<?= $articles['id'] ?>"><?= $articles['title_article']; ?></a>
                    </div>
                    <div class="card-body">
                        <?= $articles['text_article']; ?>
                    </div>
                    <div class="card-footer">
                        <p>Publié par:<a href="profil.php?id=<?= $articles['author_article'] ?>"><?= $articles['pseudo_article']; ?></a>. Date le : <?= $articles['date_article']; ?></p>
                        <?php if (!empty($articles['article_alter'])) {
                        ?>
                            <p>Modifié le : <?= $articles['article_alter']; ?></p>
                        <?php
                        } ?>
                        <p></p>
                    </div>
                </div>
                <br />
            <?php
            }
            $allArticles->closeCursor();
            ?>
        </div>
    </div>
    </div>

    <footer class="col-12">
        <h1 id="logo">👽 Lead Space Code 🛸 © 2022</h1><br />
        <div id="links">
            <a href="https://devpeyroteric.fr/asset/template/contact.php" target="_blank">Contact</a> - <a href="info.php" target="_blank">À propos</a> - <a href="https://devpeyroteric.fr" target="_blank">Mentions légales</a>
        </div>
    </footer>


    <!-- En-pied de page -->
    <?php require('includes/footer.php'); ?>


</body>

</html>