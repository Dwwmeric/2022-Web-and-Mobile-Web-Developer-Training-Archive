<?php //Gestion de l'affichage des articles dans index.php 
// Connexion Base de données 
require('actions/dataBase.php');

// Récupérations des commentaires pour un article
$getAllRemark = $bdd->prepare('SELECT * FROM remark WHERE id_article = ? ORDER BY id_article DESC');
$getAllRemark->execute([$idArticle]);
