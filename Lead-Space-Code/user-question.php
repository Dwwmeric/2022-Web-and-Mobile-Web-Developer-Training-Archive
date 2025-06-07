<!-- Appel les fichiers php-->
<?php
    require ('actions/security/securitiAction.php');
    require ('actions/question/userQuestionAction.php');
    require ('actions/question/editUpdateQuestion.php');
?>
    <!DOCTYPE html>
        <html lang="en">
            <!-- En-tête -->
            <?php include_once('includes/head.php');?>
        <body>
            <!-- NavBar -->
            <?php require_once('includes/navBar.php');?>
            </br>
            <!-- Card question -->
            <div class="container">
                <!-- Message d'erreur si le formulaire n'est pas rempli -->
                <?php
                    if (isset($errorMsg)) {
                        echo '<p>'.$errorMsg.'</p>';
                    } elseif (isset($successMsg)) {
                        echo '<p>'.$successMsg.'</p>';
                    }
                    ?>
                    
                    <?php 
                    while($question = $getQuestion->fetch()){
                        ?>
                            <div class="card">
                                <div class="card-header">
                                    <!-- Title question -->
                                    <a href="questionReade.php?id=<?= $question['id'] ?>"><?= $question['title_question']; ?></a>
                                </div>
                                <div class="card-body">
                                    <p class="card-text"> <?=  $question['theme_question']; ?> </p>
                                    <p class="card-text"><?=  $question['content_question']; ?></p>
                                    <p class="card-text"><?=  "Date: ".$question['date_question']." ".$question['pseudo_author']."."; ?></p>
                                    <a href="questionReade.php?id=<?= $question['id'] ?>" class="btn btn-primary">Accéder</a> 
                                    <a href="updateQuestion.php?id=<?=$question['id'];?>" class="btn btn-primary">Modifier</a> 
                                    <a href="actions/question/deleteQuestion.php?id=<?=$question['id'];?>" class="btn btn-primary">Supprimer</a>
                                </div>
                            </div>
                        </br>
                        <?php
                    }
                    $getQuestion->closeCursor();
                ?>
            </div>
            
        </body>
        </html>