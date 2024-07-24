<?php
// Démarrage de la session
session_start();
// Include du fichier de config
require_once "./pdo/config.php";
try{
    $sth_plantes = $pdo->prepare("SELECT id_plante, nom
                                FROM plante
                                ORDER BY nom");
    $sth_plantes->execute();
    $result_plantes = $sth_plantes->fetchAll();
    $data_plantes = null;
    foreach ($result_plantes as $row_plantes) {
        $data_plantes[] = $row_plantes;
    }
}
catch(PDOException $e){
    echo 'Erreur : '.$e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes plantes</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>    <link rel="stylesheet" href="css/style.css"> -->
    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


    <!-- CSS -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/index.css">

</head>
<body>
    <?php include_once('header.php');
    ?>

    <div class="container-fluid min-vh-100 p-0 d-flex flex-column bg-custom-beige">
        <!-- corps de la page -->
        <div class="row flex-grow-1" id="pageBody">
            <!-- contenu de la page -->
            <div class="col h-100 p-0 mb-auto">
                <div class="row">

                <?php
                if (isset($data_plantes[0])) {
                    foreach ($data_plantes as $row_plantes) {
                        $id_plante = $row_plantes['id_plante'];
                        $nom = $row_plantes['nom']; ?>
                        <card class="bg-light my-2 mx-2 p-3 col-4 rounded-3">
                            <strong><?php echo $nom ?></strong>
                            <?php

                        ?>
                        </card>
                    <?php
                    }
                    //pas de plante a afficher
                } else { ?>
                        
                    <card class="bg-light my-2 mx-auto">Aucune plante ne correspond aux critères</card>
                <?php
                }
                ?>
            </div>
        </div>
    </div>





    <?php include_once('footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>