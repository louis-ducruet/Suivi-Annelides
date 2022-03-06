<?php
include_once "check_security_token.php";

//connection à la base de donnée
include_once "functions.php";
include_once "../config.php";
include_once "database-connection.php";

//récupération du nouveau nom du secteur
$nom = filter_input(INPUT_POST, "nom");
$departement = filter_input(INPUT_POST, "departement");
$id = filter_input(INPUT_POST, "id");

if (checkLenString($nom, 128) && checkInt((int)$departement, 1, 999) && sqlCommand("SELECT count(id) FROM ville WHERE id=:id", [":id" => $id], $conn)[0][0] == 1) {
    sqlCommand("UPDATE ville SET nom=:name, departement=:departement WHERE id=:id", [":name" => $nom, ":id" => $id, ":departement"=>$departement], $conn,false);
    setcookie("Error[bol]", "false", time()+3600, "/");
    setcookie("Error[msg]", "Données de la ville modifié avec succès", time()+3600, "/");
} else {
    setcookie("Error[bol]", "true", time()+3600, "/");
    setcookie("Error[msg]", "Impossible de modifier les données de la ville, les données ne sont pas valide", time()+3600, "/");
}
header("location: ../../admin/view_city.php");//retour à la page