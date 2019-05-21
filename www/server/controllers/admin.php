<?php
/*
Titre : Contrôleur de la validation des annonces
Date : Mardi, 14 mai 2019
Auteur : Romain Peretti
Version : 1.0
Description : Cette page inclut la vue.
*/

require_once '../inc/inc.all.php';

if (!isset($_SESSION['email']) || $_SESSION['role'] != ADMINISTRATOR_CODE) {
    header('Location: home.php');
}

$idAdToValid = filter_input(INPUT_GET, 'idAd', FILTER_SANITIZE_NUMBER_INT);

$ads = AdvertisementManager::GetInvalidAds();
$adsNumber = 0;

if (isset($idAdToValid)) {
    if (AdvertisementManager::UpdateAdToValid($idAdToValid)) {
        echo '<div class="alert alert-success mb-0" role="alert">Annonce validée</div>';
        echo '<meta http-equiv="refresh" content="1;URL=admin.php">';
    }
}

if (isset($_POST['delete'])) {
    $idAdToDelete = filter_input(INPUT_POST, 'idAd', FILTER_SANITIZE_NUMBER_INT);

    if (AdvertisementManager::DeleteAd($idAdToDelete)) {
        echo '<div class="alert alert-success mb-0" role="alert">Annonce supprimée</div>';
        echo '<meta http-equiv="refresh" content="1;URL=admin.php">';
    } else {
        echo '<div class="alert alert-success mb-0" role="alert">Erreur lors de la suppression</div>';
     }
}

$pageName = 'Administrateur';

include_once '../views/showAdmin.php';
