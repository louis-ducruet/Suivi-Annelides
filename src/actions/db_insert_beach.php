<?php
include_once "check_security_token.php";
$root_path = "../../";
$redirect = "admin/view_beach.php";
$page_role = 1;
include "check_connection.php";

//connection à la base de donnée
include_once "../config.php";
include_once "database-connection.php";
include_once "functions.php";
//récupération du nom du secteur
$nom = filter_input(INPUT_POST, "nom");
$superficie = filter_input(INPUT_POST, "superficie");
$ville = filter_input(INPUT_POST, "ville");

if (checkLenString($nom, 128) && checkInt((int)$superficie, 1, 999) && sqlCommand("SELECT count(id) FROM ville WHERE id=:id", [":id"=>$ville], $conn)[0][0]==1) {
    sqlCommand("INSERT INTO plage (nom, superficie, ville_id) VALUES (:nom, :superficie, :ville)", [":nom" => $nom, ":superficie" => $superficie, ":ville" => $ville], $conn,false);
    setcookie("Error[bol]", "false", time()+3600, "/");
    setcookie("Error[msg]", "Plage ajouté avec succès", time()+3600, "/");
} else {
    setcookie("Error[bol]", "true", time()+3600, "/");
    setcookie("Error[msg]", "Impossible d'ajouter cette plage, les données ne sont pas valides", time()+3600, "/");
}
header("location: ../../admin/view_beach.php");//retour à la page