<?php  
// Appel de la session
session_start();
// Vérifie ci la qesion existe 
    if(!isset($_SESSION['auth'])){
        // Redirection vers login  
        header('Location: login.php');
    }