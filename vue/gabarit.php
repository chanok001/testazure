<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Site web vente de voiture">
		<meta name="keywords" content="">
		<meta name="author" content="Mirko Aiesi">
		<title>AutoHeh24</title>
		<link href="./ressources/style.css" rel="stylesheet">
	</head>
	<body>
		<header>
		<h1>AutoHeh24</h1>
	    <img src="./ressources/logo.png" alt="Logo l'entreprise" class="logo">
        <nav>
            <ul>
                <li><a href="index.php?type=accueil">ACCUEIL</a></li>
				<?php
				if(empty($_SESSION["mail"])){
					echo '<li class="coller2"><a href="index.php?type=connexion">CONNEXION</a></li>';
					echo '<li class="coller"><a href="index.php?type=inscription">/ INSCRIPTION</a></li>';
				}
				else {
					echo '<li><a href="index.php?type=occasion">AJOUTER VOTRE VEHICULE !</a></li>';
					echo '<li><a href="index.php?type=compte">MON COMPTE</a></li>';
					echo '<li><a href="index.php?type=deconnexion">DÉCONNEXION</a></li>';
					if($_SESSION["perm"] == 1){
						echo '<li><a href="index.php?type=admin">ADMIN</a></li>';
					}
				}
				?>
				<li><a href="index.php?type=panier">PANIER</a></li>
            </ul>
		</header>
		<main>
			<?php echo $contenu ?>
        </main>
		<footer>
			<p>©Copyright by Mirko Aiesi</p>
		</footer>
	</body>
</html>