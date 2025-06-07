<?php
    session_start();
    require ('actions/question/showQuestion.php');
    require_once ('actions/question/questionAnswers.php');
    require_once ('actions/question/allAnswerQuestion.php');
?>
    <!DOCTYPE html>
        <html lang="en">
            <!-- En-tête -->
            <?php include_once('includes/head.php');?>
        <body>
            <!-- NavBar -->
            <?php require_once('includes/navBar.php');?>
            <br/><br/>
            
                <div class="container">
                        <!-- Message -->
                    <?php
                        if (isset($errorMsg)) {
                            echo '<p>'.$errorMsg.'</p>';
                        } elseif (isset($successMsg)) {
                            echo '<p>'.$successMsg.'</p>';
                        }
                    ?>
                    <!-- section de la question  -->
                    <?php if(isset($questionInfo['id'])){
                        ?>
                        <section id="questionShow">
                            <!-- Titre de la question -->
                            <h2><?= $questionInfo['title_question']; ?></h2>
                            <p>Publié par: <?= $questionInfo['pseudo_author']; ?>.</p> 
                            <p>Publié le: <?= $questionInfo['date_question']; ?>.</p>
                            <p>Théme: <?= $questionInfo['theme_question']; ?>.</p>
                            <!-- Condition si modifier -->
                            <?php if(!empty($questionInfo['date_alter'])){
                                ?><p>Modifié le: <?= $questionInfo['date_alter'];?>. </p><?php
                            } ?>
                            <p><?= $questionInfo['content_question']; ?></p>
                        </section>
                        <br/>
                        <!-- Affichage des réponce dans l'ordre de publication  -->
                        <section id="getAnswers">
                            <?php
                                while($answers = $getAllAnswer->fetch()){
                                    ?>
                                        <div class="card">
                                            <div class="card-header">
                                                <p>Publié par: <?= $answers ['pseudo_author'];?>, le <?= $answers ['date_answer'] ?>.</p>
                                            </div>
                                            <div class="class-body">
                                            <p><?= $answers ['content_answer'];?></p>
                                            </div>
                                        </div>
                                        <br/>
                                    <?php
                                }
                                $getAllAnswer->closeCursor();
                             ?>
                        </section>
                        <!-- Réponse à la question  -->
                        <section id="comentaireQuestion">
                            <?php
                                if (isset($_SESSION["auth"])) { 
                            ?>
                                <div class="mb-3">
                                    <form class="form-group" method="POST">
                                        <label class="form-label">Répondre à la question: </label>
                                        <textarea class="form-control" name="textResponce" rows="3"></textarea>
                                        <br/>
                                        <button type="submit" name="submitAnswer" class="btn btn-info">Publié !</button>
                                    </form>
                                </div>
                            <?php
                                } else {
                            ?> 
                                <h3>Pour répondre connectez- vous:</h3>
                                <a href="login.php" class="btn btn-primary">Connexion</a> 
                                <a href="signup.php" class="btn btn-primary">Inscription</a> 
                            <?php } ?>
                        </section>
                        <?php
                    }else {
                        ?>
                        <?php 
                    }
                    ?>
                
                </div>
        </body>
        </html>