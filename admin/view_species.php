<?php
    $search = filter_input(INPUT_GET, 'search');
    if (isset($search)) {
        $redirect = basename(__FILE__) . "?search=$search";
    }
    $title = "Visualisation : Espèces";
    $root_path = "./../";
    include_once "../src/layout/header.php";
    include_once "../src/config.php";
    include_once "../src/actions/database-connection.php";
    include_once "../src/actions/functions.php";
    $espece = sqlCommand("SELECT * FROM espece", [], $conn);
    if (isset($search)) {
        $lines = sqlCommand("SELECT * FROM espece  WHERE nom LIKE :search ORDER BY nom", [":search" => "%" . $search . "%"], $conn);
    } else {
        $lines = sqlCommand("SELECT * FROM espece ORDER BY nom", [], $conn);
    }
?>
    <section>
        <div class="container mt-5">
            <h1>Gestion des espèces</h1>
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
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    if (count($lines) == 0) {
                        echo "<tr><th class='text-center py-3' colspan='3'>Aucune donnée</th></tr>";
                    }else{
                        $nbr_line = 1;
                        foreach ($lines as $l) {
                            ?>
                            <tr>
                                <th><?php echo $nbr_line ?></th>
                                <td> <!-- affichage du nom du secteur -->
                                    <?php echo dataDBSafe($l["nom"]) ?>
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