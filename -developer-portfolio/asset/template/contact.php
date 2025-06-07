<!DOCTYPE html>
<?php 
    require('../action/contactControler.php');
?>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Peyrot Eric">
    <title>devpeyroteric.fr</title>
    <link rel="icon" type="image/png" href="../images/transparent-earth-planet-royalty-free-blue-5ef4326ab11236.9323017115930619947253.png">
    <link rel="stylesheet" href="../bootraps/css/bootstrap.min.css" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee+Inline&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style.css" type="text/css">
    <link rel="stylesheet" href="../fontawesome-free-6.1.1-web/css/all.css">
    <script src="../bootraps/js/bootstrap.min.js"></script>
</head>

<body id="contactMe">
    <section class="container contactForm">
        <form  method="POST" class="col-12">
        <?php
        if (isset($errorMsg)) {
            echo '<p>' . $errorMsg . '</p>';
        }
        ?>
            <div class="mb-3">
                <h1 id="formContactTitle">📨 Contacter moi 📨 </h1>
                <p id="formContactP">"Pour un problème rencontré sur un des sites ou plus de renseignements"</p>
            </div>
            <div class="mb-3">
                <label for="emailContact" class="form-label textForm">Votre email:</label>
                <input type="email" class="form-control" name="emailContact" id="emailContact" placeholder="exemple@gmail.com">
            </div>
            <div class="mb-3">
                <label for="emailContact" class="form-label textForm">Votre sujet:</label>
                <input type="text" class="form-control"  name="sujetContact" id="sujetContact" placeholder="Problèmé site ect ect ...">
            </div>
            <div class="mb-3">
                <label for="ContactTextarea1" class="form-label textForm">Votre Texte :</label>
                <textarea class="form-control" id="ContactTextarea1"  name="ContactTextarea1" rows="3"></textarea>
            </div>
            <button name="contactMeSubmit" type="submit" class="btn btn-success centerContact">envoyer</button>
        </form>
    </section>

</body>

</html>