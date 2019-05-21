<?php
/*
Titre : Contrôleur de création d'une annonce
Date : Mardi, 15 mai 2019
Auteur : Romain Peretti
Version : 1.0
Description : Cette page inclut la vue.
*/

require_once '../inc/inc.all.php';

if (isset($_POST['send'])) {
    for ($i = 1; $i <= count($_FILES['pictures']['name']); $i++) {

        $index = $i - 1;

        // Mauvaise extension
        if (in_array($_FILES['pictures']['type'][$index], EXTENSION_AUTHORIZED) || $_FILES['pictures']['error'][$index] == NO_DOWNLOADED_PICTURE) {

            //Fichier trop gros
            if ($_FILES['pictures']['size'][$index] < MAX_FILE_SIZE) {

                // Si toutes les images ont été parcouru
                if ($i == count($_FILES['pictures']['name'])) {

                    // Récupération des champs
                    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
                    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
                    $organic = filter_input(INPUT_POST, 'organic', FILTER_SANITIZE_STRING);

                    // Création de l'annonce
                    $a = new Advertisement(null, $title, $description, (isset($organic) ? ORGANIC : NOT_ORGANIC), null, null, $_SESSION['email']);
                    $result = AdvertisementManager::CreateAd($a);

                    // Affichage du résultat
                    if ($result === false) {
                        echo '<div class="alert alert-danger mb-0" role="alert">Message d\'erreur : "Erreur lors de la création"</div>';
                    }
                    if ($result) {
                        echo '<div class="alert alert-success mb-0" role="alert">Création d\'une annonce réussi, en attente de redirection</div>';
                        echo '<meta http-equiv="refresh" content="2;URL=home.php">';
                    }
                }
            } else {
                echo '<div class="alert alert-warning mb-0" role="alert">Fichier proposé (' . $_FILES['pictures']['name'][$index] . ') trop volumineux. Taille max 3 Mo</div>';
            }
        } else {
            echo '<div class="alert alert-warning mb-0" role="alert">Mauvaise extension de fichier pour (' . $_FILES['pictures']['name'][$index] . ')</div>';
        }
    }
}

$pageName = 'Création d\'une annonce';

include_once '../views/showCreateAd.php';
