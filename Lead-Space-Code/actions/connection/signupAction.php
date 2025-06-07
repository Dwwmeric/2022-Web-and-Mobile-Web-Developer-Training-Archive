<?php
// Appel de la base de données
require('actions/dataBase.php');
// Appel de la session 
session_start();

// Création de la condition pour vérifier si le formulaire d'inscription est validé 
if (isset($_POST['submitLogin'])) {

    // Vérification pour voir si les champs ne sont pas vide 
    if (!empty($_POST['pseudo']) && !empty($_POST['name']) && !empty($_POST['firstName']) && !empty($_POST['mail']) && !empty($_POST['password'])) {
        // Récupérations des données du formulaire d'inscription
        $usersPeusdo = htmlspecialchars($_POST['pseudo']);
        $usersName = htmlspecialchars($_POST['name']);
        $usersFirstName = htmlspecialchars($_POST['firstName']);
        $usersMail = htmlspecialchars($_POST['mail']);
        // Fonction password_hash pour encoder notre password ici avec l'option ARGON2I
        $usersPassword = password_hash($_POST['password'], PASSWORD_ARGON2I);

        // Requête sql pour la récupération du pseudo et vérifier si déjà existant  
        $existPeusdo = $bdd->prepare('SELECT pseudo FROM users WHERE pseudo = ?');
        // Execute la requête sql 
        $existPeusdo->execute(array($usersPeusdo));
        $existPeusdo->closeCursor();

        // Vérificationd si la requête n'est pas vide 
        if ($existPeusdo->rowCount() == 0) {

            // Inscription d'un nouvelle utilisateur 
            $newUser = $bdd->prepare('INSERT INTO users(pseudo, name, firts_name, mail, password)VALUES(?,?,?,?,?)');
            $newUser->execute(array($usersPeusdo, $usersName, $usersFirstName, $usersMail, $usersPassword));
            $newUser->closeCursor();

            // Récupération des données utilisateur 
            $userConnect = $bdd->prepare('SELECT id, pseudo, name,firts_name FROM users WHERE name =? AND firts_name = ? AND pseudo = ?');
            $userConnect->execute(array($usersName, $usersFirstName, $usersPeusdo));
            // Récupération  des informations id , pseudo , name , firtsname
            $userInfos = $userConnect->fetch();
            $userConnect->closeCursor();

            // Récupération des informations en données sessions 
            $_SESSION['auth'] = true;
            $_SESSION['id'] = $userInfos['id'];
            $_SESSION['name'] = $userInfos['name'];
            $_SESSION['firstName'] = $userInfo['frits_name'];
            $_SESSION['pseudo'] = $userInfo['pseudo'];

            // Redirection vers la page de connection 
            header('Location: index.php');
        } else {
            // Message d'erreur si le pseudo existe 
            $errorMsg = "L'utilisateur existe déjà sur le site.";
        }
    } else {
        // Message d'erreur lors d'un formulaire incomplet 
        $errorMsg = "Veuillez compléter le formulaire!";
    }
}
