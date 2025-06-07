<!-- Inclure les documents php -->
<?php require("actions/connection/resetPassword.php"); ?>

<!-- HTML début -->
<!DOCTYPE html>
<html lang="en">
<!-- En-tête -->
<?php include_once('includes/head.php'); ?>

<body class="bg_login">
    <br><br>
    <!-- Formulaire de connexion -->
    <section id="SectionReset">
        <h1 id="titleReset">Récupération de mot de passe</h1>
        <img src="assets/image/reset.png" alt="fléche" class="clic">
        <form id="FormReset" method="POST">
            <!-- Message d'erreur si le formulaire n'est pas rempli -->
            <?php
            if (isset($errorMsg)) {
                echo '<p class="errorReset">❌ ' . $errorMsg . '</p>';
            }
            ?>
            <!-- Mail -->
            <div>
                <label for="exampleInputEmail1" class="form-label textLogin">Email</label>
                <input type="email" class="form-control" name="email">
            </div>
            <br>
            <!-- Bouton validé -->
            <button type="submit" id="ResetButton" name="ResetSubmit">👩🏽‍💻 Réinitialiser le mot de passe</button>
            <!-- lien -->
            <a href="login.php" id="linkReset">
                <p>👉 Retour !</p>
            </a>
        </form>
    </section>
</body>

</html>