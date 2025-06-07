<?php
// CONNEXION DATABASE
require('dataBase.php');

// Reccupération avec le lien court 
if(isset($_GET['l'])){

	
	
	// VARIABLE
	$codeUrl = htmlspecialchars($_GET['l']);


	// si l'url lite exixste ?
 	$req =$bdd->prepare('SELECT COUNT(*) AS x FROM links WHERE lite_url = ?');
 	$req->execute(array($codeUrl));

 	while($result = $req->fetch()){
		$req->closeCursor();

 		if($result['x'] != 1){
			header('location:  ../../index.php?error=true&message=Adresse url non connue');
 			exit();
 		}

 	}

	// REDIRECTION
	$req = $bdd->prepare('SELECT * FROM links WHERE lite_url = ?');
 	$req->execute(array($codeUrl));

 	while($result = $req->fetch()){
		$req->closeCursor();

		header('location: '.$result['url']);
		exit();

	}

}

// IS SENDING A FORM
if(isset($_POST['url'])) {
	
	// VARIABLE
	$url = $_POST['url'];
	
	// VERIFICATION SI URL EXISTE PAS 
	if(!filter_var($url, FILTER_VALIDATE_URL)) {
		// PAS UN LIEN
			header('location: ../../index.php?error=true&message=Adresse url non valide');
		 	exit();
	 }
		
	// RACCOURCIE
	$linkCut = crypt($url, rand());
	
	// SI EXIST UNE FOIS ?
	$req = $bdd->prepare('SELECT * FROM links WHERE url = ?');
	$req->execute(array($url));
	
	while($result = $req->fetch()){

		$req->closeCursor();
		
		 if($result['url'] != 0){

			// VARRIABLE DE RENVOI 
			$LiteExiste = $result['lite_url'];

			header('location: ../../index.php?short='.$LiteExiste);
			exit();
			}
			
		}
		
		// SAUVEGARDE BDD URL 
		$req = $bdd->prepare('INSERT INTO links(url, lite_url) VALUES(?, ?)');
		$req->execute(array($url, $linkCut));
		$req->closeCursor();
		
		header('location: ../../index.php?short='.$linkCut);
		exit();
		
}
