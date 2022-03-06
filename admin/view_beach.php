<?php
$search = filter_input(INPUT_GET, 'search');
if (isset($search)) {
    $redirect = basename(__FILE__) . "?search=$search";
}
$title = "Visualisation : Plages";
$root_path = "./../";
$redirect = "admin/view_beach.php";
$page_role = 1;
include_once "../src/layout/header.php";
include_once "../src/actions/generate_security_token.php";
include "../src/actions/check_connection.php";
include_once "../src/config.php";
include_once "../src/actions/database-connection.php";
include_once "../src/actions/functions.php";
include_once "../src/layout/modal_insert_beach.php";

if (isset($search)) {
    $lines = sqlCommand("SELECT plage.id, plage.nom, plage.superficie, ville.nom AS ville FROM plage JOIN ville ON plage.ville_id = ville.id WHERE plage.nom LIKE :search ORDER BY plage.nom", [":search" => "%" . $search . "%"], $conn);
} else {
    $lines = sqlCommand("SELECT plage.id, plage.nom, plage.superficie, ville.nom AS ville FROM plage JOIN ville ON plage.ville_id = ville.id ORDER BY plage.nom", [], $conn);
}
?>
    <section>
        <div class="container mt-5">
            <h1>Gestion des plages</h1>
            <?php include "../src/actions/print_sql_error.php"?>
            <div class="row">
                <div class="col-6"> <!-- création d'un nouveau secteur dans la base de donnée-->
                    <h2 class="mt-2">Rechercher une plage</h2>
                    <?php searchInput($search, "view_beach.php", "view_beach.php"); ?>
                </div>
                <div class="col-6"> <!-- création d'un nouveau secteur dans la base de donnée-->
                    <h2 class="mt-2">Ajouter une plage</h2>
                    <?php modalAddFormCall("<span class='fa-regular fa-square-plus'></span> Ajouter une plage", "success", "modalAddField"); ?>
                    <?php modalBodyFormAddBeach($token, "../src/actions/db_insert_beach.php", $conn); ?>
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
                    <th>Nom</th>
                    <th>Superficie</th>
                    <th>Ville</th>
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
                                <?php echo dataDBSafe($l["nom"]) ?>
                            </td>
                            <td> <!-- affichage du nom du secteur -->
                                <?php echo dataDBSafe($l["superficie"])." km²" ?>
                            </td>
                            <td> <!-- affichage du nom du secteur -->
                                <?php echo dataDBSafe($l["ville"]) ?>
                            </td>
                            <td> <!-- option applicable au secteur enregistré dans la base de donnée-->
                                Bientôt disponible
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