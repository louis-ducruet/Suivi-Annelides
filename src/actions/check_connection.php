<?php
if (!isset($_SESSION["user_connect"]) or !$_SESSION["user_connect"] or !isset($_SESSION["username"]) or !isset($_SESSION["user_role"])){
    header("location: ".$root_path."login.php");
}