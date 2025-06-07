<?php 
    try {
        $sqlHost = '127.0.0.1';
        $sqlPort = '3306';
        $sqlUser = 'u392626676_admin_url_lite';
        $sqlPassword = 'D8M~*Ch=U:sVzq{p4489';
        $dbName = 'u392626676_url_lite';
        //Connexion base de données 
        $bdd = new PDO('mysql:host='.$sqlHost.';dbname='.$dbName.';charset=utf8;port='.$sqlPort.'',$sqlUser,$sqlPassword);
    }catch(Exception $e){
        die('Une erreur a été trouvée : '. $e->getMessage());
    }