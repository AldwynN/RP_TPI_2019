<?php
/*
Titre : Controlleur de l'accueil
Date : Lundi, 13 mai 2019
Auteur : Romain Peretti
Version : 1.0
Description : Cette page inclut la recherche d'annonces et la vue
*/

require_once '../inc/inc.all.php';

$ads = AdvertisementManager::GetValidatedAds();

if (isset($_POST['search'])) {
    $searchContent = filter_input(INPUT_POST, 'searchContent', FILTER_SANITIZE_STRING);
    // Recherche
}

$pageName = 'Accueil';

include_once '../views/showHome.php';
