<?php
if (!isset($_SESSION["user_connect"]) or !$_SESSION["user_connect"] or !isset($_SESSION["username"]) or !isset($_SESSION["user_role"])){
    if (isset($redirect)){
        setcookie("redirect", $redirect, time()+3600, "/");
    }
    header("location: ".$root_path."login.php");
}
if (isset($page_role)){
    if ($page_role == 1 and $_SESSION["user_role"] != 1){
        die("
        <div class='container mt-5'>
            <h1>Vous n'avez pas le droit d'accéder à cette page !</h1>
            <a href='$root_path'>Retrour sur la page d'accueil</a>
        </div>
        ");
    }
}