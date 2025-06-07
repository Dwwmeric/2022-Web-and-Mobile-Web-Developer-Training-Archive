<?php
// Connexion à la base de données 
require('actions/dataBase.php');

// Récupération les 5 dernières questions 
$allQuestion = $bdd->prepare('SELECT * FROM questions ORDER BY id DESC LIMIT 5');
$allQuestion->execute();


// Récupère la recherche 
if (isset($_POST['submitSearch'])) {
    // Vérifie ci le champ et remplie 
    if (!empty($_POST['searchText'])) {
        // Récupère la recherche de l'utilisateur 
        $userSearch = $_POST['searchText'];

        // Requête pour récupération des questions correspondants 
        $allQuestion = $bdd->prepare('SELECT * FROM questions WHERE title_question LIKE "%' . $userSearch . '%" ORDER BY id DESC  ');
        $allQuestion->execute();
    } else {
        // Message d'erreur lors d'un formulaire incomplet 
        $errorMsg = "Veuillez compléter le champ de la recherche.";
    }
}
