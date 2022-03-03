<?php
function modalBodyFormUpdate($line, $token, $action) //corps de la popup pour renommer un secteur
{
    modalTop("modalUpdateField" . $line['id']);
    echo "<form action='$action' class='needs-validation' method='post'>
    <div class='modal-header'>
        <h5 class='modal-title'>Modifier la ville : \"" . dataDBSafe($line['nom']) . "\"</h5>
        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
    </div>
    <div class='modal-body'>
        <div class='form-floating mb-3'>
            <input type='text' placeholder='Nom du secteur' name='nom'
                   id='nom' class='form-control'
                   maxlength='128' required value='".dataDBSafe($line['nom'])."'>
            <label for='nom'>Nom de la ville</label>
        </div>
        <div class='form-floating'>
            <input type='number' placeholder='Nom du secteur' name='departement'
                   id='departement' class='form-control' min='0' max='999'
                   required value='".dataDBSafe($line['departement'])."'>
            <label for='departement'>N° du département</label>
        </div>
        <input type='hidden' name='token' value='$token'>
        <input type='hidden' name='id' value='".$line['id']."'>
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