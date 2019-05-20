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
$idAd = 42;

/**
 * Test 1 - CreateRating()
 */
echo '<h3>Test 1 - CreateRating()</h3>';

//Ajout d'une évalutation
$r = new Rating(null, 3, 'Très bonne farine pour faire du pain', null, 'romain.prtt@eduge.ch', $idAd);

$result = RatingManager::CreateRating($r);
if ($result === false) {
    echo 'Problème lors de la création';
}
if ($result) {
    echo 'Création d\'une évaluation réussi';
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

/**
 * Test 4 - DeleteRatingsOfAnAd()
 */
echo '<h3>Test 4 - DeleteRatingsOfAnAd()</h3>';

$result = RatingManager::DeleteRatingsOfAnAd($idAd);
if ($result === false) {
    echo 'Problème lors de la suppression';
}
if ($result) {
    echo 'Suppression réussi';
}

/**
 * Test 5 - DeleteRatingsOfUser()
 */
echo '<h3>Test 5 - DeleteRatingsOfUser()</h3>';

$result = RatingManager::DeleteRatingsOfUser('jack@gmail.com');
if ($result === false) {
    echo 'Problème lors de la suppression';
}
if ($result) {
    echo 'Suppression réussi';
}