<?php
// Connexion à la batabase
require('../security/securitiAction.php');
require('../dataBase.php');

// Condition pour vérifier si la question existe
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // id de la question 
    $idQuestion = $_GET['id'];

    // Paramètre route
    $routeId = $_GET['section'];

    // Récupération des données de la question
    $bddQuestion = $bdd->prepare('SELECT * FROM questions WHERE id = ?');
    $bddQuestion->execute([$idQuestion]);

    // Vérifie si la requête existe
    if ($bddQuestion->rowCount() > 0) {

        // Récupérations des données
        $infoQuestion = $bddQuestion->fetch();
        $bddQuestion->closeCursor();
        // Vérifie l'auteur de la question 
        if ($infoQuestion['id_author'] == $_SESSION['id']) {
            // Requeste de delete 
            $destroyQuestion = $bdd->prepare('DELETE FROM questions WHERE id = ?');
            $destroyQuestion->execute([$idQuestion]);
            $destroyQuestion->closeCursor();
            // Message de suces
            $successMsg = "Votre question a bien été supprimée !";
            // Redirection vers la liste des questions
            switch ($routeId) {
                case 'profil':
                    header("Location: ../../profil.php?id= ".$_SESSION['id']."&msg=".$successMsg);
                    break;
                default:
                    header("Location: ../../user-question.php");
            }
        } else {
            // Message d'erreur
            $errorMsg = "Vous n'etes pas l'auhteur de la question !";
            // Redirection vers la liste des questions
            header("Location: ../../user-question.php");
        }
    } else {
        // Message d'erreur
        $errorMsg = "Aucune question n'a été trouvée !";
        // Redirection vers la liste des questions
        header("Location: ../../user-question.php");
    }
} else {
    // Message d'erreur
    $errorMsg = "Aucune question n'a été trouvée !";
    // Redirection vers la liste des questions
    header("Location: ../../user-question.php");
}
