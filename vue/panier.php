<?php 
	ob_start();
?>
<div id="panier">
    <table>
        <div>
            <tr style="font-size: 1.2rem;">
                <td>Voiture</td>
                <td>Prix</td>
                <td>Supprimer</td>
            </tr>
        </div>
        <?php
                $total = 0;
                foreach($array_panier as $produit){
                    $total = $total+$produit["prix"];
        ?>
        <tr>
            <td><?php echo $produit["marque"]?></td>
            <td><?php echo $produit["prix"]?>€</td>
            <td><a href="index.php?type=panier&&action=delete&&nprod=<?php echo $produit["occasion_id"] ?>"><button>Supprimer</button></a></td>
        </tr>
        <?php }?>
    </table>

    <div id="prix_panier">
        <h3>prix total : <?php echo $total."€"?></h3>
        <form action="index.php?type=panier&&action=clear" method="post">
            <input type="submit" name="acheter" value="acheter">
        </form>
    </div>
</div>
<?php
	$contenu = ob_get_clean();
	require 'gabarit.php';
?>