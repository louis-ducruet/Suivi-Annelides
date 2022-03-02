<?php
include_once "check_security_token.php";

//connection à la base de donnée
include_once "functions.php";
include_once "../config.php";
include_once "database-connection.php";

//récupération du nouveau nom du secteur
$new_name = filter_input(INPUT_POST, "new_name");
$id = filter_input(INPUT_POST, "id");

if (checkLenString($new_name, 30) && sqlCommand("SELECT count(id) FROM espece WHERE id=:id", [":id" => $id], $conn)[0][0] == 1) {
    sqlCommand("UPDATE espece SET nom=:name WHERE id=:id", [":name" => $new_name, ":id" => $id], $conn,false);
    $_SESSION["error"] = false;//succès
    $_SESSION["error_message"] = "Nom de l'espèce modifié avec succès";
} else {
    $_SESSION["error"] = true;//erreur
    $_SESSION["error_message"] = "Impossible de modifier le nom de l'espèce, les données ne sont pas valide";
}
header("location: ../../admin/view_species.php");//retour à la page