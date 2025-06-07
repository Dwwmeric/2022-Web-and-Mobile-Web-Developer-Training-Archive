<?php
require('actions/dataBase.php');

// Vérifié si le buton formulaire est valider 
if (isset($_POST['submitAnswer'])) {

    // Vérifie ci le champ et plein 
    if (!empty($_POST['textResponce'])) {
        // Récupère la réponse 
        $user_answer = nl2br(htmlspecialchars($_POST['textResponce']));
        $date_answer = date('d/m/y H:i:s');

        // Requête sql pour l'insertion des données 
        $insertAnswer = $bdd->prepare("INSERT INTO answer_questions(id_author, pseudo_author,id_question, date_answer, content_answer) VALUES(?,?,?,?,?)");
        $insertAnswer->execute([$_SESSION['id'], $_SESSION['pseudo'], $idQuestion, $date_answer, $user_answer]);
    }
}
