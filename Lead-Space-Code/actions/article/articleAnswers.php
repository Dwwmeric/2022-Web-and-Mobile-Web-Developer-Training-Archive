<?php //  Création d'un commentaire pour un article 
require('actions/dataBase.php');

// Vérifié si le buton formulaire est valider 
if (isset($_POST['submitCom'])) {

    // Vérifie ci le champ et plein
    if (!empty($_POST['textCommentaire'])) {
        // Récupère la commentaire  
        $user_remark = nl2br(htmlspecialchars($_POST['textCommentaire']));
        $date_remark = date('d/m/y H:i:s');

        // Requête sql pour l'insertion des données  
        $insertRemark = $bdd->prepare("INSERT INTO remark(id_author, pseudo_author,id_article, date_remark, content_remark) VALUES(?,?,?,?,?)");
        $insertRemark->execute([$_SESSION['id'], $_SESSION['pseudo'], $idArticle, $date_remark, $user_remark]);
        $insertRemark->closeCursor();
    }
}
