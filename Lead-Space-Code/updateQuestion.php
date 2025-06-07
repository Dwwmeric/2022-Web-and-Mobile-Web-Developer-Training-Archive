<!-- Appel des fichiers php  -->
<?php 
    require ('actions/security/securitiAction.php');
    require ('actions/question/editInfoQuestion.php');
    require ('actions/question/editUpdateQuestion.php');
?> 
    <!DOCTYPE html>
        <html lang="en">
            <!-- En-tête -->
            <?php include_once('includes/head.php');?>
        <body>
            <!-- NavBar -->
            <?php require_once('includes/navBar.php');?>
            </br></br>
                <div class="container">
                        <!-- Message d'erreur si le formulaire n'est pas remplie -->
                        <?php
                            if (isset($errorMsg)) {
                                echo '<p>'.$errorMsg.'</p>';
                            } elseif (isset($successMsg)) {
                                echo '<p>'.$successMsg.'</p>';
                            }
                        ?>

                        <!-- Condition  pour afficher le formulaire -->
                        <?php if(isset($questionDate)){
                            ?>
                                <!-- formulaire de création d'une quastion -->
                                <form  method="POST">
                                    <!-- titre de la question -->
                                    <div class="mb-3">
                                        <label class="form-label">Titre de la question</label>
                                        <input type="text" class="form-control" name="titleUpdate" value="<?= $questionTitle; ?>">
                                    </div>
                                    <!-- selected  sujet -->
                                    <select class="form-select" name="themeSelectUpdate">
                                        <option selected><?= $questionTheme; ?> </option>
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
                                        <label for="exampleFormControlTextarea1" class="form-label">Votre question ?</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="textDescUpdate"><?= $questionDesc; ?> </textarea>
                                    </div>
                                    <!-- Boutton valider  -->
                                    <button type="submit" class="btn btn-primary" name="updateQuestion">Modifier</button>
                                </form>
                            <?php 
                        } ?>
                </div>  
        </body>
        </html>