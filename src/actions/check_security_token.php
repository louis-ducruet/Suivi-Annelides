<?php
session_start();
$token = filter_input(INPUT_POST, "token");
if (isset($_SESSION["token"]) and $_SESSION["token"] != $token) { //vérifie le token de sécurité
    session_destroy();
    die("Erreur interne : Validation du formulaire impossible");
}