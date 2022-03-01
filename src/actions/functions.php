<?php
function dataDBSafe($data) //sécurise un string pour éviter l'injection de code
{
    return htmlspecialchars($data, ENT_SUBSTITUTE, 'UTF-8');
}