<?php
include_once "check_security_token.php";
include_once "../config.php";
include_once "database-connection.php";

$identifiant = filter_input(INPUT_POST,'identifiant');
$motDePasse = filter_input(INPUT_POST, 'mot_de_passe');
$utilisateur = sqlCommand("SELECT identifiant, admin FROM utilisateur WHERE (identifiant=:identifiant OR email=:identifiant) AND mot_passe=:mot_passe", [":identifiant"=>$identifiant, ":mot_passe"=>$motDePasse],$conn);
if (count($utilisateur)==1){
    $_SESSION["username"] = $utilisateur[0]["identifiant"];
    $_SESSION["user_role"] = $utilisateur[0]["admin"];
    $_SESSION["user_connect"] = true;
    if (isset($_COOKIE["redirect"])){
        setcookie("redirect", "", time()-3600, "/");
        var_dump($_COOKIE["redirect"]);
        header("location: ../../".$_COOKIE["redirect"]);
    }else{
        header("location: ../../admin/");
    }
}
else {
    setcookie("Error[bol]", "true", time()+3600, "/");
    setcookie("Error[msg]", "Identifiant ou mot de passe incorrect", time()+3600, "/");
    header("location: ../../login.php");
}