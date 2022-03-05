<?php
$search = filter_input(INPUT_GET, 'search');
if (isset($search)) {
    $redirect = basename(__FILE__) . "?search=$search";
}
$title = "Visualisation : Utilisateurs";
$root_path = "./../";
include_once "../src/layout/header.php";
include_once "../src/actions/generate_security_token.php";
include_once "../src/config.php";
include_once "../src/actions/database-connection.php";
include_once "../src/actions/functions.php";
include_once "../src/layout/modal_insert_user.php";
include_once "../src/layout/modal_update_user.php";
if (isset($search)) {
    $lines = sqlCommand("SELECT id ,identifiant, email, admin FROM utilisateur WHERE identifiant LIKE :search ORDER BY identifiant", [":search" => "%" . $search . "%"], $conn);
} else {
    $lines = sqlCommand("SELECT id ,identifiant, email, admin FROM utilisateur ORDER BY identifiant", [], $conn);
}
?>
    <section>
        <div class="container mt-5">
            <h1>Gestion des utilisateurs</h1>
            <?php include "../src/actions/print_sql_error.php"?>
            <div class="row">
                <div class="col-6"> <!-- création d'un nouveau secteur dans la base de donnée-->
                    <h2 class="mt-2">Rechercher un utilisateur</h2>
                    <?php searchInput($search, "view_user.php", "view_user.php"); ?>
                </div>
                <div class="col-6"> <!-- création d'un nouveau secteur dans la base de donnée-->
                    <h2 class="mt-2">Ajouter un utilisateur</h2>
                    <?php modalAddFormCall("<span class='fa-regular fa-square-plus'></span> Ajouter un utilisateur", "success", "modalAddField"); ?>
                    <?php modalBodyFormAddCity($token, "../src/actions/db_insert_user.php"); ?>
                </div>
            </div>
            <hr>
            <?php
            if (isset($search) and $search != "") {
                echo "<h2>Résultat de la recherche '" . dataDBSafe($search) . "'</h2>";
            }
            ?>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Identifiant</th>
                    <th>E-mail</th>
                    <th>Role</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (count($lines) == 0) {
                    echo "<tr><th class='text-center py-3' colspan='4'>Aucune donnée</th></tr>";
                }else{
                    $nbr_line = 1;
                    foreach ($lines as $l) {
                        ?>
                        <tr>
                            <th><?php echo $nbr_line ?></th>
                            <td> <!-- affichage du nom du secteur -->
                                <?php echo dataDBSafe($l["identifiant"]) ?>
                            </td>
                            <td> <!-- affichage du nom du secteur -->
                                <?php echo dataDBSafe($l["email"]) ?>
                            </td>
                            <td> <!-- affichage du nom du secteur -->
                                <?php echo (dataDBSafe($l["admin"]==1))?"Administrateur":"Utilisateur" ?>
                            </td>
                            <td> <!-- option applicable au secteur enregistré dans la base de donnée-->
                                <div class="btn-group">
                                    <?php
                                    modalButton("<span class='fas fa-edit'></span>", "success", "modalUpdateField" . $l['id']);
                                    modalButton("<span class='fas fa-trash'></span>", "danger", "modalDeleteField" . $l['id']);
                                    ?>
                                </div>
                                <?php
                                modalBodyFormUpdate($l,$token, "../src/actions/db_update_user.php");
                                modalBodyFormDeleteField($l['identifiant'], $l['id'], $token, "../src/actions/db_delete_user.php");
                                ?>
                            </td>
                        </tr>
                        <?php
                        $nbr_line++;
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </section>
<?php
include_once "../src/layout/footer.php";