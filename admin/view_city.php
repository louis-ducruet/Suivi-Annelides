<?php
$search = filter_input(INPUT_GET, 'search');
if (isset($search)) {
    $redirect = basename(__FILE__) . "?search=$search";
}
$title = "Visualisation : Villes";
$root_path = "./../";
include_once "../src/layout/header.php";
include_once "../src/config.php";
include_once "../src/actions/database-connection.php";
include_once "../src/actions/functions.php";
if (isset($search)) {
    $lines = sqlCommand("SELECT * FROM ville  WHERE nom LIKE :search ORDER BY nom", [":search" => "%" . $search . "%"], $conn);
} else {
    $lines = sqlCommand("SELECT * FROM ville ORDER BY nom", [], $conn);
}
?>
    <section>
        <div class="container mt-5">
            <h1>Gestion des villes</h1>
            <?php include "../src/actions/print_sql_error.php"?>
            <div class="row">
                <div class="col-6"> <!-- création d'un nouveau secteur dans la base de donnée-->
                    <h2 class="mt-2">Rechercher une ville</h2>
                    <?php searchInput($search, "view_city.php", "view_city.php"); ?>
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
                    <th>Département</th>
                    <th>Actions</th>
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
                                <?php echo dataDBSafe($l["departement"]) ?>
                            </td>
                            <td> <!-- option applicable au secteur enregistré dans la base de donnée-->
                                <p>Bientôt disponible</p>
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