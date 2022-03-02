<?php
    $search = filter_input(INPUT_GET, 'search');
    if (isset($search)) {
        $redirect = basename(__FILE__) . "?search=$search";
    }
    $title = "Visualisation : Espèces";
    $root_path = "./../";
    include_once "../src/layout/header.php";
    include_once "../src/actions/generate_security_token.php";
    include_once "../src/config.php";
    include_once "../src/actions/database-connection.php";
    include_once "../src/actions/functions.php";
    if (isset($search)) {
        $lines = sqlCommand("SELECT * FROM espece  WHERE nom LIKE :search ORDER BY nom", [":search" => "%" . $search . "%"], $conn);
    } else {
        $lines = sqlCommand("SELECT * FROM espece ORDER BY nom", [], $conn);
    }
?>
    <section>
        <div class="container mt-5">
            <h1>Gestion des espèces</h1>
            <?php include "../src/actions/print_sql_error.php"?>
            <div class="row">
                <div class="col-6"> <!-- création d'un nouveau secteur dans la base de donnée-->
                    <h2 class="mt-2">Rechercher une espèce</h2>
                    <?php searchInput($search, "view_species.php", "view_species.php"); ?>
                </div>
                <div class="col-6"> <!-- création d'un nouveau secteur dans la base de donnée-->
                    <h2 class="mt-2">Ajouter une espèce</h2>
                    <form action="../src/actions/db_insert_species.php" method="POST" class="mt-3 needs-validation" novalidate>
                        <div class="input-group mb-3">
                            <div class="form-floating" style="width: 50%;">
                                <input type="text" name="name" placeholder="Secteur" id="add_sector" class="form-control"
                                       maxlength="255" required>
                                <label for="add_sector">Nom de l'espèce</label>
                            </div>
                            <input type="hidden" name="token" value="<?= $token ?>">
                            <button type="submit" class="btn btn-success"><span class="fa-regular fa-square-plus"></span></button>
                        </div>
                    </form>
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
                                    <div class="btn-group">
                                        <?php
                                        modalButton("<span class='fas fa-edit'></span>", "success", "modalRenameField" . $l['id']);
                                        ?>
                                    </div>
                                    <?php
                                    modalBodyFormRenameField($l["nom"],$l["id"],$token, "../src/actions/db_update_species.php");
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