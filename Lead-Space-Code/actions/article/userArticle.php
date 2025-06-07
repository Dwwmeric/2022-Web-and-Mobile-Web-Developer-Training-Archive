<?php
//appel la database 
require_once('actions/dataBase.php');

//requet sql pour récupérer les articles 
$getArticle = $bdd->prepare('SELECT * FROM articles WHERE author_article = ? ORDER BY id DESC');
$getArticle->execute([$_SESSION['id']]);
