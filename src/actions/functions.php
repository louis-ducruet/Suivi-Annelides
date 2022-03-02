<?php
function checkLenString($valueCheck, $length_max, $length_min = 1) //vérifie la longueur de la chaîne de caractère
{
    return strlen($valueCheck) <= $length_max && strlen($valueCheck) >= $length_min;
}

function dataDBSafe($data) //sécurise un string pour éviter l'injection de code
{
    return htmlspecialchars($data, ENT_SUBSTITUTE, 'UTF-8');
}

function modalButton($text, $color, $target) //bouton pour afficher une popup
{
    echo "<button type = 'button' class='btn btn-$color' data-bs-toggle='modal' data-bs-target = '#$target'>$text</button>";
}
function modalTop($id) //haut de l'HTML d'une popup
{
    echo "<div class='modal fade' id='$id' data-bs-keyboard='false' tabindex='-1' data-bs-backdrop='static'>
    <div class='modal-dialog modal-dialog-centered'>
        <div class='modal-content'>";
}

function modalBottom() //bas de l'HTML d'une popup
{
    echo "</div></div></div>";
}

function modalBodyFormRenameField($sector_name, $id, $token, $action) //corps de la popup pour renommer un secteur
{
    modalTop("modalRenameField" . $id);
    echo "<form action='$action' class='needs-validation' method='post' novalidate>
        <div class='modal-header'>
            <h5 class='modal-title'>Modifier le champ : \"" . dataDBSafe($sector_name) . "\"</h5>
            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
        </div>
        <div class='modal-body'>
            <div class='form-floating'>
                <input type='text' placeholder='Nom du secteur' name='new_name'
                       id='sector_$id' class='form-control'
                       maxlength='30' required>
                <label for='sector_$id'>Nouveau nom</label>
            </div>
            <input type='hidden' name='token' value='$token'>
            <input type='hidden' name='id' value='$id'>
        </div>
        <div class='modal-footer'>
            <button type='button' class='btn btn-danger'
                    data-bs-dismiss='modal'>Annuler
            </button>
            <button type='submit' class='btn btn-success'>Modifier</button>
        </div>
    </form>";
    modalBottom();
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