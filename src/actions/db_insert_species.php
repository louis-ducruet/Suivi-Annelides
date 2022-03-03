<?php
include_once "check_security_token.php";

//connection à la base de donnée
include_once "../config.php";
include_once "database-connection.php";
include_once "functions.php";
//récupération du nom du secteur
$name = filter_input(INPUT_POST, "name");

if (checkLenString($name, 255)) {
    sqlCommand("INSERT INTO espece (nom) VALUES (:name)", [":name" => $name], $conn,false);
    $_SESSION["error"] = false; //succès
    $_SESSION["error_message"] = "Espèce ajouté avec succès";
} else {
    $_SESSION["error"] = true; //erreur
    $_SESSION["error_message"] = "Impossible d'ajouter cette espèce, les données ne sont pas valides";
}
header("location: ../../admin/view_species.php");//retour à la page