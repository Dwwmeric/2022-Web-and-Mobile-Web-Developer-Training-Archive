<?php
// Appel de la session 
session_start();
?>
<!-- HTML début -->
<!DOCTYPE html>
<html lang="fr">
<!-- En-tête -->
<?php
 include_once('includes/head.php'); 
 require('actions/connection/changePassword.php');
// vérrification ci la variable $_Get n'est pas vide
if (!empty($_GET['section']) && $_GET['section'] == $_SESSION['codeMail']) {

 ?>   
<body class="bg_psw">
    <br><br>
    <!-- Formulaire de connexion -->
    <section id="SectionResetPsw">
        <h1 id="titleResetPsw">Changer de mot de passe </h1>
        <form id="FormResetPsw" method="POST">
            <!-- Message d'erreur si le formulaire n'est pas rempli -->
            <?php
            if (isset($errorMsg)) {
                echo '<p class="errorRst">❌ ' . $errorMsg . '</p>';
            }
            ?>
            <!-- Pseudo -->
            <div>
                <p class="textResetPsw">Changement de mot de passe pour l'email : </p>
                <p class="mailRstPsw"><?= $_SESSION["restMail"] ?></p>
            </div>
            <!-- Mot de passe -->
            <div>
                <label for="exampleInputPassword1" class="form-label textResetPsw">Password</label>
                <input type="password" class="form-control" name="passwordReset">
            </div>
            <br>
            <!-- Bouton validé -->
            <button type="submit" id="resetPswButton" name="submitReset">🛸 Valider</button>
        </form>
    </section>
</body>
<?php
} else { 
?>
<body class="bg_psw">
    <br><br>
    <!-- Formulaire de connexion -->
    <section id="SectionResetPsw">
        <h1 id="titleResetPsw">Erreur </h1>
        <form id="FormResetPsw" method="POST">
            <!-- Message d'erreur si le formulaire n'est pas rempli -->
            <?php
            if (isset($errorMsg)) {
                echo '<p class="errorRst">❌ ' . $errorMsg . '</p>';
            }
            ?>
            <!-- Pseudo -->
            <div>
                <p class="textResetPsw">Votre lien n'est plus activé Veuillez recommencer l'opération.</p>
            </div>
            <br>
            <!-- Bouton validé -->
            <a href="index.php" id="nullPswButton" >🛸 Accueil</a>
        </form>
    </section>
</body>
<?php
}
?>


</html>