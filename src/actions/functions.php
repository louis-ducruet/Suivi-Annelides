<?php
function dataDBSafe($data) //sécurise un string pour éviter l'injection de code
{
    return htmlspecialchars($data, ENT_SUBSTITUTE, 'UTF-8');
}
function searchInput($search, $link1, $link2, $inputIdHidden = null) //HTML pour la barre de recherche
{
    echo "<form action='$link1' method='get'>
        <div class='input-group mb-3'>
            <div class='form-floating' style='width: 50%;'>
                <input type='text' class='form-control' placeholder='recherche un formulaire' name='search' id='search'>
                <label for='search'>Rechercher un élément</label>";
    if ($inputIdHidden != null) {
        echo "<input type='hidden' name='id' value='$inputIdHidden'>";
    }
    echo "</div><button class='btn btn-outline-secondary fs-5' type='submit'><span class='fa-solid fa-magnifying-glass'></span></button>";
    if (isset($search) and $search != "") {
        echo "<a href='$link2' class='btn btn-outline-danger text-center fs-4'><span class='fa-solid fa-circle-xmark'></span></a>";
    }
    echo "</div></form>";
}