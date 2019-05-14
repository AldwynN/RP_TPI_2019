<?php
/*
Titre : Contrôleur de la modification d'une annonce
Date : Mardi, 14 mai 2019
Auteur : Romain Peretti
Version : 1.0
Description : Cette page inclut la vue.
*/

require_once '../inc/inc.all.php';

$idAd = filter_input(INPUT_GET, 'idAd', FILTER_SANITIZE_STRING);

$ad = AdvertisementManager::GetAdById($idAd);
$pictures = PictureManager::GetPicturesByAdId($idAd);

if (isset($_POST['send'])) {
    // Code
}

include_once '../views/showUpdateAd.php';
