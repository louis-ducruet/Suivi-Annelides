<?php
include_once "check_security_token.php";
$root_path = "../../";
$redirect = "admin/view_species.php";
$page_role = 1;
include "check_connection.php";

//connection à la base de donnée
include_once "../config.php";
include_once "database-connection.php";
include_once "functions.php";
//récupération du nom du secteur
$name = filter_input(INPUT_POST, "name");

if (checkLenString($name, 255)) {
    sqlCommand("INSERT INTO espece (nom) VALUES (:name)", [":name" => $name], $conn,false);
    setcookie("Error[bol]", "false", time()+3600, "/");
    setcookie("Error[msg]", "Espèce ajouté avec succès", time()+3600, "/");
} else {
    setcookie("Error[bol]", "true", time()+3600, "/");
    setcookie("Error[msg]", "Impossible d'ajouter cette espèce, les données ne sont pas valides", time()+3600, "/");
}
header("location: ../../admin/view_species.php");//retour à la page