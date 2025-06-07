<?php
require('asset/action/indexContoler.php');
?>

<!-- Corp Html -->
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="Peyrot Eric">
	<title>Url Lite</title>
	<link rel="stylesheet" type="text/css" href="asset/style.css">
	<link rel="icon" type="image/png" href="asset/img/—Pngtree—green check mark icon flat_6369017.png">
	<!-- style text -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Bungee+Inline&display=swap" rel="stylesheet">
</head>

<body>
	<!-- section url lite -->
	<section id="urlLite" class="container-fluid">


			<!-- HEADER -->
			<header>
				<h1 id="logo">🔧 Url Lite ⚙️</h1>
			</header>

			<h2>Besoin d'un URL plus court ?</h2>
			<h3>Un lien plus rapide pour vos partage !</h3>

			<!-- FORM -->
			<form method="POST">
				<input type="url" id="contentUrl" name="url" placeholder="Collez votre lien ">
				<button type="submit" id="urlValid" name="urlValid">Raccourcir</button>
			</form>

			<?php if (isset($_GET['error']) && isset($_GET['message'])) { ?>
				<div class="center">
					<div id="result">
						<b><?php echo htmlspecialchars($_GET['message']); ?></b>
					</div>
				</div>
			<?php } else if (isset($_GET['short'])) { ?>
				<div class="center">
					<div id="result">
						<b>URL RACCOURCIE : </b>
						http://urllite.devpeyroteric.fr/?l=<?php echo htmlspecialchars($_GET['short']); ?>
					</div>
				</div>
			<?php } ?>


	</section>

	<!-- BRANDS -->
	<section id="brands" class="container-fluid">

		<!-- CONTAINER -->
		<div >
			<h3>Ils nous font confiance</h3>
			<a href="#" class="picture" target="_blank">👽 Lead Space Code 🛸</a>
		</div>

	</section>

	<!-- FOOTER -->
	<footer>
		<h1 id="logo">🔧 Url Lite ⚙️</h1><br>
		<a href="https://devpeyroteric.fr/asset/template/contact.php" target="_blank">Contact</a> - <a href="https://devpeyroteric.fr" target="_blank">À propos</a>
	</footer>
</body>

</html>