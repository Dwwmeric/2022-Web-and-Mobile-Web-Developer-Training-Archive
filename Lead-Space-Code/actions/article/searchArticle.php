<?php
// Connexion à la base de données 
require('actions/dataBase.php');

// Récupération les 5 dernières articles 
$allArticles = $bdd->prepare('SELECT * FROM articles ORDER BY id DESC LIMIT 5');
$allArticles->execute();

// Récupère la recherche 
if (isset($_POST['submitSearch'])) {
    // Vérifie ci le champ et remplie 
    if (!empty($_POST['searchText'])) {
        // Récupère la recherche de l'utilisateur 
        $userSearch = $_POST['searchText'];

        // Requête pour récupération des articles correspondants 
        $allArticles = $bdd->prepare('SELECT * FROM articles WHERE title_article LIKE "%' . $userSearch . '%" ORDER BY id DESC  ');
        $allArticles->execute();
    } else {
        // Message d'erreur lors d'un formulaire incomplet 
        $errorMsg = "Veuillez compléter le champ de la recherche.";
    }
}
