<?php
ob_start();
?>
<div id="voiture">
    <?php foreach($list_voiture as $voiture){?>
    <div id="nom">
		<h2><?php echo $voiture["marque"]?></h2>
        <div id="img">
            <img src="<?php echo $voiture["img"];?>" alt="">
            <div class="prix">
                <h3><?php echo $voiture["prix"]?>€</h3>
                <div class="description">
                    <p><?php echo $voiture["km"]?>KM</p>
                    <p><?php echo $voiture["annee"]?></p>
                    <p><?php echo $voiture["chevaux"]?>ch</p>
                    <p><?php echo $voiture["etat"]?></p>
                    <p><?php echo $voiture["carburant"]?></p>
                    <p><?php echo $voiture["localite"]?></p>
                    <a href="index.php?type=panier&&action=add&&nprod=<?php echo $voiture["occasion_id"] ?>" class="btn_acheter">ACHETER</a>
                </div>
            </div>
        </div>
    </div>
    <?php }?>
</div>    
<?php 
$contenu = ob_get_clean();
require 'gabarit.php';
?>