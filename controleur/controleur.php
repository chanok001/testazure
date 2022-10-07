<?php

    require "modele/modele.php";

    //Fonction pour afficher la vue accueil et récupérer la liste des voitures dans la base de données.
    function accueil(){
        $list_voiture = list_voiture();
        
        require "vue/accueil.php";
    }
    //Fonction pour s'inscrire avec gestion d'erreurs
    function inscription(){
        if ( !empty($_POST['inscription']) ) {
            $nom = strip_tags(htmlspecialchars(trim((string)$_POST["nom"])));
            $prenom = strip_tags(htmlspecialchars(trim((string)$_POST["prenom"])));
            $password = strip_tags(htmlspecialchars(trim((string)$_POST["password"])));
            $mail = strip_tags(htmlspecialchars(trim((string)$_POST["mail"]))); //On enleve les espaces et caractères spéciaux
            $no_script = '#<script(.*?)>(.*?)</script>#is';
            $no_sql = '/(" "and" "|" "or" "|union|where|limit|group by|select|\'|hex|substr)/i'; //Regex pour gérer les scripts et les injections SQL
            $array_client=array();
            if ( !empty($nom))
            {
                $nom = preg_replace($no_script,"",$nom);
                $nom = preg_replace($no_sql,"",$nom);
            }
            else 
            {
                $erreurs['nom'] = true;
            }
           
            if ( !empty($prenom)) 
            {
               $prenom = preg_replace($no_script,"",$prenom);
               $prenom = preg_replace($no_sql,"",$prenom);
            }
            else 
            {
                $erreurs['prenom'] = true;
            }
           
            if ( !empty($password) ) 
            {
                $password = preg_replace($no_script,"",$password);
                $password = preg_replace($no_sql,"",$password);
                $passhash = password_hash($password,PASSWORD_DEFAULT); //Sert à hasher les mots de passes
            }
            else 
            {
                $erreurs['password'] = true;
            }
           
            if ( !empty($_POST['mail']) ) 
            {
                $mail = preg_replace($no_script,"",$mail);
                $mail = preg_replace($no_sql,"",$mail);
                if(!check_mail($_POST["mail"])){ //Sert à vérifié si l'adresse existe ou pas
                    
                }
                else{
                    $erreurs['mail'] = true;
                }
            }
            else 
            {
                $erreurs['mail'] = true;
            }
            if (empty($erreurs))
            {
                array_push($array_client,$nom); //Mettre kes données en liste
                array_push($array_client,$prenom);
                array_push($array_client,$mail);
                array_push($array_client,$passhash);
                insert_client($array_client); //Envoi les données de la liste dans la bdd
                header("Location:http://localhost/php_projet/index.php?type=connexion");
                exit();
           
            }
            else{
                require 'vue/inscription.php';
            }
        }
        else{
            require 'vue/inscription.php';
        }
    }
    //Fonction pour se connecter et gérer les erreurs
    function connexion(){
        if(!empty($_POST["connexion"])){
            $no_script = '#<script(.*?)>(.*?)</script>#is';
            $no_sql = '/(" "and" "|" "or" "|union|where|limit|group by|select|\'|hex|substr)/i'; //Gere les scripts et injections SQL
            $mail = strip_tags(htmlspecialchars(trim((string)$_POST["mail"])));
            $password = (strip_tags(htmlspecialchars(trim((string)$_POST["password"]))));
            $mail_db = check_mail($mail);
            
            if (!empty($mail)){
                $mail = preg_replace($no_script,"",$mail); 
                $mail = preg_replace($no_sql,"",$mail);
            }
            else{
                $erreurs["mail"]=true;
            }

            if (!empty($password)){
                $password = preg_replace($no_script,"",$password);
                $password = preg_replace($no_sql,"",$password);
            }
            else{
                $erreurs["password"]=true;
            }

            if($mail_db==1){
                $password_db = check_mdp($mail);
                if(password_verify($password, $password_db)){

                }
                else{
                    $erreurs["wrongpass"]=true;
                    
                }
            }
            else{
                $erreurs["nologin"]=true;
            }

            if(empty($erreurs)){
                $_SESSION["mail"]=$mail;
                $_SESSION["mdp"]=$password;  
                $array_client = insert_donnees($_SESSION["mail"]);
                $_SESSION["perm"]=$array_client["perm"];
                $_SESSION["user_id"] = $array_client["user_id"];
                header("Location:http://localhost/php_projet/index.php");
                exit();
            }
            else{
                require 'vue/connexion.php';
            }
        }
        else{
            require 'vue/connexion.php';
        }
    }
    //Fonction pour ajouter des occasions par des clients/admins
    function occasion(){
        if($_SESSION["perm"] != 2){

            require 'vue/occasion.php';
        }
        else {
            
        }
        if(!empty($_POST["ajouter"])){
            $km = strip_tags(htmlspecialchars(trim((int)$_POST["km"])));
            $chevaux = strip_tags(htmlspecialchars(trim((int)$_POST["chevaux"])));
            $local = strip_tags(htmlspecialchars(trim((string)$_POST["local"])));
            $prix = strip_tags(htmlspecialchars(trim((int)$_POST["prix"])));
            $marque = (string)$_POST["marque"];
            $annee = (string)$_POST["annee"];
            $carburant = (string)$_POST["carburant"];
            $prix = (int)$_POST["prix"];
            $no_script = '#<script(.*?)>(.*?)</script>#is';
            $no_sql = '/(" "and" "|" "or" "|union|where|limit|group by|select|\'|hex|substr)/i';
            $array_occasion=array();
            if (!empty($km)){
                $km = preg_replace($no_script,"",$km);
                $km = preg_replace($no_sql,"",$km);
                
            }
            else{
                $erreurs["km"]=true;
                echo '<script>alert("Veuillez entrer un nombre !")</script>';
            }
            if (!empty($chevaux)){
                $chevaux = preg_replace($no_script,"",$chevaux);
                $chevaux = preg_replace($no_sql,"",$chevaux);
            }
            else{
                $erreurs["chevaux"]=true;
                echo '<script>alert("Veuillez entrer un nombre !")</script>';
            }
            if (!empty($local)){
                $local = preg_replace($no_script,"",$local);
                $local = preg_replace($no_sql,"",$local);
            }
            else{
                $erreurs["local"]=true;
            }
            if (!empty($prix)){
                $prix = preg_replace($no_script,"",$prix);
                $prix = preg_replace($no_sql,"",$prix);
            }
            else{
                $erreurs["local"]=true;
                echo '<script>alert("Veuillez entrer un nombre !")</script>';
            }
            if (empty($erreurs))
            {
                array_push($array_occasion,$marque);
                array_push($array_occasion,$km);
                array_push($array_occasion,$annee);
                array_push($array_occasion,$chevaux);
                array_push($array_occasion,$carburant);
                array_push($array_occasion,$local);
                array_push($array_occasion,$prix);
                insert_occasion($array_occasion, $_SESSION["user_id"]);
                header("Location:http://localhost/php_projet/index.php?type=occasion");
                exit();
           
            }
        }
    }
    //Fonction pour voir ses données personnelles.
    function compte(){
        $list_donnee=insert_compte($_SESSION["user_id"]);
        
        require "vue/compte.php";
    }
    //Fonction pour voir les clients de la bdd et ajouter une voiture neuve
    function admin(){
        $list_client = list_client();
        $array_client = insert_donnees($_SESSION["mail"]);
        if($_SESSION["perm"] != 1){
            header("Location:http://localhost/php_projet/index.php?home"); //Si sa permission est different de 1 l'utilisateur est rediriger vers l'accueil
        }
        else {
            require 'vue/admin.php';
        }
        if(!empty($_POST["ajouter"])){
            $km = strip_tags(htmlspecialchars(trim((int)$_POST["km"])));
            $chevaux = strip_tags(htmlspecialchars(trim((int)$_POST["chevaux"])));
            $local = strip_tags(htmlspecialchars(trim((string)$_POST["local"])));
            $prix = strip_tags(htmlspecialchars(trim((int)$_POST["prix"])));
            $img = strip_tags(htmlspecialchars(trim((string)$_POST["img"])));
            $marque = (string)$_POST["marque"];
            $annee = (string)$_POST["annee"];
            $carburant = (string)$_POST["carburant"];
            $prix = (int)$_POST["prix"];
            $no_script = '#<script(.*?)>(.*?)</script>#is';
            $no_sql = '/(" "and" "|" "or" "|union|where|limit|group by|select|\'|hex|substr)/i';
            $array_neuf=array();
            if (!empty($km)){
                $km = preg_replace($no_script,"",$km);
                $km = preg_replace($no_sql,"",$km);
                
            }
            else{
                $erreurs["km"]=true;
                echo '<script>alert("Veuillez entrer un nombre !")</script>';
            }
            if (!empty($chevaux)){
                $chevaux = preg_replace($no_script,"",$chevaux);
                $chevaux = preg_replace($no_sql,"",$chevaux);
            }
            else{
                $erreurs["chevaux"]=true;
                echo '<script>alert("Veuillez entrer un nombre !")</script>';
            }
            if (!empty($local)){
                $local = preg_replace($no_script,"",$local);
                $local = preg_replace($no_sql,"",$local);
            }
            else{
                $erreurs["local"]=true;
            }
            if (!empty($prix)){
                $prix = preg_replace($no_script,"",$prix);
                $prix = preg_replace($no_sql,"",$prix);
            }
            else{
                $erreurs["local"]=true;
                echo '<script>alert("Veuillez entrer un nombre !")</script>';
            }
            if (!empty($img)){
                $img = preg_replace($no_script,"",$img);
                $img = preg_replace($no_sql,"",$img);
            }
            else{
                $erreurs["img"]=true;
            }
            if (empty($erreurs))
            {
                array_push($array_neuf,$marque);
                array_push($array_neuf,$km);
                array_push($array_neuf,$annee);
                array_push($array_neuf,$chevaux);
                array_push($array_neuf,$carburant);
                array_push($array_neuf,$local);
                array_push($array_neuf,$prix);
                array_push($array_neuf,$img);
                insert_neuf($array_neuf, $_SESSION["user_id"]);
                header("Location:http://localhost/php_projet/index.php?type=admin");
                exit();
           
            }
            
        }
    }
    //Fonction afficher la vue panier et récupérer les données et les mettre dans une liste
    function panier(){
        if(!empty($_SESSION["mail"])){
            $user_id = insert_donnees($_SESSION["mail"])["user_id"];
            $panier = recup_client($user_id);
            $array_panier=array();
            foreach($panier as $ncar){
                $array = recup_voiture($ncar["produit_id"]);
                array_push($array_panier, $array);
            }
            require 'vue/panier.php';
        }
        else {
            connexion();
        }
    }
    //Fonction pour ajouter une voiture dans le panier
    function panier_ajouter($ncar){
        $user_id = insert_donnees($_SESSION["mail"])["user_id"];
        if(!check_nprod($ncar, $user_id)){
            ajouter_panier($ncar, $user_id);
            accueil();
        }
        else{
            echo "<script>alert(\" Ce produit est déjà dans votre panier.\")</script>";
            header("Location:http://localhost/php_projet/index.php?type=panier");
        }
    }
    //Fonction pour supprimer une voiture dans le panier
    function panier_delete($ncar){
        $user_id = insert_donnees($_SESSION["mail"])["user_id"];
        supp_voiture($ncar, $user_id);
        panier();
    }
    //Fonction qui nettoie le panier en fonction de l'utilisateur
    function clear_panier(){
        $user_id = insert_donnees($_SESSION["mail"])["user_id"];
        panier_vider($user_id);
        echo "<script>alert(\" Ce produit est déjà dans votre panier.\")</script>";
        header("Location:http://localhost/php_projet/index.php?type=accueil");
    }
    //Fonction pour modifier son nom et prenom et les remplacer dans la DB
    function modifier_client($nom, $prenom){
        if(!empty($_POST['changer_info'])) {
            $nom = strip_tags(htmlspecialchars(trim((string)$_POST["nom"])));
            $prenom = strip_tags(htmlspecialchars(trim((string)$_POST["prenom"])));
            $no_script = '#<script(.*?)>(.*?)</script>#is';
            $no_sql = '/(" "and" "|" "or" "|union|where|limit|group by|select|\'|hex|substr)/i';
            if(!empty($nom)) 
            {
                $nom = preg_replace($no_script,"",$nom);
                $nom = preg_replace($no_sql,"",$nom);
            }
            else 
            {
                $erreurs['nom'] = true;
            }
           
            if ( !empty($prenom) ) 
            {
                $prenom = preg_replace($no_script,"",$prenom);
                $prenom = preg_replace($no_sql,"",$prenom);
            }
            else 
            {
                $erreurs['prenom'] = true;
            }
        }
        if(empty($erreurs)){
            modifier_client_db($nom, $prenom, $_SESSION["mail"]); //Modifier les données du clients dans la DB et renvoi vers la vue compte
            header("Location:http://localhost/php_projet/index.php?type=compte");
            exit();
        }
    }
    //Fonction pour modifier son mail et le remplacer dans la DB
    function modifier_mail($mail){
        $array_client = insert_donnees($_SESSION["mail"]);
        if (!empty($_POST['mail'])) {
            $nv_mail = strip_tags(htmlspecialchars(trim((string)$_POST["mail"])));
            $no_script = '#<script(.*?)>(.*?)</script>#is';
            $no_sql = '/(" "and" "|" "or" "|union|where|limit|group by|select|\'|hex|substr)/i';
            if (!empty($nv_mail)) 
            {
                $mail = preg_replace($no_script,"",$nv_mail);
                $mail = preg_replace($no_sql,"",$nv_mail);
                if(!check_mail($_POST["mail"])){
                    $mail = trim($_POST['mail']);
                    if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#",$mail))
                    {
                        
                    }
                    else
                    {
                        $erreurs['mail'] = true;
                    }
                }
                else{
                    $erreurs['mail'] = true;
                }

                if($nv_mail == $array_client["mail"])
                {
                    $erreurs['same_mail'] = true;
                }
                else{

                }
            }
        }
        if(empty($erreurs)){
            modifier_mail_db($mail, $_SESSION["mail"]);
            $_SESSION["mail"]=$_POST["mail"];
            header("Location:http://localhost/php_projet/index.php?type=compte"); //Modifier le mail du client dans la DB et renvoi vers la vue compte
            exit();
        }
        else {
            header("Location:http://localhost/php_projet/index.php?type=compte");
        }
    }
    //Fonction pour modifier son mot de passe et le remplacer dans la DB
    function modifier_mdp(){
        $array_client = insert_donnees($_SESSION["mail"]);
        $password_ancien = strip_tags(htmlspecialchars(trim((string)$_POST["password"])));
        $password_nouveau = strip_tags(htmlspecialchars(trim((string)$_POST["password2"])));
        $password_verif = strip_tags(htmlspecialchars(trim((string)$_POST["password_verif"])));
        $no_script = '#<script(.*?)>(.*?)</script>#is';
        $no_sql = '/(" "and" "|" "or" "|union|where|limit|group by|select|\'|hex|substr)/i';
        if(!empty($_POST['password2'])) 
            {
                $password_ancien = preg_replace($no_script,"",$password_ancien);
                $password_ancien = preg_replace($no_sql,"",$password_ancien);
                $password_nouveau = preg_replace($no_script,"",$password_nouveau);
                $password_nouveau = preg_replace($no_sql,"",$password_nouveau);
                $password_verif = preg_replace($no_script,"",$password_verif);
                $password_verif = preg_replace($no_sql,"",$password_verif);
                $passhash = password_hash($password_nouveau,PASSWORD_DEFAULT);
                $passhash_same = password_hash($password_verif,PASSWORD_DEFAULT);
                $passhash = password_hash($password_nouveau,PASSWORD_DEFAULT);
                $passhash_same = password_hash($password_verif,PASSWORD_DEFAULT);
            }
        else 
        {
            print_r("1");
            $erreurs['password2'] = true;
            $erreurs['password_verif'] = true;
        }
        if(password_verify($password_ancien,$array_client["mdp"]))
        {

        }
        else
        {
            echo'<script>alert("Ancien mot de passe incorrect")</script>';
            compte();
            $erreurs['password'] = true;
        }
        if($password_nouveau==$password_verif)
        {

        }
        else
        {
            echo'<script>alert("Erreur les nouveaux mots de passe ne sont pas identique.")</script>';
            compte();
            $erreurs['password_verif'] = true;
        }
        if(password_verify($password_nouveau,$array_client["mdp"]))
        {
            if(password_verify($password_verif,$array_client["mdp"]))
            {
                $erreurs['samePassword'] = true;
            }
            else{
            
            }
            echo'<script>alert("Nouveau mot de passe identique avec l ancien.")</script>';
            compte();
        }
        else
        {
            
        }
        if(empty($erreurs)){
            modifier_mdp_db($_POST["password2"],$_SESSION["mail"]);
            header("Location:http://localhost/php_projet/index.php?type=compte"); //Modifier le mot de passe du client dans la DB et renvoi vers la vue compte
            exit();
        }
        else {
        }
    }
?>