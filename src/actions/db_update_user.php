<?php
include_once "check_security_token.php";

//connection à la base de donnée
include_once "functions.php";
include_once "../config.php";
include_once "database-connection.php";

$id = filter_input(INPUT_POST, "id");
$identifiant = filter_input(INPUT_POST, "identifiant");
$email = filter_input(INPUT_POST, "email");
$motDePasse = filter_input(INPUT_POST, "mot_de_passe");
$role = filter_input(INPUT_POST, "role");

if (checkLenString($identifiant, 128) && checkEmail($email,255) && checkInt((int)$role, 0, 1) && sqlCommand("SELECT count(id) FROM utilisateur WHERE (identifiant=:identifiant or email=:email)", [":identifiant" => $identifiant, ":email"=>$email], $conn)[0][0] == 1) {
    if (checkLenString($motDePasse, 255)){
        sqlCommand("UPDATE utilisateur SET identifiant=:identifiant, email=:email, mot_passe=:mot_passe, admin=:admin WHERE id=:id", ["id"=>$id,":identifiant"=>$identifiant,":email"=>$email,":mot_passe"=>$motDePasse, ":admin"=>$role], $conn,false);
    }
    else{
        sqlCommand("UPDATE utilisateur SET identifiant=:identifiant, email=:email, admin=:admin WHERE id=:id", ["id"=>$id,":identifiant"=>$identifiant,":email"=>$email,":admin"=>$role], $conn,false);
    }
    setcookie("Error[bol]", "false", time()+3600, "/");
    setcookie("Error[msg]", "Données de la ville modifié avec succès", time()+3600, "/");
} else {
    setcookie("Error[bol]", "true", time()+3600, "/");
    setcookie("Error[msg]", "Impossible de modifier les données de la ville, les données ne sont pas valide", time()+3600, "/");
}
header("location: ../../admin/view_user.php");//retour à la page