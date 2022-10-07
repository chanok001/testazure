<?php 
	ob_start();
?>
<div id="compte">
    <div class="commande">
        <h2>Tables des clients :</h2>
        <table>
            <div class="info">
                <tr style="font-size: 1.2rem;">
                    <td>ID :</td>
                    <td>Nom :</td>
                    <td>Mail :</td>
                </tr>
                <?php foreach($list_client as $client){?>
                <tr>
                    <td><?php echo $client["user_id"]?></td>
                    <td><?php echo $client["nom"]?></td>
                    <td><?php echo $client["mail"]?></td>
                </tr>
                    <?php }?>
            </div>
        </table>
    </div>
    <div class="info">
        <h2>Ajouter une voiture neuve :</h2>
        <div class="formulaire">
        <form action="index?type=admin" method="post" class="form2">

            <label for="marque">Marque :</label>
            <select name="marque" id="marque" required>
                <option value="bmw">BMW</option>
                <option value="audi">AUDI</option>
                <option value="mercedes">MERCEDES</option>
                <option value="volkswagen">VOLKSAGEN</option>
            </select>

            <label for="img">Image :</label>
            <input type="text" name="img" id="img" required>

            <label for="km">Kilométrage :</label>
            <input type="text" name="km" id="km" required>

            <label for="annee">Année :</label>
            <select name="annee" id="annee" required>
                <option value="2021">2021</option>
                <option value="2020">2020</option>
                <option value="2019">2019</option>
                <option value="2018">2018</option>
                <option value="2017">2017</option>
                <option value="2016">2016</option>
                <option value="2015">2015</option>
                <option value="2014">2014</option>
                <option value="2013">2013</option>
                <option value="2012">2012</option>
                <option value="2011">2011</option>
                <option value="2010">2010</option>
                <option value="-2010">- de 2010</option>
            </select>

            <label for="chevaux">Chevaux :</label>
            <input type="text" name="chevaux" id="chevaux" required>

            <label for="carburant">Carburant :</label>
            <select name="carburant" id="carburant" required>
                <option value="diesel">Diesel</option>
                <option value="essence">Essence</option>
            </select>

            <label for="local">Localité :</label>
            <input type="text" name="local" id="local" required>

            <label for="prix">Prix :</label>
            <input type="text" name="prix" id="prix" required>
            
            <input type="submit" value="Ajouter" name="ajouter">
        </form>
</div>
    </div>
</div>
<?php
	$contenu = ob_get_clean();
	require 'gabarit.php';
?>