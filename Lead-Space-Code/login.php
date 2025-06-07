<!-- Inclure les documents php -->
<?php require("actions/connection/loginAction.php"); ?>

<!-- HTML début -->
<!DOCTYPE html>
<html lang="en">
<!-- En-tête -->
<?php include_once('includes/head.php'); ?>

<body class="bg_login container-fluid">
    <br><br>
    <!-- Formulaire de connexion -->
    <section id="SectionLogin">
        <h1 id="titleLogin">Connexion</h1>
        <a href="index.php" id="linkHomeImg"><img src="assets/image/vaiseau.png" alt="navette spacial" class="starShip"></a>
        <form id="FormLogin" method="POST">
            <!-- Message d'erreur si le formulaire n'est pas rempli -->
            <?php
            if (isset($errorMsg)) {
                echo '<p class="errorLogin">❌ ' . $errorMsg . '</p>';
            }
            ?>
            <!-- Pseudo -->
            <div>
                <label for="exampleInputEmail1" class="form-label textLogin">Pseudo</label>
                <input type="text" class="form-control" name="pseudo">
            </div>
            <!-- Mot de passe -->
            <div>
                <label for="exampleInputPassword1" class="form-label textLogin">Password</label>
                <input type="password" class="form-control" name="password">
            </div>
            <br>
            <!-- Bouton validé -->
            <button type="submit" id="loginButton" name="submitLogin">🛸 Se connecter</button>
            <!-- Liens -->
            <div id="loginlinks">
                <a href="index.php" id="linkHome">
                    <p>👽 Accueil</p>
                </a>
                <!-- <a href="signup.php" id="linkSignup"> -->
                <a href="#" id="linkSignup"> 
                    <p>📄 S'inscrire</p>
                </a>
                <a href="user-reset-password.php" id="linkpassword">
                    <p>⚙️ Mot de passe oublié ?</p>
                </a>
        </form>

        </div>
    </section>
</body>

</html>