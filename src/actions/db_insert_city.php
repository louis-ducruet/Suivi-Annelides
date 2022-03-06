<?php
include_once "check_security_token.php";
$root_path = "../../";
include "check_connection.php";

//connection à la base de donnée
include_once "../config.php";
include_once "database-connection.php";
include_once "functions.php";
//récupération du nom du secteur
$nom = filter_input(INPUT_POST, "nom");
$departement = filter_input(INPUT_POST, "departement");

if (checkLenString($nom, 128) && checkInt((int)$departement, 1, 999)) {
    sqlCommand("INSERT INTO ville (nom, departement) VALUES (:nom, :departement)", [":nom" => $nom, ":departement" => $departement], $conn,false);
    setcookie("Error[bol]", "false", time()+3600, "/");
    setcookie("Error[msg]", "Ville ajouté avec succès", time()+3600, "/");
} else {
    setcookie("Error[bol]", "true", time()+3600, "/");
    setcookie("Error[msg]", "Impossible d'ajouter cette ville, les données ne sont pas valides", time()+3600, "/");
}
header("location: ../../admin/view_city.php");//retour à la page