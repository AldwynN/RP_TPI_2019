<?php
/*
Titre : Page de test du manageur "ratingManager"
Date : 13 mai 2019
Auteur : Romain Peretti
Version : 1.0
Description : Tests sur chacune des méthodes du manageur.
*/

require_once '../managers/ratingManager.php';

// Id de l'annonce sur laquelle sera effectué les tests
$idAd = 6;

/**
 * Test 1 - CreateRating()
 */
echo '<h3>Test 1 - CreateRating()</h3>';

//Ajout d'une évalutation
$r = new Rating('romain.prtt@eduge.ch', $idAd, 3, 'Très bonne farine pour faire du pain', null);

$result = RatingManager::CreateRating($r);
if ($result === false) {
    echo 'Problème lors de la création';
}
if ($result) {
    echo 'Création d\'une évalution réussi';
}

/**
 * Test 2 - GetRatingsOfAnAd()
 */
echo '<h3>Test 2 - GetRatingsOfAnAd()</h3>';

$results = RatingManager::GetRatingsOfAnAd($idAd);
if ($results === false) {
    echo 'Problème lors de la récupération';
}
if ($results) {
    echo '<pre>' . var_dump($results[0]) . '</pre>';
}

/**
 * Test 3 - GetScoreOfAnAd()
 */
echo '<h3>Test 3 - GetScoreOfAnAd()</h3>';

$result = RatingManager::GetScoreOfAnAd($idAd);
if ($result === false) {
    echo 'Problème lors de la récupération';
}
if ($result) {
    echo '<pre>' . var_dump($result) . '</pre>';
}

