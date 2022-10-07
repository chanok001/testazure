<?php 

function getBdd()
{
    try{
        $bdd = new PDO('mysql:host=localhost;dbname=auto_heh_db;charset=utf8',
        'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
        return $bdd;
    }
    
    catch(Exeption $e){
        print_r("Erreur :".$e);
    }
}
//fonction pour voir si le mail n'est pas deja dans la DB
function check_mail($mail){
    $bdd = getBdd();
    $req = $bdd->prepare("SELECT mail FROM client WHERE mail=?");
    $req->bindParam(1,$mail);
    $req->execute();
    $bool = $req->fetch();
    if(!empty($bool)){
        return true;
    }
    else if(empty($bool)){
        return false;
    }
    else{
        return null;
    }
}
//fonction pour ajouter les données du client dans la DB
function insert_client($array){
    $bdd = getBdd();
    $sql = "INSERT INTO `client`(`nom`,`prenom`,`mail`,`mdp`,`perm`) VALUES (?,?,?,?,0)";
    $query = $bdd->prepare($sql);
    if(!$query->execute($array)){
        die("Une erreur est survenue");
    }
    $query->closeCursor();
}
//fonction pour ajouter des voiture occasion dans la DB
function insert_occasion($array, $id){
    $bdd = getBdd();
    $t = $id;
    $sql = "INSERT INTO `occasion`(`user_id`,`marque`,`km`,`annee`,`chevaux`,`carburant`,`localite`,`prix`,`etat` ) VALUES ($t,?,?,?,?,?,?,?,'occasion')";
    $query = $bdd->prepare($sql);
    if(!$query->execute($array)){
        die("Une erreur est survenue");
    }
    $query->closeCursor();
}
//fonction pour ajouter des voiture neuve dans la DB
function insert_neuf($array, $id){
    $bdd = getBdd();
    $t = $id;
    $sql = "INSERT INTO `occasion`(`user_id`,`marque`,`km`,`annee`,`chevaux`,`carburant`,`localite`,`prix`,`etat`,`img`) VALUES ($t,?,?,?,?,?,?,?,'neuf',?)";
    $query = $bdd->prepare($sql);
    if(!$query->execute($array)){
        die("Une erreur est survenue");
    }
    $query->closeCursor();
}
//fonction qui permet de récuperer le mot de passe
function check_mdp($mail){
    $bdd = getBdd();
    $req = $bdd->prepare("SELECT mdp FROM client WHERE mail=?");
    $req->bindParam(1,$mail);
    $req->execute();
    $tab = $req->fetch();
    return $tab["mdp"];
}
//fonction qui récuperer les données d'un client en fonction de son mail
function insert_donnees($mail){
    $bdd = getBdd();
    $req = $bdd->prepare("SELECT * FROM client WHERE mail = ?");
    $req->bindParam(1,$mail);
    $req->execute();
    return $req->fetch();
}
//fonction pour selectionner un compte en fonction de son ID
function insert_compte($id){
    $bdd = getBdd();
    $req = $bdd->prepare("SELECT * FROM client WHERE user_id=?");
    $req->bindParam(1, $id);
    $req->execute();
    return $req->fetchAll();
}
//fonction pour lister tout les clients de la DB
function list_client(){
    $bdd = getBDD();
    $req = $bdd->prepare("SELECT * FROM client");
    $req->execute();
    return $req->fetchAll();
}
//fonction pour lister toutes les voitures de la DB
function list_voiture(){
    $bdd = getBDD();
    $req = $bdd->prepare("SELECT * FROM occasion");
    $req->execute();
    return $req->fetchAll();
}
//fonction pour récuperer la liste du panier en fonction de l'ID
function list_panier($ncli){
    $bdd = getBDD();
    $req = $bdd->prepare("SELECT * FROM commande WHERE user_id=?");
    $req->bindParam(1, $ncli);
    $req->execute();
    return $req->fetchAll();
}
//fonction pour ajouter une voiture dans le panier
function ajouter_panier($ncar, $user_id){
    $bdd = getBdd();
    $req = $bdd->prepare("INSERT INTO commande(produit_id, user_id) VALUES(?,?)");
    $req->bindParam(1,$ncar);
    $req->bindParam(2,$user_id);
    $req->execute();
}
//fonction pour voir si le produit est déjà dans le panier du client
function check_nprod($nprod, $ncli){
    $bdd = getBdd();
    $req = $bdd->prepare("SELECT user_id FROM commande WHERE user_id=? AND produit_id=?");
    $req->bindParam(1,$ncli);
    $req->bindParam(2,$nprod);
    $req->execute();
    $bool = $req->fetch();
    if(!empty($bool)){
        return true;
    }
    else if(empty($bool)){
        return false;
    }
    else{
        return null;
    }
}
//fonction pour récuperer un produit en fonction du client dans la table commande
function recup_client($user_id){
    $bdd = getBdd();
    $req = $bdd->prepare("SELECT produit_id FROM commande WHERE user_id=?");
    $req->bindParam(1,$user_id);
    $req->execute();
    return $req->fetchAll();
}
//fonction pour récupérer les données dans la table occasion en fonction du user_id
function recup_voiture($ncar){
    $bdd = getBdd();
    $req = $bdd->prepare("SELECT * FROM occasion WHERE occasion_id=?");
    $req->bindParam(1,$ncar);
    $req->execute();
    return $req->fetch();
}
//fonction pour supprimer une voiture du panier
function supp_voiture($ncar, $user_id){
    $bdd = getBdd();
    $req = $bdd->prepare("DELETE FROM commande WHERE produit_id=? AND user_id=?");
    $req->bindParam(1,$ncar);
    $req->bindParam(2,$user_id);
    $req->execute();
}
//fonction pour clear le panier apres avoir acheter
function panier_vider($user_id){
    $bdd = getBdd();
    $req = $bdd->prepare("DELETE FROM commande WHERE user_id=?");
    $req->bindParam(1,$user_id);
    $req->execute();
}
//fonction pour mettre a jour le nom et le prenom du client
function modifier_client_db($nom, $prenom, $mail){
    $bdd = getBDD();
    $req = $bdd->prepare("UPDATE client SET nom=?,prenom=? WHERE mail=?");
    $req->bindParam(1, $nom);
    $req->bindParam(2, $prenom);
    $req->bindParam(3, $mail);
    $req->execute();
}
//fonction pour mettre a jour le mail
function modifier_mail_db($nv_mail, $mail){
    $bdd = getBDD();
    $req = $bdd->prepare("UPDATE client SET mail=? WHERE mail=?");
    $req->bindParam(1, $nv_mail);
    $req->bindParam(2, $mail);
    $req->execute();
}
//fonction pour mettre a jour le mot de passe de l'utilisateur 
function modifier_mdp_db($mdp, $mail){
    $bdd = getBdd();
    $req = $bdd->prepare("UPDATE client set mdp=? WHERE mail=?");
    $req->bindParam(1,password_hash($mdp,PASSWORD_DEFAULT));
    $req->bindParam(2,$mail);
    $req->execute();
}

?>