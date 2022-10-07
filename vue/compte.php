<?php 
	ob_start();
?>
<div id="compte">
    <div class="info">
        <h2>Mes informations personnelles :</h2>
        <?php foreach($list_donnee as $donnee){?>
        <p>Nom : <?php echo $donnee["nom"]?></p>
        <p>Prenom : <?php echo $donnee["prenom"]?></p>
        <p>Mail : <?php echo $donnee["mail"]?></p>
        <?php }?>
    </div>
    <div class="changement">
    <h2>Modifier mes informations :</h2>
        <form action="index?type=compte&&action=changer_info" method="post" class="form2">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" required>
            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" id="prenom" required>
            <input type="submit" value="Changer" name="changer_info">
        </form>
        <form action="index?type=compte&&action=changer_mail" method="post" class="form2">
            <label for="mail">Adresse mail :</label>
            <input type="email" name="mail" id="mail" required>
            <input type="submit" value="Changer" name="changer_mail">
        </form>
        <form action="index?type=compte&&action=changer_mdp" method="post" class="form2">
            <label for="password">Mot de passe :</label>
            <input type="password" name="password" placeholder="Ancien mot de passe"id="password" required>
            <input type="password" name="password2" placeholder="Nouveau mot de passe" id="password" required>
            <input type="password" name="password_verif"  placeholder="retaper le mot de passe" id="password" required>
            <input type="submit" value="Changer" name="changer_mdp">
        </form>
    </div>
</div>
<?php
	$contenu = ob_get_clean();
	require 'gabarit.php';
?>