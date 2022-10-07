<?php
    session_start();
    require "controleur/controleur.php";
    try{
        if(!empty($_GET["type"])){
            if($_GET["type"]=="accueil"){
                accueil();
            }
            else if($_GET["type"]=="inscription"){
                inscription();
            }
            else if($_GET["type"]=="connexion"){
                connexion();
            }
            else if($_GET["type"]=="panier"){
                if(!empty($_GET["action"]) && $_GET["action"] == "add"){
                    panier_ajouter($_GET["nprod"]);
                }
                else if(!empty($_GET["action"]) && $_GET["action"] == "delete"){
                    panier_delete($_GET["nprod"]);
                }
                else if(!empty($_GET["action"]) && $_GET["action"] == "clear"){
                    clear_panier();
                }
                else {
                    panier();
                }
            }
            else if($_GET["type"]=="occasion"){
                occasion();
            }
            else if($_GET["type"]=="admin"){
                admin();
            }
            else if($_GET["type"]=="compte"){
                if(!empty($_GET["action"]) && $_GET["action"]=="changer_info"){
                    modifier_client($_POST["nom"], $_POST["nom"]);
                }
                else if(!empty($_GET["action"]) && $_GET["action"]=="changer_mail"){
                    modifier_mail($_POST["mail"]);
                }
                else if(!empty($_GET["action"]) && $_GET["action"]=="changer_mdp"){
                    modifier_mdp();
                }
                else {
                    compte();
                }
            }
            else if($_GET["type"]=="deconnexion"){
                session_destroy();
                $_SESSION["mail"]="";
                $_SESSION["perm"]="";
                accueil();
            }
        }
        else{
            accueil();
        }
    }
    catch(Exception $e){
        print_r("Erreur :".$e);
    }
?>