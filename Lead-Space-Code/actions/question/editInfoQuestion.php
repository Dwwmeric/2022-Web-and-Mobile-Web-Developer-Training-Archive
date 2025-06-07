<?php
// Connection à la base de données 
require('actions/dataBase.php');


// Condition pour la modification de la question  
if (isset($_GET['id']) && !empty($_GET['id'])) {

    // Variable pour la requête sql
    $idQuestion = $_GET['id'];
    // Requête pour la récupération des données 
    $updateQuestion = $bdd->prepare('SELECT * FROM questions WHERE id = ?');
    $updateQuestion->execute([$idQuestion]);

    // Vérification si la requête est pleine 
    if ($updateQuestion->rowCount() > 0) {

        // Récupérations des données
        $infoQuestion = $updateQuestion->fetch();
        $updateQuestion->closeCursor();
        // Vérifie l'auteur de la question 
        if ($infoQuestion['id_author'] == $_SESSION['id']) {

            // Variable pour les différentes données 
            $questionTitle = $infoQuestion['title_question'];
            $questionTheme = $infoQuestion['theme_question'];
            $questionDesc  = $infoQuestion['content_question'];
            $questionDate = $infoQuestion['date_question'];

            // Enlevé les sauts à la ligne de la fonction php nl2br pour l'affichage des données   
            $questionDesc = str_replace("<br />", "", $questionDesc);
        } else {
            // Message d'erreur 
            $errorMsg = "Attention, vous n'êtes pas l'auteur de cette question !";
        }
    } else {
        // Message d'erreur 
        $errorMsg = "Attention pas de question trouvé !";
    }
} else {
    // Message d'erreur lors d'un formulaire incomplet
    $errorMsg = "Veuillez compléter le formulaire !";
}
