<?php
function modalBodyFormRenameField($sector_name, $id, $token, $action) //corps de la popup pour renommer un secteur
{
modalTop("modalRenameField" . $id);
echo "<form action='$action' class='needs-validation' method='post'>
    <div class='modal-header'>
        <h5 class='modal-title'>Modifier l'espèce : \"" . dataDBSafe($sector_name) . "\"</h5>
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