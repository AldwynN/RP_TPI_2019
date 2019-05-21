<?php
/*
Titre : Contrôleur de la modification d'une annonce
Date : Mardi, 14 mai 2019
Auteur : Romain Peretti
Version : 1.0
Description : Cette page inclut la vue.
*/

require_once '../inc/inc.all.php';

$idAd = null;

if (isset($_GET['idAd'])) {
    $idAd = filter_input(INPUT_GET, 'idAd', FILTER_SANITIZE_NUMBER_INT);
}

$ad = AdvertisementManager::GetAdById($idAd);
$pictures = PictureManager::GetPicturesByAdId($idAd);

if ($_SESSION['email'] != $ad->userEmail) {
    header('Location: home.php');
}

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
                    $organic = filter_input(INPUT_POST, 'organic');

                    // Création de l'annonce
                    $a = new Advertisement($ad->idAdvertisement, $title, $description, (isset($organic) ? ORGANIC : NOT_ORGANIC), null, null, $ad->userEmail);
                    $result = AdvertisementManager::UpdateAd($a);

                    // Affichage du résultat
                    if ($result === false) {
                        echo '<div class="alert alert-danger mb-0" role="alert">Message d\'erreur : "Erreur lors de la modification"</div>';
                    }
                    if ($result) {
                        echo '<div class="alert alert-success mb-0" role="alert">Modification d\'une annonce réussi, en attente de redirection</div>';
                        echo '<meta http-equiv="refresh" content="1;URL=home.php">';
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
if (isset($_POST['delete'])) {
    if (isset($_POST['idPic'])) {

        $idPic = filter_input(INPUT_POST, 'idPic', FILTER_SANITIZE_NUMBER_INT);

        PictureManager::DeletePicture($idPic);

        header('Location: updateAd.php?idAd=' . $idAd);
    }
}

$pageName = 'Modification d\'une annonce';

include_once '../views/showUpdateAd.php';
