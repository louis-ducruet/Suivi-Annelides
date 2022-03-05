<?php
function modalBodyFormAddCity($token, $action) //corps de la popup pour renommer un secteur
{
    modalTop("modalAddField");
    echo "<form action='$action' class='needs-validation' method='post'>
    <div class='modal-header'>
    <h5 class='modal-title'>Ajouter un utilisateur</h5>
        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
    </div>
    <div class='modal-body'>
        <div class='form-floating mb-3'>
            <input type='text' placeholder=\"Nom de l'utilisateur\" name='identifiant'
                   id='identifiant' class='form-control'
                   maxlength='128' required>
            <label for='identifiant'>Identifiant de l'utilisateur</label>
        </div>
        <div class='form-floating mb-3'>
            <input type='email' placeholder=\"Email de l'utilisateur\" name='email'
                   id='email' class='form-control'
                   maxlength='255' required>
            <label for='email'>E-mail de l'utilisateur</label>
        </div>
        <div class='form-floating mb-3'>
            <input type='password' placeholder=\"Mot de passe de l'utilisateur\" name='mot_de_passe'
                   id='mot_de_passe' class='form-control'
                   maxlength='255' required>
            <label for='mot_de_passe'>Mot de passe de l'utilisateur</label>
        </div>
        <div>
            <select id='role' class='form-select' name='role' required>
                <option value='' disabled selected>Le role de l'utilisateur</option>
                <option value='0'>Utilisateur</option>
                <option value='1'>Administrateur</option>
            </select>
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