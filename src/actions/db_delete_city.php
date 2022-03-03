<?php
include_once "check_security_token.php";

//connection à la base de donnée
include_once "../config.php";
include_once "database-connection.php";

$id = filter_input(INPUT_POST, "id");

if (sqlCommand("SELECT count(id) FROM ville WHERE id=:id", [":id" => $id], $conn)[0][0] == 1) { //vérification si l'id du secteur existe
    sqlCommand("DELETE FROM ville WHERE id=:id", [":id" => $id], $conn, false);
    $_SESSION["error"] = false; //succès
    $_SESSION["error_message"] = "Ville supprimé avec succès";
} else {
    $_SESSION["error"] = true; //erreur
    $_SESSION["error_message"] = "Impossible de supprimer la ville, les données ne sont pas valides";
}
header("location: ../../admin/view_city.php");//retour à la page