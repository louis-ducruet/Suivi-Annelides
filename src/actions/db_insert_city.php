<?php
include_once "check_security_token.php";

//connection à la base de donnée
include_once "../config.php";
include_once "database-connection.php";
include_once "functions.php";
//récupération du nom du secteur
$nom = filter_input(INPUT_POST, "nom");
$departement = filter_input(INPUT_POST, "departement");

if (checkLenString($nom, 128) && checkInt((int)$departement, 1, 999)) {
    sqlCommand("INSERT INTO ville (nom, departement) VALUES (:nom, :departement)", [":nom" => $nom, ":departement" => $departement], $conn,false);
    $_SESSION["error"] = false; //succès
    $_SESSION["error_message"] = "Ville ajouté avec succès";
} else {
    $_SESSION["error"] = true; //erreur
    $_SESSION["error_message"] = "$nom : $departement Invalide";
}
header("location: ../../admin/view_city.php");//retour à la page