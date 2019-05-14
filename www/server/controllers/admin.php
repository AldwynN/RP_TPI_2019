<?php
/*
Titre : Contrôleur de la validation des annonces
Date : Mardi, 14 mai 2019
Auteur : Romain Peretti
Version : 1.0
Description : Cette page inclut la vue.
*/

require_once '../inc/inc.all.php';

$idAd = filter_input(INPUT_GET, 'idAd', FILTER_SANITIZE_NUMBER_INT);

$ads = AdvertisementManager::GetInvalidAds();

if(isset($idAd)){
    if(AdvertisementManager::UpdateAdToValid($idAd)){
        echo '<div class="alert alert-success mb-0" role="alert">Annonce validée</div>';
        echo '<meta http-equiv="refresh" content="2;URL=admin.php">';
    }
}

include_once '../views/showAdmin.php';