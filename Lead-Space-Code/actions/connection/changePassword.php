<?php
session_start();
// Appelle la base de données
require('actions/dataBase.php');

// Création de la condition pour vérifier si le formulaire de change-psw est validé 
if (isset($_POST['submitReset'])) {

    //Vérification pour voir si les champs ne sont pas vide 
    if (!empty($_POST['passwordReset'])) {

        // Fonction password_hash pour encoder notre password ici avec l'option ARGON2I
        $resetPassword = password_hash($_POST['passwordReset'], PASSWORD_ARGON2I);
        $mailPasswor = $_SESSION["restMail"];

        $updatePsw = $bdd->prepare('UPDATE users SET password = ? WHERE mail = ?');
        $updatePsw->execute([$resetPassword, $mailPasswor]);
        $updatePsw->closeCursor();

        //Détruis la session 
        session_destroy();

        // Redirection vers la page de connection 
        header('Location: login.php');
    }
}
