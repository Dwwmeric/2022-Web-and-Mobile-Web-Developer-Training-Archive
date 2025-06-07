<!-- HTML début -->
<!DOCTYPE html>
<html lang="en">
<!-- En-tête -->
<?php include_once('includes/head.php'); ?>

<body class="bg_login">
    <br><br>
    <!-- Formulaire de connexion -->
    <section id="SectionResetPsw">
        <h1 id="titleReset">Envoi de mail confirmé </h1>
        <img src="assets/image/reset.png" alt="fléche" class="clic">
        <form id="FormReset" method="POST">

            <!-- Mail -->
            <div>
                <p class="textendRst">Votre mail est envoyé, vérifier bien dans vos spams et nous vous invitons a retourner sur notre page d'accueil.
                    <a href="index.php" id="linkendRst">
                        <p>👉 Accueil !</p>
                    </a>
                </p>
                <!-- lien -->
            </div>
            <br>
        </form>
    </section>
</body>

</html>