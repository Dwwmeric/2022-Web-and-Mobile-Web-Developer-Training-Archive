<!-- Inclure les documents php  -->
<?php require("actions/connection/signupAction.php"); ?>

<!-- HTML début -->
<!DOCTYPE html>
<html lang="en">
<!-- Head dans includes/head.php -->
<?php include "includes/head.php" ?>

<body class="bg_login">
    <br><br>
    <!-- Formulaire d'inscription -->
    <section id="SectionSignup" class="container-fluid">
        <h1 id="titleSignup">Inscription</h1>
        <img src="assets/image/robot.png" alt="robot" class="robotSignup">
        <form id="FormSignup" method="POST" class="container ">

            <!-- Message d'erreur si le formulaire n'est pas remplie -->
            <?php
            if (isset($errorMsg)) {
                echo '<p class="errorSignup">❌' . $errorMsg . '</p>';
            }
            ?>
            <!-- Pseudo -->
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label textSignup">Pseudo</label>
                <input type="text" class="form-control" name="pseudo">
            </div>
            <!-- Name  -->
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label textSignup">Nom</label>
                <input type="text" class="form-control" name="name">
            </div>
            <!-- First name  -->
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label textSignup">Prénom</label>
                <input type="text" class="form-control" name="firstName">
            </div>
            <!-- Mail -->
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label textSignup">Émail</label>
                <input type="email" class="form-control" name="mail">
            </div>
            <!-- Mot de passe  -->
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label textSignup">Password</label>
                <input type="password" class="form-control" name="password">
            </div>
            <!-- Boutton valider  -->
            <button type="submit" class="signupButton col-4 offset-4" name="submitLogin">🚀 S'inscrire</button>
            <a href="login.php" id="linkLogin">
                <p>👉🏽 J'ai déjà un compte!</p>
            </a>
        </form>

    </section>

</body>

</html>