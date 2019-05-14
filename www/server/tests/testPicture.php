<?php
/*
Titre : Page de test du manageur "pictureManager"
Date : 13 mai 2019
Auteur : Romain Peretti
Version : 1.0
Description : Tests sur chacune des méthodes du manageur.
*/

require_once '../managers/pictureManager.php';

// Id de l'annonce qui sera utilisée pour ces tests
$idAd = 6;

/**
 * Test 1 - CreatePicture()
 */
echo '<h3>Test 1 - CreatePicture()</h3>';

$p = new Picture(null, base64_encode('Picture.jpg'), $idAd);
$result = PictureManager::CreatePicture($p);
if ($result === false) {
    echo 'Problème lors de la création';
}
if ($result) {
    echo 'Création d\'une image réussi';
}

/**
 * Test 2 - GetPictureById()
 */
echo '<h3>Test 2 - GetPictureById()</h3>';

$p = PictureManager::GetPictureById(1);
if ($p === false) {
    echo 'Problème lors de la récupération';
}
if ($p) {
    echo '<pre>' . var_dump($p) . '</pre>';
}

/**
 * Test 3 - GetPicturesByAdId()
 */
echo '<h3>Test 3 - GetPicturesByAdId()</h3>';

$results = PictureManager::GetPicturesByAdId($idAd);
if ($results === false) {
    echo 'Problème lors de la récupération';
}
if ($results) {
    echo '<pre>' . var_dump($results[0]) . '</pre>';
}

/**
 * Test 4 - DeletePicture()
 */
echo '<h3>Test 4 - DeletePicture()</h3>';

$result = PictureManager::DeletePicture(1);
if ($result === false) {
    echo 'Problème lors de la suppression';
}
if ($result) {
    echo 'Suppression d\'une image réussi';
}

/**
 * Test 5 - DeletePicturesOfAnAd()
 */
echo '<h3>Test 5 - DeletePicturesOfAnAd()</h3>';

$result = PictureManager::DeletePicturesOfAnAd($idAd);
if ($result === false) {
    echo 'Problème lors de la suppression';
}
if ($result) {
    echo 'Suppression des images réussi';
}