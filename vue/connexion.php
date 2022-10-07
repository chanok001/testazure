<?php 
	ob_start();
?>
<div class="formulaire">
	<form action="index?type=connexion" method="post" class="form2">
		<label for="mail">Adresse mail :</label>
		<input type="email" name="mail" id="mail" required>
		<label for="password">Mot de passe :</label>
		<input type="password" name="password" id="password" required>
		<input type="submit" value="Connexion" name="connexion">
	</form>
</div>
<?php 
	$contenu = ob_get_clean();
	require 'gabarit.php';
?>	