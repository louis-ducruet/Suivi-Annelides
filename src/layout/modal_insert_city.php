<?php
function modalBodyFormAddCity($token, $action) //corps de la popup pour renommer un secteur
{
    modalTop("modalAddField");
    echo "<form action='$action' class='needs-validation' method='post'>
    <div class='modal-header'>
    <h5 class='modal-title'>Ajouter une ville</h5>
        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
    </div>
    <div class='modal-body'>
        <div class='form-floating mb-3'>
            <input type='text' placeholder='Nom du secteur' name='nom'
                   id='nom' class='form-control'
                   maxlength='128' required>
            <label for='nom'>Nom de la ville</label>
        </div>
        <div class='form-floating'>
            <input type='number' placeholder='Nom du secteur' name='departement'
                   id='departement' class='form-control' min='0' max='999'
                   required>
            <label for='departement'>N° du département</label>
        </div>
        <input type='hidden' name='token' value='$token'>
    </div>
    <div class='modal-footer'>
        <button type='button' class='btn btn-danger'
                data-bs-dismiss='modal'>Annuler
        </button>
        <button type='submit' class='btn btn-success'>Ajouter</button>
    </div>
</form>";
    modalBottom();
}