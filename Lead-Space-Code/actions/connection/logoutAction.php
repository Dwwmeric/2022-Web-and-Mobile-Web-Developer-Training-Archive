<?php // Contrôle la déconnexion de l'utilisateur 
//Appelle la session
session_start();
//On récupère les données sessions 
$_SESSION = [];
//Détruis la session 
session_destroy();
//Redirection vers la page index
header('Location:../../index.php');
