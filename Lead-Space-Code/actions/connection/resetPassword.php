<?php
// Appel de la base de données
require('actions/dataBase.php');
// Appel de la session 
session_start();

// Création de la condition pour vérifier si le formulaire réinitialisation est validé 
if (isset($_POST['ResetSubmit'])) {


     //Vérification pour voir si les champs ne sont pas vide 
     if (!empty($_POST['email'])) {

          // Récupération des variables des différents champs 
          $userResetMail = htmlspecialchars($_POST['email']);

          //Vérifie que le mail soit valide. 
          if (filter_var($userResetMail, FILTER_VALIDATE_EMAIL)) {

               //Récupère si le mail existe dans la base de données 
               $mailExiste = $bdd->prepare('SELECT * FROM users WHERE mail = ?');
               $mailExiste->execute(array($userResetMail));

               if ($mailExiste->rowCount() > 0) {

                    $pseudo = $mailExiste->fetch();
                    $mailExiste->closeCursor();

                    //Récupération des données pour le mail de réinitialisation
                    $_SESSION['userRest'] = $pseudo['pseudo'];
                    $_SESSION['restMail'] = $userResetMail;
                    $_SESSION['codeMail'] = $codeReset = rand();

                    //Vérifie si la table contient déjà le mail.
                    $mailRecupExiste = $bdd->prepare('SELECT id FROM reset_password WHERE mail = ?');
                    $mailRecupExiste->execute(array($userResetMail));

                    if ($mailRecupExiste->rowCount() > 0) {
                         // Mise à jour du code 
                         $reset_insert = $bdd->prepare('UPDATE reset_password SET code = ? WHERE mail = ?');
                         $reset_insert->execute(array($codeReset, $userResetMail));
                         $reset_insert->closeCursor();
                    } else {
                         // Insertion des donées récupération de password 
                         $reset_insert = $bdd->prepare('INSERT INTO reset_password(mail, code) VALUES (?,?)');
                         $reset_insert->execute(array($userResetMail, $codeReset));
                         $reset_insert->closeCursor();
                    }

                    // Création d'un mail de récupération 

                    $to      = $_SESSION['restMail'];
                    $subject = 'Lead code space';
                    $message = ' 
                    <html>
                         <head>
                              <title>Lead code space</title>
                         </head>
                         <body>
                         <h1 class="titleRstPsw">Bonjour, ' . $_SESSION['userRest'] . ' !</h1>
                         <p class="textRstPsw">Veuillez cliquer sur le lien pour changer votre mot de passe :</p>
                         <a href="http://forum.devpeyroteric.fr/change-psw.php?section=' . $codeReset . '">Modifier mon mot de passe </a>
                         </body>
                    </html>
                    ';

                    $headers  = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    $headers .= 'From: Lead code space' . "\r\n";

                    mail($to, $subject, $message, $headers);

                    //Redirection vers la page de comfirmation de l'envoi de mail
                    header('Location:../../../endMailResetPsw.php');
               } else {
                    //Message d'erreur  
                    $errorMsg = "L'adresse mail n'existe pas!";
               }
          } else {
               //Message d'erreur  
               $errorMsg = "Adresse non-valide!";
          }
     } else {
          //Message d'erreur lors d'un formulaire incomplet 
          $errorMsg = "Veuillez compléter le formulaire !";
     }
}
