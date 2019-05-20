<?php
/*
Titre : Page de test du manageur "userManager"
Date : 13 mai 2019
Auteur : Romain Peretti
Version : 1.0
Description : Tests sur chacune des méthodes du manageur.
*/

require_once '../managers/userManager.php';

/**
 * Test 1 - GetUserByEmail()
 */
echo '<h3>Test 1 - GetUserByEmail()</h3>';

echo '<h4>1.1 Utilisateur existant</h4>';
// Récupération d'un utilisateur existant
$u = UserManager::GetUserByEmail('romain.prtt@eduge.ch');
if ($u === false) {
    echo 'Problème lors de la récupération';
}
if ($u === null) {
    echo 'L\'utilisateur recherché n\'existe pas';
}
if ($u) {
    echo '<pre>' . var_dump($u) . '</pre>';
}

echo '<h4>1.2 Utilisateur inexistant</h4>';
// Récupération d'un utilisateur inexistant
$u = UserManager::GetUserByEmail('a');
if ($u === false) {
    echo 'Problème lors de la récupération';
}
if ($u === null) {
    echo 'L\'utilisateur recherché n\'existe pas';
}
if ($u) {
    echo '<pre>' . var_dump($u) . '</pre>';
}

/**
 * Test 2 - CreateUser()
 */
echo '<h3>Test 2 - CreateUser()</h3>';

echo '<h4>2.1 Utilisateur valide</h4>';
// Ajout d'un utilisateur
$u = new User('claude@gmail.com', '123', 'Lausanne', 'Vaud', '1000', '4 Rue des sapins', 'J\'aime marcher', 'iahdhguihvcniuwherhsfsdfus', '1');

$result = UserManager::CreateUser($u);
if ($result === false) {
    echo 'Problème lors de la création';
}
if ($result === null) {
    echo 'L\'utilisateur existe déjà';
}
if ($result === true) {
    echo 'Création d\'un utilisateur réussi';
}

echo '<h4>2.2 Utilisateur invalide (email déjà utilisé)</h4>';
// Ajout d'un utilisateur avec un email déjà utilisé
$u = new User('romain.prtt@eduge.ch', '123', 'Lausanne', 'Vaud', '1000', '4 Rue des sapins', 'J\'aime marcher', 'iahdhguihvcniuwherhsfsdfus', '1');

$result = UserManager::CreateUser($u);
if ($result === false) {
    echo 'Problème lors de la création';
}
if ($result === null) {
    echo 'L\'utilisateur existe déjà';
}
if ($result === true) {
    echo 'Création d\'un utilisateur réussi';
}

/**
 * Test 3 - UpdateUser()
 */
echo '<h3>Test 3 - UpdateUser()</h3>';

// Modification d'un utilisateur
$u = new User('claude@gmail.com', '123', 'Genève', 'Genève', '1243', '1 Rue des Bouleaux', 'J\'aime danser', 'iahdhguihvcniuwherhsfsdfus', '1');

$result = UserManager::UpdateUser($u);
if ($result === false) {
    echo 'Problème lors de la modification';
}
if ($result) {
    echo 'Modification d\'un utilisateur réussi';
}

/**
 * Test 4 - DeleteUser()
 */
echo '<h3>Test 4 - DeleteUser()</h3>';

// Supression d'un utilisateur
$result = UserManager::DeleteUser('claude@gmail.com');
if ($result === false) {
    echo 'Problème lors de la suppression';
}
if ($result) {
    echo 'Suppression d\'un utilisateur réussi';
}

/**
 * Test 5 - UserExist()
 */
echo '<h3>Test 5 - UserExist()</h3>';

echo '<h4>5.1 Utilisateur existant</h4>';
// Essaie avec un utilisateur existant
$result = UserManager::UserExist('romain.prtt@eduge.ch');
if ($result === false) {
    echo 'Problème lors de la récupération';
}
if ($result === null) {
    echo 'L\'utilisateur n\'existe pas';
}
if ($result) {
    echo 'L\'utilisateur existe';
}

echo '<h4>5.2 Utilisateur inexistant</h4>';
// Essaie avec un utilisateur inexistant
$result = UserManager::UserExist('avcfdadsa@gmail.com');
if ($result === false) {
    echo 'Problème lors de la récupération';
}
if ($result === null) {
    echo 'L\'utilisateur n\'existe pas';
}
if ($result) {
    echo 'L\'utilisateur existe';
}

/**
 * Test 6 - Login()
 */
echo '<h3>Test 6 - Login()</h3>';

$result = UserManager::Login('romain.prtt@eduge.ch', '123');
if ($result === false) {
    echo 'Problème lors de la connexion';
}
if ($result === null) {
    echo 'Mauvais mot de passe ou email';
}
if ($result) {
    echo 'Connexion réussi';
}