<?php
function modalBodyFormAddBeach($token, $action, $conn) //corps de la popup pour renommer un secteur
{
    modalTop("modalAddField");
    $villes = sqlCommand("SELECT * from ville", [], $conn);

    echo "<form action='$action' class='needs-validation' method='post'>
    <div class='modal-header'>
    <h5 class='modal-title'>Ajouter une plage</h5>
        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
    </div>
    <div class='modal-body'>
        <div class='form-floating mb-3'>
            <input type='text' placeholder='Nom de la plage' name='nom'
                   id='nom' class='form-control'
                   maxlength='128' required>
            <label for='nom'>Nom de la plage</label>
        </div>
        <div class='form-floating mb-3'>
            <input type='number' placeholder='superficie' name='superficie'
                   id='superficie' class='form-control' min='0' max='999' step='0.1'
                   required>
            <label for='superficie'>Superficie (km²)</label>
        </div>
        <div>
            <select id='ville' class='form-select' name='ville' required>
                <option value='' disabled selected>Ville de la plage</option>
                ";
    foreach ($villes as $ville){
        echo "<option value='".$ville['id']."'>".$ville['nom']."</option>";
    }
    echo "</select>
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