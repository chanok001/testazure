<?php 
	ob_start();
?>
<div class="formulaire">
	<form action="index?type=inscription" method="post" class="form">
		<label for="nom">Nom :</label>
		<input type="text" name="nom" id="nom" required>
		<label for="prenom">Prénom :</label>
		<input type="text" name="prenom" id="prenom" required>
		<label for="mail">Adresse mail :</label>
		<input type="email" name="mail" id="mail" required>
		<label for="password">Mot de passe :</label>
		<input type="password" name="password" id="password" required>
		<input type="submit" value="Inscription" name="inscription">
	</form>
	<div>
		<p><br>J'ai déjà un compte, <a href="index.php?type=connexion">clique ici </a></br></p>
	</div>
</div>
<?php 
	$contenu = ob_get_clean();
	require 'gabarit.php';
?>	