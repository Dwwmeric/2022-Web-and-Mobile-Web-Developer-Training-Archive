<?php 
// Création du mail de contact 
 if (isset($_POST['contactMeSubmit'])) { 

    // Vérification si le formulaire et bien remplie 
    if (!empty($_POST['emailContact']) && !empty($_POST['sujetContact']) && !empty($_POST['ContactTextarea1'])){

        //Variable pour le mail d'envoi 
        $mailContact = htmlspecialchars($_POST['emailContact']);
        $sujetContact = htmlspecialchars($_POST['sujetContact']);
        $textContact = nl2br(htmlspecialchars($_POST['ContactTextarea1']));

          // Création d'un mail de récupération 

          $to      = "peyroteric@yahoo.com";
          $subject = $sujetContact;
          $message =  $textContact;

          $headers  = 'MIME-Version: 1.0' . "\r\n";
          $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
          $headers .= 'From:'.$mailContact.''. "\r\n";

          mail($to, $subject, $message, $headers);
    }else {
        // Message d'erreur si formulaire incomplet
        $errorMsg = "Le formulaire est incomplet!";
    }
    
 }