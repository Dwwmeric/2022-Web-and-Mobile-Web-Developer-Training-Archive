<?php // Contrôle la connexion de l'utilisateur
session_start();
//Appelle la base de données
require('actions/dataBase.php');

//Création de la condition pour vérifier si le formulaire de login est validé 
if (isset($_POST['submitLogin'])) {

    //Vérification pour voir si les champs ne sont pas vide 
    if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {
        //Récupération des variables des différents champs 
        $usersPeusdo = htmlspecialchars($_POST['pseudo']);
        //Fonction password_hash pour encoder notre password ici avec l'option ARGON2I
        $usersPassword = htmlspecialchars($_POST['password']);
        //récupération des données de l'utilisateur qui va se connecter 
        $userLogin = $bdd->prepare('SELECT * FROM users WHERE pseudo = ?');
        $userLogin->execute(array($usersPeusdo));

        //Vérifie si le pseudo existe.
        if ($userLogin->rowCount() > 0) {
            //Récupération des données
            $userInfos = $userLogin->fetch();
            $userLogin->closeCursor();
            //Vérifie password
            if (password_verify($usersPassword, $userInfos["password"])) {
                //Récupération des informations en données session propre à l'utilisateur 
                $_SESSION['auth'] = true;
                $_SESSION['id'] = $userInfos['id'];
                $_SESSION['name'] = $userInfos['name'];
                $_SESSION['firstName'] = $userInfos['frits_name'];
                $_SESSION['pseudo'] = $userInfos['pseudo'];
                //Redirection vers la page d'accueil
                header('Location: index.php');
            } else {
                //Message d'erreur si le mot de passe est incorrect 
                $errorMsg = "Votre mot de passe est incorrect.";
            }
        } else {
            //Message d'erreur si le pseudo est incorrect
            $errorMsg = "Le pseudo est incorrect.";
        }
    } else {
        //Message d'erreur lors d'un formulaire incomplet 
        $errorMsg = "Veuillez compléter le formulaire !";
    }
}
