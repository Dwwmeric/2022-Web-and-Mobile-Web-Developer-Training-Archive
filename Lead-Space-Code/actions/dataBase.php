<?php 
    try {
        $sqlHost = '127.0.0.1';
        $sqlPort = '3306';
        $sqlUser = 'u392626676_Eric_peyrot';
        $sqlPassword = 'H%4Xdjz9pv97/2#UZ__H';
        $dbName = 'u392626676_devpeyroteric';
        //Connexion base de données 
        $bdd = new PDO('mysql:host='.$sqlHost.';dbname='.$dbName.';charset=utf8;port='.$sqlPort.'',$sqlUser,$sqlPassword);
    }catch(Exception $e){
        die('Une erreur a été trouvée : '. $e->getMessage());
    }