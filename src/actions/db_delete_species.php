<?php
include_once "check_security_token.php";
$root_path = "../../";
include "check_connection.php";

//connection à la base de donnée
include_once "../config.php";
include_once "database-connection.php";

$id = filter_input(INPUT_POST, "id");

if (sqlCommand("SELECT count(id) FROM espece WHERE id=:id", [":id" => $id], $conn)[0][0] == 1) { //vérification si l'id du secteur existe
    sqlCommand("DELETE FROM espece WHERE id=:id", [":id" => $id], $conn, false);
    setcookie("Error[bol]", "false", time()+3600, "/");
    setcookie("Error[msg]", "Secteur supprimé avec succès", time()+3600, "/");
} else {
    setcookie("Error[bol]", "true", time()+3600, "/");
    setcookie("Error[msg]", "Impossible de supprimer ce secteur, les données ne sont pas valides", time()+3600, "/");
}
header("location: ../../admin/view_species.php");//retour à la page