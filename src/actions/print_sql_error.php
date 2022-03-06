<?php if (isset($_COOKIE["Error"])) {
    //afficher le message de l'erreur / succès
    if ($_COOKIE["Error"]["bol"]=="true") {
        echo "<div class='alert alert-danger'>"; //si erreur
    } else {
        echo "<div class='alert alert-success'>"; //si succès
    }
    echo $_COOKIE["Error"]["msg"] . '</div>';
    setcookie("Error[bol]", "", time()-3600, "/");
    setcookie("Error[msg]", "", time()-3600, "/");
}