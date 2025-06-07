<?php
require('actions/dataBase.php');

// Récupérations des réponses de la base de la question
$getAllAnswer = $bdd->prepare('SELECT * FROM answer_questions WHERE id_question = ? ORDER BY id_question DESC');
$getAllAnswer->execute([$idQuestion]);
