<?php
/*
Titre : Controlleur de la suppression d'une annonce
Date : Mardi, 14 mai 2019
Auteur : Romain Peretti
Version : 1.0
Description : Cette page inclut la recherche d'annonces et la vue
*/

require_once '../inc/inc.all.php';

$idAd = filter_input(INPUT_GET, 'idAd', FILTER_SANITIZE_NUMBER_INT);

$a = AdvertisementManager::GetAdById($idAd);

if (isset($_POST['send'])) {

    $result = AdvertisementManager::DeleteAd($idAd);
    if ($result === false) {
        echo '<div class="alert alert-danger mb-0" role="alert">Message d\'erreur : "Erreur lors de la suppression"</div>';
    }
    if ($result) {
        echo '<div class="alert alert-success mb-0" role="alert">Suppression réussi, en attente de redirection</div>';
        echo '<meta http-equiv="refresh" content="2;URL=home.php">';
    }
}

$pageName = 'Suppression d\'une annonce';

include_once '../views/showDeleteAd.php';
