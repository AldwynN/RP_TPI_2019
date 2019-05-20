<?php
/*
Titre : Page de test du manageur "advertisementManager"
Date : 13 mai 2019
Auteur : Romain Peretti
Version : 1.0
Description : Tests sur chacune des méthodes du manageur.
*/

require_once '../managers/advertisementManager.php';

/**
 * Test 1 - GetValidatedAds()
 */
echo '<h3>Test 1 - GetValidatedAds()</h3>';

// Récupération des annonces validées
$results = AdvertisementManager::GetValidatedAds();
if ($results === false) {
    echo 'Problème lors de la récupération';
}
if ($results) {
    echo '<pre>' . var_dump($results[0]) . '</pre>';
} else {
    echo 'Aucune annonces';
}

/**
 * Test 2 - GetInvalidAds()
 */
echo '<h3>Test 2 - GetInvalidAds()</h3>';

// Récupération des annonces non validées
$results = AdvertisementManager::GetInvalidAds();
if ($results === false) {
    echo 'Problème lors de la récupération';
}
if ($results) {
    echo '<pre>' . var_dump($results[0]) . '</pre>';
} else {
    echo 'Aucune annonces';
}

/**
 * Test 3 - GetAdById()
 */
echo '<h3>Test 3 - GetAdById()</h3>';

echo '<h4>3.1 Annonce existante</h4>';
// Récupération d'une annonce existante
$a = AdvertisementManager::GetAdById(7);
if ($a === false) {
    echo 'Problème lors de la récupération';
}
if ($a === null) {
    echo 'Annonce introuvable';
}
if ($a) {
    echo '<pre>' . var_dump($a) . '</pre>';
}

echo '<h4>3.1 Annonce inexistante</h4>';
// Récupération d'une annonce inexistante
$a = AdvertisementManager::GetAdById(0);
if ($a === false) {
    echo 'Problème lors de la récupération';
}
if ($a === null) {
    echo 'Annonce introuvable';
}
if ($a) {
    echo '<pre>' . var_dump($a) . '</pre>';
}

/**
 * Test 4 - GetAdsByUserEmail()
 */
echo '<h3>Test 4 - GetAdsByUserEmail()</h3>';

// Récupération des annonces d'un utilisateur
$results = AdvertisementManager::GetAdsByUserEmail('romain.prtt@eduge.ch');
if ($results === false) {
    echo 'Problème lors de la récupération';
}
if ($results) {
    echo '<pre>' . var_dump($results[0]) . '</pre>';
}

/**
 * Test 5 - CreateAd()
 */
echo '<h3>Test 5 - CreateAd()</h3>';

// Ajout d'une annonce
$a = new Advertisement(null, 'Farine de seigle 4', 'Farine complète', 0, null, null, 'jack@gmail.com');
$result = AdvertisementManager::CreateAd($a);
if ($a === false) {
    echo 'Problème lors de la création';
}
if ($a) {
    echo 'Création d\'une annonce réussi';
}

//Id de l'annonce qu'on vient de créer, il est nécessaire de le modifier à chaque fois. Utiliser pour les trois derniers tests
$idAd = 50;

/**
 * Test 6 - UpdateAd()
 */
echo '<h3>Test 6 - UpdateAd()</h3>';

// Modification d'une annonce
$a = new Advertisement($idAd, 'Farine de seigle 4 A+', 'Farine doublement complète', 1, null, null, 'jack@gmail.com');
$result = AdvertisementManager::UpdateAd($a);
if ($a === false) {
    echo 'Problème lors de la modification';
}
if ($a) {
    echo 'Modification d\'une annonce réussi';
}

/**
 * Test 7 - UpdateAdToValid()
 */
echo '<h3>Test 7 - UpdateAdToValid()</h3>';

//Validation de l'annonce
$result = AdvertisementManager::UpdateAdToValid($idAd);
if ($result === false) {
    echo 'Problème lors de la validation';
}
if ($result) {
    echo 'Annonce validée';
}

/**
 * Test 8 - DeleteAd()
 */
echo '<h3>Test 8 - DeleteAd()</h3>';

// Suppression d'une annonce
$result = AdvertisementManager::DeleteAd($idAd);
if ($result === false) {
    echo 'Problème lors de la suppression';
}
if ($result) {
    echo 'Annonce supprimée';
}

/**
 * Test 9 - DeleteAdsOfUser()
 */
echo '<h3>Test 9 - DeleteAdsOfUser()</h3>';
$result = AdvertisementManager::DeleteAdsOfUser('jack@gmail.com');
if ($result === false) {
    echo 'Problème lors de la suppression';
}
if ($result) {
    echo 'Annonces supprimées';
}

/**
 * Test 10 - Research()
 */
echo '<h3>Test 10 - Research()</h3>';
$results = AdvertisementManager::Research('Genève', false);
if ($results === false) {
    echo 'Problème lors de la recherche';
}
if ($results) {
    if ($results != array()) {
        echo '<pre>' . var_dump($results[0]) . '</pre>';
    }else{
        echo '<p>Aucunes annonces associées à cette recherche</p>';
    }
}
