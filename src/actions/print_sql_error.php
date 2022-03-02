<?php if (isset($_SESSION["error"])) {
    //afficher le message de l'erreur / succès
    if ($_SESSION["error"]) {
        echo "<div class='alert alert-danger'>"; //si erreur
    } else {
        echo "<div class='alert alert-success'>"; //si succès
    }
    echo $_SESSION["error_message"] . '</div>';
    unset($_SESSION["error"]);
    unset($_SESSION["error_message"]);
}