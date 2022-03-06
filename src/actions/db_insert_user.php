<?php
include_once "check_security_token.php";
$root_path = "../../";
$redirect = "admin/view_user.php";
include "check_connection.php";

//connection à la base de donnée
include_once "../config.php";
include_once "database-connection.php";
include_once "functions.php";
//récupération du nom du secteur
$identifiant = filter_input(INPUT_POST, "identifiant");
$email = filter_input(INPUT_POST, "email");
$motDePasse = filter_input(INPUT_POST, "mot_de_passe");
$role = filter_input(INPUT_POST, "role");

if (checkLenString($identifiant, 128) && checkLenString($motDePasse, 255) && checkEmail($email,255) && checkInt((int)$role, 0, 1) && sqlCommand("SELECT count(id) FROM utilisateur WHERE (identifiant=:identifiant or email=:email)", [":identifiant" => $identifiant, ":email"=>$email], $conn)[0][0] == 0) {
    sqlCommand("INSERT INTO utilisateur (identifiant, email, mot_passe, admin) VALUES (:identifiant, :email, :mot_passe, :admin)", [":identifiant"=>$identifiant,":email"=>$email,":mot_passe"=>$motDePasse, ":admin"=>$role], $conn,false);
    setcookie("Error[bol]", "false", time()+3600, "/");
    setcookie("Error[msg]", "Utilisateur ajouté avec succès", time()+3600, "/");
} else {
    setcookie("Error[bol]", "true", time()+3600);
    setcookie("Error[msg]", "Impossible d'ajouter cet utilisateur, les données ne sont pas valides", time()+3600, "/");
}
header("location: ../../admin/view_user.php");//retour à la page