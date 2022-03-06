<?php
include_once "check_security_token.php";
include_once "../config.php";
include_once "database-connection.php";

$identifiant = filter_input(INPUT_POST,'identifiant');
$motDePasse = filter_input(INPUT_POST, 'mot_de_passe');
$utilisateur = sqlCommand("SELECT identifiant, admin FROM utilisateur WHERE (identifiant=:identifiant OR email=:identifiant) AND mot_passe=:mot_passe", [":identifiant"=>$identifiant, ":mot_passe"=>$motDePasse],$conn);
if (count($utilisateur)==1){
    $_SESSION["username"] = $utilisateur[0]["identifiant"];
    $_SESSION["user_role"] = $utilisateur[0]["role"];
    $_SESSION["user_connect"] = true;
    header("location: ../../admin/");
}
else {
    $_SESSION["error_message_connection"] = "Identifiant ou mot de passe incorrect";
    $_SESSION["user_connect"] = false;
    header("location: ../../login.php");
}