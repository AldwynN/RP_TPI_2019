<?php
/*
Titre : Controlleur des détails d'une annonce
Date : Lundi, 13 mai 2019
Auteur : Romain Peretti
Version : 1.0
Description : Cette page inclut la vue.
*/

require_once '../inc/inc.all.php';

$idAd = filter_input(INPUT_GET, 'idAd', FILTER_SANITIZE_STRING);

$ad = AdvertisementManager::GetAdById($idAd);
$u = UserManager::GetUserByEmail($ad->userEmail);
$rates = RatingManager::GetRatingsOfAnAd($idAd);

if (isset($_POST['send'])) {
    $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);
    $rating = filter_input(INPUT_POST, 'grade', FILTER_SANITIZE_STRING);

    $r = new Rating($_SESSION['email'], $ad->idAdvertisement, $rating, $comment, null);
    $result = RatingManager::CreateRating($r);

    if ($result === false) {
        echo '<div class="alert alert-danger mb-0" role="alert">Message d\'erreur : "Erreur lors de la création"</div>';
    }
    if ($result) {
        echo '<div class="alert alert-success mb-0" role="alert">Création du commentaire réussi</div>';
        echo '<meta http-equiv="refresh" content="2;URL=#">';
    }
}

include_once '../views/showAdDetails.php';
