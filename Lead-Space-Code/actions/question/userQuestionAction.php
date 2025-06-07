<?php
    // Appel de la base de donées
    require_once('actions/dataBase.php');
  
    // Récupération desquestions 
    $getQuestion = $bdd->prepare('SELECT * FROM questions WHERE id_author = ? ORDER BY id DESC');
    $getQuestion->execute([$_SESSION['id']]);