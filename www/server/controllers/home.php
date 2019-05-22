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
    $searchOrganic = filter_input(INPUT_POST, 'searchOrganic', FILTER_SANITIZE_STRING);
    $searchOption = filter_input(INPUT_POST, 'searchOption', FILTER_SANITIZE_STRING);

    if ($searchContent != "" || isset($searchOrganic)) {
        $results = AdvertisementManager::Research($searchContent, (isset($searchOrganic) ? true : false), $searchOption);
        if ($results === false) {
            echo '<div class="alert alert-danger mb-0" role="alert">Une erreur est survenue lors de la recherche</div>';
            return;
        }
        $ads = $results;
    } else {
        echo '<div class="alert alert-warning mb-0" role="alert">Veuillez entrer une recherche</div>';
    }
}

$pageName = 'Accueil';

include_once '../views/showHome.php';
